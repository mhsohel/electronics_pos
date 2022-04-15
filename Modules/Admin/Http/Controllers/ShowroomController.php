<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Showroom;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        session(['menu' => 'customer']);
        $list = Showroom::get();
        return view('admin::showroom.index', \compact('list'));
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
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->logo->extension();
        $request->logo->move('images/showroom', $imageName);

        $product = new Showroom();
        $product->name = $request->name;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->bank_account = $request->bank_account;
        $product->address = $request->address;
        $product->logo = $imageName;
        $product->save();
        return redirect()->route('showroom.index')->with('success', 'Showroom created successfully');
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
        $edit = Showroom::find($id);
        return view('admin::showroom.edit', compact('edit'));
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $showroom = [];
        $showroom['name'] = $request->name;
        $showroom['email'] = $request->email;
        $showroom['phone'] = $request->phone;
        $showroom['address'] = $request->address;
        $showroom['bank_account'] = $request->bank_account;
        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move('images/showroom', $imageName);
            $showroom['logo'] = $imageName;
        }
        Showroom::find($id)
            ->update($showroom);
        return redirect()->route('showroom.index')->with('success', 'Showroom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $data = Showroom::find($id);
        Showroom::find($id)->delete();
        return redirect()->route('showroom.index')->with('success', 'Showroom deleted successfully');
    }
}
