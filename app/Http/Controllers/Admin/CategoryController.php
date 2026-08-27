<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request);
         $categories=Category::create($request->all());
        $file_name=time().'.'.$request->image->extension();
        $upload=$request->image->move(public_path('images/categories/'),$file_name);
        if($upload)
            {
                $categories->image="images/categories/".$file_name;
            }
        $categories->save();
        return redirect()->route('backend.categories.index');
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
         $category=Category::find($id);
         $categories=Category::all();
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=Category::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'image'=>'nullable | image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $category->code_no=$request->code_no;
        $category->name=$request->name;
    
        if($request->hasFile('image'))
            {
                if(!empty($request->old_image)&& file_exists(public_path($request->old_image)))
                    {
                        unlink(public_path($request->old_image));

                    }
                    $file_name=time().'.'.$request->image->extension();
                    $request->image->move(public_path('images/categories'),$file_name);
                    $category->image="image/categories/".$file_name;
            }
            $category->save();
            return redirect()->route('backend.categories.index')->with('success','Category update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('backend.categories.index');
    }
}
