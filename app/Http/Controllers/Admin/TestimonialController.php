<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Facades\Image;
use App\Models\Testimonial;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest('created_at')->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'content' => 'required|max:200',
            'role' => 'nullable|max:100',
            'rating' => 'nullable|integer|min:1|max:5'
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('testimonial')){
                Storage::disk('public')->makeDirectory('testimonial');
            }
            $testimonial = (string) Image::read($image)->resize(160, 160)->toJpeg();
            Storage::disk('public')->put('testimonial/'.$imagename, $testimonial);
        }else{
            $imagename = 'default.png';
        }

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->content = $request->content;
        $testimonial->role = $request->role;
        $testimonial->rating = $request->rating ?? 5;
        $testimonial->avatar = $imagename;
        $testimonial->is_active = $request->boolean('is_active');
        $testimonial->save();

        Toastr::success('message', 'Testimonial created successfully.');
        return redirect()->route('admin.testimonials.index');
    }


    public function edit(string $id)
    {
        $testimonial = Testimonial::find($id, ['*']);

        return view('admin.testimonials.edit', compact('testimonial'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'content' => 'required|max:200',
            'role' => 'nullable|max:100',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $image = $request->file('image'); 
        $slug  = Str::slug($request->name);
        $testimonial = Testimonial::find($id, ['*']);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('testimonial')){
                Storage::disk('public')->makeDirectory('testimonial');
            }
            if(Storage::disk('public')->exists('testimonial/'.$testimonial->avatar)){
                Storage::disk('public')->delete('testimonial/'.$testimonial->avatar);
            }
            $testimonialimg = (string) Image::read($image)->resize(160, 160)->toJpeg();
            Storage::disk('public')->put('testimonial/'.$imagename, $testimonialimg);
        }else{
            $imagename = $testimonial->avatar;
        }

        $testimonial->name = $request->name;
        $testimonial->content = $request->content;
        $testimonial->role = $request->role;
        $testimonial->rating = $request->rating ?? $testimonial->rating;
        $testimonial->avatar = $imagename;
        $testimonial->is_active = $request->boolean('is_active');
        $testimonial->save();

        Toastr::success('message', 'Testimonial updated successfully.');
        return redirect()->route('admin.testimonials.index');
    }


    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id, ['*']);

        if(Storage::disk('public')->exists('testimonial/'.$testimonial->avatar)){
            Storage::disk('public')->delete('testimonial/'.$testimonial->avatar);
        }

        $testimonial->delete();

        Toastr::success('message', 'Testimonial deleted successfully.');
        return back();
    }
}
