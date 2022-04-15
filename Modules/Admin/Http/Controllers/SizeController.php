<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Size;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'product']);
        $list = Size::get();
        return view('admin::size.index', \compact('list'));
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
            'size' => 'required'
        ]);
        Size::create($request->all());
        return redirect()->route('size.index')->with('success', 'Size created successfully');
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
        $data = Size::find($id);
        $list = Size::get();
        return view('admin::size.edit', \compact('data', 'list'));
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
            'size' => 'required'
        ]);
        Size::find($id)->update($request->all());
        return redirect()->route('size.index')->with('success', 'Size Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Size::find($id)->delete();
        return redirect()->route('size.index')->with('success', 'Size deleted successfully');
    }
}
