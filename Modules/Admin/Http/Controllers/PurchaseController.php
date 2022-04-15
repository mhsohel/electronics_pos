<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'supplier']);
        $list = Purchase::where('approval', 'no')->groupBy('invoiceID')->get();
        return \view('admin::purchase.list', \compact('list'));
    }
    public function purchase_order()
    {
        session(['menu' => 'supplier']);
        $list = Purchase::where('approval', 'yes')->groupBy('invoiceID')->get();
        return \view('admin::purchase.po_list', \compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        session(['menu' => 'supplier']);
        $product = Product::pluck('name', 'id');
        $product[''] = 'Select Products';

        $supplier = Supplier::pluck('name', 'id');
        $supplier[''] = 'Select Supplier';
        $product_list = Product::all();
        $p_list = array();
        foreach ($product_list as $p) {
            $p_list[$p->id] = $p->name . ' [ ' . $p->size->size . ',' . $p->color->color . ' ]';
        }
        $p_list[''] = 'Select Product';
        return view('admin::purchase.index', \compact('product', 'supplier', 'p_list'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $invoiceID = random_int(100000, 999999);

        foreach ($request->product_id as $k => $id) {
            $data = new Purchase();
            $data->invoiceID = $invoiceID;
            $data->supplier_id = $request->supplier_id;
            $data->discount_type = $request->discount_type;
            $data->discount = $request->discount;
            $data->product_id = $id;
            $data->batchID = $request->batchID[$k];
            $data->cost_price = $request->cost_price[$k];
            $data->mrp = $request->mrp[$k];
            $data->qty = $request->qty[$k];
            $data->order_qty = $request->qty[$k];
            $data->total = $request->total;
            $data->warranty_type = $request->warranty_type[$k];
            $data->warranty_period = $request->warranty_period[$k];
            $data->user_id = Auth::user()->id;
            $data->approval = 'no';
            $data->save();
        }
        return \redirect('admin/purchase/' . $invoiceID);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        session(['menu' => 'supplier']);
        $data = Purchase::where('invoiceID', $id)->get();
        return view('admin::purchase.invoice', \compact('data'));
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
        Purchase::where('invoiceID', $id)->delete();
        return redirect()->route('purchase.index')->with('success', 'Invoice deleted successfully');
    }
    public function product_by_barcode(Request $r)
    {
        $productID = substr($r->barcode, 0, 4);
        $product = Product::find($productID);
        $data['name'] = $product->name;
        $data['size'] = $product->size->size;
        $data['color'] = $product->color->color;
        $data['priduct_id'] = $productID;
        return \response()->json($data, 200);
    }
    public function grn(int $id)
    {
        $data = Purchase::where('invoiceID', $id)->get();
        return view('admin::purchase.grn', \compact('data'));
    }
    public function grn_view(int $id)
    {
        $data = Purchase::where('invoiceID', $id)->get();
        return view('admin::purchase.grn_view', \compact('data'));
    }
    public function purchase_list()
    {
        session(['menu' => 'supplier']);
        $list = Purchase::where('approval', 'no')->groupBy('invoiceID')->get();
        return \view('admin::purchase.list', \compact('list'));
    }
    public function grn_update(Request $request, $id)
    {
        foreach ($request->qty as $k => $q) {
            Purchase::find($request->id[$k])->update(['qty' => $q, 'grn' => $request->grn[$k], 'approval' => 'yes']);
        }
        return \redirect('admin/purchase/')->with('msg', 'GRN Successfully saved!');
    }
}
