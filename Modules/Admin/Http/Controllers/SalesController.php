<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Main_sale;
use App\Models\Product;
use App\Models\Dealer;
use App\Models\Showroom;
use App\Models\Purchase;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'sales']);
        $list = Main_sale::where('approval', 'no')->groupBy('invoiceID')->get();
        return \view('admin::sales.index', \compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        session(['menu' => 'sales']);
        $product = Product::pluck('name', 'id');
        $showroom = Showroom::pluck('name', 'id');
        $showroom[''] = 'Select Showroom';
        $dealer = Dealer::pluck('name', 'id');
        $dealer[''] = 'Select Dealer'; 
        $product_list = Product::all();
        $p_list = array();
        foreach ($product_list as $p) {
            $p_list[$p->id] = $p->name . ' [ ' . $p->size->size . ',' . $p->color->color . ' ]';
        }
        $p_list[''] = 'Select Product';     
        return view('admin::sales.create', \compact('p_list', 'product','showroom', 'dealer'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {   
        $invoiceID = random_int(100000, 999999);
        if(!empty($request->product_id && $request->qty && $request->showroom || $request->dealer)){
            foreach ($request->product_id as $k => $id) {
                $data = new Main_sale();
                $data->invoiceID = $invoiceID;
                $data->product_id = $id;
                $data->showroom_id = $request->showroom;
                $data->dealer_id = $request->dealer;
                $data->batchID = $request->batchId[$k];
                $data->qty = $request->qty[$k];
                $data->mrp = $request->mrp[$k];
                $data->discount = $request->dis[$k];
                $data->discount_type = $request->dis_type[$k];
                $data->qty = $request->qty[$k];
                $data->total = $request->total;
                $data->user_id = Auth::user()->id;
                $SaveStatus= $data->save();
            }
            if($SaveStatus){
                return redirect()->route('sales.show', $invoiceID);
            }
        }else{
            return redirect()->route('sales.create')->with('error', 'Please fill product, showroom/dealer, qty fields');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($invoiceID)
    {
        session(['menu' => 'sales']);
        $data = Main_sale::where('invoiceID', $invoiceID)->get();
        return view('admin::sales.invoice', \compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {   
        $showroom_id =  Main_sale::select('showroom_id')->where('invoiceID', $id)->first();
        $dealer_id =  Main_sale::select('dealer_id')->where('invoiceID', $id)->first();
        $sales = Main_sale::where('invoiceID', $id)->get();
        $product = Product::pluck('name', 'id');
        $showroom = Showroom::select('name', 'id')->get();
        $dealer = Dealer::select('name', 'id')->get();
        $product_list = Product::all();
        $p_list = array();
        foreach ($product_list as $p) {
            $p_list[$p->id] = $p->name . ' [ ' . $p->size->size . ',' . $p->color->color . ' ]';
        }
        $p_list[''] = 'Select Product';     
        return view('admin::sales.edit', \compact('p_list', 'product','showroom', 'dealer','sales','showroom_id','dealer_id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {   
        $invoiceID = $request->invoiceID;
        Main_sale::where('invoiceID', $invoiceID)->delete();
        if(!empty($request->product_id && $request->qty && $request->showroom || $request->dealer)){
            foreach ($request->product_id as $k => $id) {
                $data = new Main_sale();
                $data->invoiceID = $invoiceID;
                $data->product_id = $id;
                $data->showroom_id = $request->showroom;
                $data->dealer_id = $request->dealer;
                $data->batchID = $request->batchId[$k];
                $data->qty = $request->qty[$k];
                $data->mrp = $request->mrp[$k];
                $data->discount = $request->dis[$k];
                $data->discount_type = $request->dis_type[$k];
                $data->qty = $request->qty[$k];
                $data->total = $request->total;
                $data->user_id = Auth::user()->id;
                $SaveStatus= $data->save();
            }
            if($SaveStatus){
                return redirect()->route('sales.show', $invoiceID);
            }
        }else{
            return redirect()->route('sales.create')->with('error', 'Please fill product, showroom/dealer, qty fields');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $invoiceID = Main_sale::where('invoiceID', $id)->first();   
        if(!empty($invoiceID)){
            $invoiceID->delete();
            return redirect()->route('sales.list')->with('success', 'Invoice Deleted Successfully');
        }
        abort(404);
    }

    public function getPurchaseInfo($id){
        $product = Product::find($id);
        $find_batchId = Purchase::select('batchID')->where('product_id',$product->id)->orderBy('batchID','ASC')->first();
        $inventory_product = Purchase::select('qty')->where('product_id',$product->id)->where('batchID',$find_batchId->batchID)->first();
        $sold_product  = Main_sale::where('product_id',$product->id)->where('batchID',$find_batchId->batchID)->sum('qty');
        $in_stock = $inventory_product->qty - $sold_product;
        $data['purchase']  = Purchase::select('batchID','mrp')->where('product_id',$product->id)->orderBy('batchID','ASC')->get();
        $data['in_stock'] = $in_stock;
        $data['name'] = $product->name;
        $data['size'] = $product->size->size;
        $data['color'] = $product->color->color;
        $data['product_id'] = $id;
        return \response()->json($data, 200);
    }
    public function getMrp($productId, $batchId){
        $productId = $productId;
        $batchId =  $batchId;
        $inventory = Purchase::select('qty')
        ->groupBy('batchID')
        ->where('product_id',$productId)
        ->where('batchID',$batchId)
        ->first();
        $sold_product  = Main_sale::where('product_id',$productId)->where('batchID',$batchId)->sum('qty');
        $data['in_stock'] = $inventory->qty - $sold_product;

        $data['getMrp'] = Purchase::select('mrp')
        ->groupBy('batchID')
        ->where('product_id',$productId)
        ->where('batchID',$batchId)
        ->first();
        return response()->json($data, 200);
    }
    public function checkInventory(Request $request){
        $productId = $request->productId;
        $batchId =  $request->batchId;

        $inventory = Purchase::select('qty')
        ->groupBy('batchID')
        ->where('product_id',$productId)
        ->where('batchID',$batchId)
        ->first();
        $sold_product  = Main_sale::where('product_id',$productId)->where('batchID',$batchId)->sum('qty');
        $in_stock = $inventory->qty - $sold_product;
        if($in_stock < $request->qty){
            return response()->json([
                'message' => 'Quantity is not available in stock',
                'in_stock' => $in_stock
            ], 200);
        }
        return response()->json([
            'success' => 'Product is in stock',
            'in_stock' => $in_stock
        ], 200);
    }
}
