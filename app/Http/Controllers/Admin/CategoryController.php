<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use App\Facades\Image;
use Carbon\Carbon;

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
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $slug  = Str::slug($request->name);
        $image = $request->file('image');

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category/thumb')){
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            $categoryimg = (string) Image::read($image)->resize(400, 400)->toJpeg();
            Storage::disk('public')->put('category/thumb/'.$imagename, $categoryimg);
        }else{
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->image = $imagename;
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
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $slug  = Str::slug($request->name);
        $category = Category::find($id, ['*']);
        $image = $request->file('image');

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category/thumb')){
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            if(Storage::disk('public')->exists('category/thumb/'.$category->image) && $category->image != 'default.png'){
                Storage::disk('public')->delete('category/thumb/'.$category->image);
            }
            $categoryimg = (string) Image::read($image)->resize(400, 400)->toJpeg();
            Storage::disk('public')->put('category/thumb/'.$imagename, $categoryimg);
        }else{
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->image = $imagename;
        $category->save();

        Toastr::success('message', 'Category updated successfully.');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id, ['*']);

        if(Storage::disk('public')->exists('category/thumb/'.$category->image) && $category->image != 'default.png'){
            Storage::disk('public')->delete('category/thumb/'.$category->image);
        }

        $category->delete();
        $category->posts()->detach();

        Toastr::success('message', 'Category deleted successfully.');
        return back();
    }
}
