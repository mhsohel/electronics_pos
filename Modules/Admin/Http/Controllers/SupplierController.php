<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'supplier']);
        $list = Supplier::get();
        return view('admin::supplier.index', \compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | unique:suppliers',
            'phone' => 'required | unique:suppliers',
            'address' => 'required',
        ]);
        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $edit = Supplier::find($id);
        $list = Supplier::get();
        return view('admin::supplier.edit', \compact('edit', 'list'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        Supplier::find($id)->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully');
    }
}
