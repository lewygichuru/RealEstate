<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Facades\Image;
use App\Models\Property;
use App\Models\Unit;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest('created_at')
                              ->withCount('comments')
                      ->where('owner_id', '=', Auth::id(), 'and')
                              ->paginate(10);
        
        return view('agent.properties.index',compact('properties'));
    }

    public function create()
    {   
        $amenityOptions = ['Parking', 'Pool', 'Gym', 'Security', 'Elevator', 'Garden', 'Backup Power', 'Water Tank', 'Internet', 'Furnished'];
        $selectedAmenities = old('amenities', []);
        $selectedAmenities = is_array($selectedAmenities) ? $selectedAmenities : [];
        return view('agent.properties.create', compact('amenityOptions', 'selectedAmenities'));
    }


    public function store(Request $request)
    { 
        $request->validate([
            'title'     => 'required|unique:properties|max:255',
            'price'     => 'required',
            'type'      => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            'status'    => 'required|in:available,rented,maintenance',
            'unit_number' => 'nullable|string|max:50',
            'bedroom'     => 'required|integer|min:0',
            'bathroom'    => 'required|integer|min:0',
            'rent_amount' => 'nullable|numeric',
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('property/gallery')){
                Storage::disk('public')->makeDirectory('property/gallery');
            }
            
            Storage::disk('public')->putFileAs('property/gallery', $image, $imagename);
        }

        $property = new Property();
        $property->title    = $request->title;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->type     = $request->type;
        $property->city     = $request->city;
        $property->state    = $request->state;
        $property->country  = $request->country ?? 'Kenya';
        $property->address  = $request->address;
        $property->status   = $request->status;
        $property->is_featured = $request->boolean('is_featured');
        $property->owner_id = Auth::id();
        $property->description        = $request->description;
        $property->latitude  = $request->latitude;
        $property->longitude = $request->longitude;
        $property->amenities = $request->input('amenities');
        $property->save();

        if (isset($imagename)) {
            $property->gallery()->create([
                'file_name' => $imagename,
                'original_name' => $image->getClientOriginalName(),
                'file_path' => Storage::url('property/gallery/' . $imagename),
                'size' => $image->getSize(),
                'mime_type' => $image->getClientMimeType(),
            ]);
        }

        $property->units()->create([
            'unit_number' => $request->unit_number ?? 'Unit 1',
            'floor' => $request->floor,
            'bedrooms' => $request->bedroom,
            'bathrooms' => $request->bathroom,
            'size_sqft' => $request->size_sqft ?? $request->area,
            'rent_amount' => $request->rent_amount ?? $request->price,
            'deposit_amount' => $request->deposit_amount,
            'status' => $request->unit_status ?? 'available',
            'notes' => $request->unit_notes,
        ]);


        Toastr::success('message', 'Property created successfully.');
        return redirect()->route('agent.properties.index');
    }


    public function edit(Property $property)
    {   
        $property = Property::where('slug', '=', $property->slug, 'and')->first();
        $amenityOptions = ['Parking', 'Pool', 'Gym', 'Security', 'Elevator', 'Garden', 'Backup Power', 'Water Tank', 'Internet', 'Furnished'];
        $selectedAmenities = old('amenities', $property->amenities ?? []);
        $selectedAmenities = is_array($selectedAmenities) ? $selectedAmenities : [];

        return view('agent.properties.edit',compact('property', 'amenityOptions', 'selectedAmenities'));
    }


    public function update(Request $request, string $property)
    {   
        $request->validate([
            'title'     => 'required|max:255',
            'price'     => 'required',
            'type'      => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'description'        => 'required',
            'status'    => 'required|in:available,rented,maintenance',
            'unit_number' => 'nullable|string|max:50',
            'bedroom'     => 'required|integer|min:0',
            'bathroom'    => 'required|integer|min:0',
            'rent_amount' => 'nullable|numeric'
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        $property = Property::find($property, ['*']);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('property/gallery')){
                Storage::disk('public')->makeDirectory('property/gallery');
            }
            
            Storage::disk('public')->putFileAs('property/gallery', $image, $imagename);

        }

        $property->title    = $request->title;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->type     = $request->type;
        $property->city     = $request->city;
        $property->state    = $request->state;
        $property->country  = $request->country ?? 'Kenya';
        $property->address  = $request->address;
        $property->status   = $request->status;
        $property->is_featured = $request->boolean('is_featured');
        $property->description          = $request->description;
        $property->latitude    = $request->latitude;
        $property->longitude   = $request->longitude;
        $property->amenities   = $request->input('amenities');
        $property->save();

        if (isset($imagename)) {
            $property->gallery()->create([
                'file_name' => $imagename,
                'original_name' => $image->getClientOriginalName(),
                'file_path' => Storage::url('property/gallery/' . $imagename),
                'size' => $image->getSize(),
                'mime_type' => $image->getClientMimeType(),
            ]);
        }

        $unit = $property->units()->first();
        if (!$unit) {
            $unit = new Unit();
            $unit->property_id = $property->id;
        }
        $unit->unit_number = $request->unit_number ?? $unit->unit_number ?? 'Unit 1';
        $unit->floor = $request->floor;
        $unit->bedrooms = $request->bedroom;
        $unit->bathrooms = $request->bathroom;
        $unit->size_sqft = $request->size_sqft ?? $request->area;
        $unit->rent_amount = $request->rent_amount ?? $request->price;
        $unit->deposit_amount = $request->deposit_amount;
        $unit->status = $request->unit_status ?? $unit->status ?? 'available';
        $unit->notes = $request->unit_notes;
        $unit->save();

        Toastr::success('message', 'Property updated successfully.');
        return redirect()->route('agent.properties.index');
    }

    public function destroy(Property $property)
    {
        $property = Property::find($property->id, ['*']);

        $property->units()->delete();
        $property->delete();
        
        Toastr::success('message', 'Property deleted successfully.');
        return back();
    }
}
