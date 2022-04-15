<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
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
        $list = Category::get();
        return view('admin::category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // exit;
        $request->validate([
            'name' => 'required'
        ]);
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully');
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
        $data = Category::find($id);
        $list = Category::get();
        return view('admin::category.edit', \compact('data', 'list'));
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
        Category::find($id)->update($request->all());
        return redirect()->route('category.index')->with('success', 'Category Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
