<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Property;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

class FrontpageController extends Controller
{

    public function index()
    {
        $sliders = Schema::hasTable('sliders') ? Slider::latest('created_at')->get() : collect();

        $properties = Schema::hasTable('properties') ? Property::latest('created_at')
            ->with(['rating','units','gallery'])
            ->withCount('comments')
            ->take(6)
            ->get() : collect();

        $services = Schema::hasTable('services') ? Service::where('is_active', '=', true, 'and')->orderBy('order')->get() : collect();

        $testimonials = Schema::hasTable('testimonials') ? Testimonial::where('is_active', '=', true, 'and')->latest('created_at')->get() : collect();

        $posts = Schema::hasTable('posts') ? Post::latest('created_at')->where('status', '=', 'published', 'and')->take(6)->get() : collect();

        return view('frontend.index', compact('sliders','properties','services','testimonials','posts'));
    }


    public function search(Request $request)
    {
        $city     = strtolower($request->city);
        $type     = $request->type;
        $status   = $request->status;
        $bedroom  = $request->bedroom;
        $bathroom = $request->bathroom;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $minarea  = $request->minarea;
        $maxarea  = $request->maxarea;
        $featured = $request->featured;

        $properties = Property::latest('created_at')->with(['units','gallery'])->withCount('comments')
                                ->when($city, function ($query, $city) {
                                    return $query->where('city', '=', $city);
                                })
                                ->when($type, function ($query, $type) {
                                    return $query->where('type', '=', $type);
                                })
                                ->when($status, function ($query, $status) {
                                    return $query->where('status', '=', $status);
                                })
                                ->when($bedroom, function ($query, $bedroom) {
                                    return $query->whereHas('units', function ($unitQuery) use ($bedroom) {
                                        $unitQuery->where('bedrooms', '=', $bedroom);
                                    });
                                })
                                ->when($bathroom, function ($query, $bathroom) {
                                    return $query->whereHas('units', function ($unitQuery) use ($bathroom) {
                                        $unitQuery->where('bathrooms', '=', $bathroom);
                                    });
                                })
                                ->when($minprice, function ($query, $minprice) {
                                    return $query->where('price', '>=', $minprice);
                                })
                                ->when($maxprice, function ($query, $maxprice) {
                                    return $query->where('price', '<=', $maxprice);
                                })
                                ->when($minarea, function ($query, $minarea) {
                                    return $query->whereHas('units', function ($unitQuery) use ($minarea) {
                                        $unitQuery->where('size_sqft', '>=', $minarea);
                                    });
                                })
                                ->when($maxarea, function ($query, $maxarea) {
                                    return $query->whereHas('units', function ($unitQuery) use ($maxarea) {
                                        $unitQuery->where('size_sqft', '<=', $maxarea);
                                    });
                                })
                                ->when($featured, function ($query, $featured) {
                                    return $query->where('is_featured', '=', 1);
                                })
                                ->paginate(10);

        $bedroomdistinct  = Property::join('units', 'properties.id', '=', 'units.property_id', 'inner', false)
            ->select('units.bedrooms as bedroom')
            ->distinct()
            ->orderBy('units.bedrooms')
            ->get();
        $bathroomdistinct = Property::join('units', 'properties.id', '=', 'units.property_id', 'inner', false)
            ->select('units.bathrooms as bathroom')
            ->distinct()
            ->orderBy('units.bathrooms')
            ->get();

        return view('pages.search', compact('properties','bedroomdistinct','bathroomdistinct'));
    }

}
