<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Slider;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest('created_at')->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('slider')){
                Storage::disk('public')->makeDirectory('slider');
            }
            $slider = (string) Image::decode($image)->scaleDown(1600, 480)->encode();
            Storage::disk('public')->put('slider/'.$imagename, $slider);
        }else{
            $imagename = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->image = $imagename;
        $slider->link = $request->link;
        $slider->order = $request->order ?? 0;
        $slider->is_active = $request->boolean('is_active');
        $slider->save();

        Toastr::success('message', 'Slider created successfully.');
        return redirect()->route('admin.sliders.index');
    }


    public function edit(string $id)
    {
        $slider = Slider::find($id, ['*']);

        return view('admin.sliders.edit', compact('slider'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image'); 
        $slug  = Str::slug($request->title);
        $slider = Slider::find($id, ['*']);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('slider')){
                Storage::disk('public')->makeDirectory('slider');
            }
            if(Storage::disk('public')->exists('slider/'.$slider->image)){
                Storage::disk('public')->delete('slider/'.$slider->image);
            }
            $sliderimg = (string) Image::decode($image)->resize(1600, 480)->encode();
            Storage::disk('public')->put('slider/'.$imagename, $sliderimg);
        }else{
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->image = $imagename;
        $slider->link = $request->link;
        $slider->order = $request->order ?? $slider->order;
        $slider->is_active = $request->boolean('is_active');
        $slider->save();

        Toastr::success('message', 'Slider updated successfully.');
        return redirect()->route('admin.sliders.index');
    }


    public function destroy(string $id)
    {
        $slider = Slider::find($id, ['*']);

        if(Storage::disk('public')->exists('slider/'.$slider->image)){
            Storage::disk('public')->delete('slider/'.$slider->image);
        }

        $slider->delete();

        Toastr::success('message', 'Slider deleted successfully.');
        return back();
    }
}
