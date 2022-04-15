<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
    }
    public function index()
    {
        session(['menu' => 'product']);
        $list = Brand::get();
        $category = Category::get();
        return view('admin::brand.index', \compact('list', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::brand.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();
        $category = Category::find($request->category_id);
        $brand->categories()->attach($category);
        return redirect()->route('brand.index')->with('success', 'Category created successfully');
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
        $category = Category::get();
        $edit = Brand::find($id);
        $categoryID = [];
        foreach ($edit->categories as $c) {
            \array_push($categoryID, $c->id);
        }
        return view('admin::brand.edit', \compact('category', 'categoryID', 'edit'));
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
            'name' => 'required'
        ]);
        Brand::find($id)
            ->update(['name' => $request->name]);
        $brand = Brand::find($id);
        $brand->categories()->sync($request->category_id);
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
    }
    public function getCategory($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand->categories);
    }
}
