<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest('created_at')->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories|max:255',
            'description' => 'nullable',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);
        $slug  = Str::slug($request->name);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        Toastr::success('message', 'Category created successfully.');
        return redirect()->route('admin.categories.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $category = Category::find($id, ['*']);

        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'description' => 'nullable',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);
        $slug  = Str::slug($request->name);
        $category = Category::find($id, ['*']);

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        Toastr::success('message', 'Category updated successfully.');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id, ['*']);

        $category->delete();
        $category->posts()->detach();

        Toastr::success('message', 'Category deleted successfully.');
        return back();
    }
}
