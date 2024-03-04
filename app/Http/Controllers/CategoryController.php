<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index',compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $caregories=$request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories,slug',
            'created_at'=>now(),
            'updated_at'=>now(),
            'status'=>'nullable'
        ]);
        Category::create($caregories);
        return back()->with('success','Category Add Successfully!');

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
    public function edit(Category $category)
    {
        //
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $caregories=$request->validate([
            'name'=>'required',
            'slug'=>'required',
            'updated_at'=>now(),
            'status'=>'nullable'
        ]);
        $category->update($caregories);

        return back()->with('success','Category Edit Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success','Category Deleted Successfully!');
    }

    public function status(Request $request, $status, $id)
    {
        $category = Category::find($id);
        $category->status = $status;
//        dd($category);
        $category->save();

        return redirect()->back()->with('success', 'Category Status Updated');
    }
}
