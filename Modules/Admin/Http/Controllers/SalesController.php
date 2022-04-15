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
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        return view('admin::index');
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
        // dd($request->all());
        $invoiceID = random_int(100000, 999999);
        foreach ($request->productId as $k => $id) {
            $l = $k+1;
            $data = new Main_sale();
            $data->invoiceID = $invoiceID;
            $data->product_id = $id;
            $data->dealer_id = $request->supplier_id;
            $data->batchID = $request->batchId[$k];
            $data->qty = $request->qty[$k];
            $data->mrp = $request->mrp[$k];
            $data->discount = $request->dis[$k];
            // $data->discount_type = $request->discount_type[$l];
            $data->qty = $request->qty[$k];
            $data->total = $request->total[$k];
            
            $data->user_id = Auth::user()->id;
            $SaveStatus= $data->save();
        }
        if($SaveStatus){
            return redirect()->route('sales.show');
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        session(['menu' => 'sales']);
        $list = Main_sale::orderBy('id','DESC')->groupBy('invoiceID')->get();
        // dd($list);
        return view('admin::sales.index',compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getPurchaseInfo($id){
        $product = Product::find($id);
        $data['purchase']  = Purchase::select('batchID','mrp')->where('product_id',$product->id)->orderBy('batchID','ASC')->get();
        $data['name'] = $product->name;
        $data['size'] = $product->size->size;
        $data['color'] = $product->color->color;
        $data['priduct_id'] = $id;
        return \response()->json($data, 200);
    }
    public function getMrp($productId, $batchId){
        $mrp = Purchase::select('mrp')
        ->groupBy('batchID')
        ->where('product_id',$productId)
        ->where('batchID',$batchId)
        ->first();
        return response()->json($mrp, 200);
    }
}
