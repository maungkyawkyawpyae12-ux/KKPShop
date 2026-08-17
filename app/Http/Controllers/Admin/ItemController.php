<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Item::OrderBy('id','desc')->paginate(5);
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::orderBy('id','desc')->get();
        return view('admin.items.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'code_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required',
            'discount' => 'required',
            'on_stock' => 'required',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
        $item = new Item();

        $item->code_no = $request->code_no;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->on_stock = $request->on_stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/items'), $imageName);

            $item->image = $imageName;
        }

        $item->save();

        return redirect()
            ->route('backend.items.index')
            ->with('success', 'Item created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
