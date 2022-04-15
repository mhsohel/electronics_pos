<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Color;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        session(['menu' => 'product']);
        $list = Color::get();
        return view('admin::color.index', \compact('list'));
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
            'color' => 'required'
        ]);
        Color::create($request->all());
        return redirect()->route('color.index')->with('success', 'Color created successfully');
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
        $data = Color::find($id);
        $list = Color::get();
        return view('admin::color.edit', \compact('data', 'list'));
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
            'color' => 'required'
        ]);
        Color::find($id)->update($request->all());
        return redirect()->route('color.index')->with('success', 'Color Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Color::find($id)->delete();
        return redirect()->route('color.index')->with('success', 'Color deleted successfully');
    }
}
