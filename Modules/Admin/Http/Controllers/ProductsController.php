<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'product']);
        $list = Product::paginate(10);
        $category = Category::pluck('name', 'id');
        $brand = Brand::pluck('name', 'id');
        $unit = Unit::pluck('unit', 'id');
        $size = Size::pluck('size', 'id');
        $color = Color::pluck('color', 'id');

        $selectedID = NULL;
        return view('admin::products.index', \compact('list', 'category', 'selectedID', 'brand', 'unit', 'size', 'color'));
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'model' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'product_code' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move('images', $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->model = $request->model;
        $product->size_id = $request->size_id;
        $product->color_id = $request->color_id;
        $product->product_code = $request->product_code;
        $product->photo = $imageName;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Product created successfully');
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
        $list = Product::paginate(10);
        $category = Category::pluck('name', 'id');
        $brand = Brand::pluck('name', 'id');
        $unit = Unit::pluck('unit', 'id');
        $size = Size::pluck('size', 'id');
        $color = Color::pluck('color', 'id');
        $edit = Product::find($id);
        return view('admin::products.edit', \compact('list', 'category', 'brand', 'unit', 'size', 'color', 'edit'));
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'model' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'product_code' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $product = [];
        $product['name'] = $request->name;
        $product['brand_id'] = $request->brand_id;
        $product['category_id'] = $request->category_id;
        $product['unit_id'] = $request->unit_id;
        $product['model'] = $request->model;
        $product['size_id'] = $request->size_id;
        $product['color_id'] = $request->color_id;
        $product['product_code'] = $request->product_code;
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move('images', $imageName);
            $product['photo'] = $imageName;
        }
        Product::find($id)
            ->update($product);
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        // \unlink(asset('images/' . $data->photo));
        Product::find($id)->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
