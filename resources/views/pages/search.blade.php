@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Filters Sidebar --}}
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body p-4 gap-3">
                        <h2 class="card-title text-base">Filter Properties</h2>

                        <form action="{{ route('search') }}" method="GET" class="flex flex-col gap-3">

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">City</legend>
                                <input type="text" name="city" value="{{ request('city') }}"
                                       placeholder="Enter city..." list="search-city-list"
                                       class="input input-sm w-full" autocomplete="off">
                                <datalist id="search-city-list">
                                    @foreach($citylist as $city)
                                        <option value="{{ $city }}">
                                    @endforeach
                                </datalist>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Type</legend>
                                <select name="type" class="select select-sm w-full">
                                    <option value="">Any Type</option>
                                    <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Status</legend>
                                <select name="status" class="select select-sm w-full">
                                    <option value="">Any Status</option>
                                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Bedrooms</legend>
                                <select name="bedroom" class="select select-sm w-full">
                                    <option value="">Any</option>
                                    @foreach($bedroomdistinct as $b)
                                        <option value="{{ $b->bedroom }}" {{ request('bedroom') == $b->bedroom ? 'selected' : '' }}>{{ $b->bedroom }}</option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Bathrooms</legend>
                                <select name="bathroom" class="select select-sm w-full">
                                    <option value="">Any</option>
                                    @foreach($bathroomdistinct as $b)
                                        <option value="{{ $b->bathroom }}" {{ request('bathroom') == $b->bathroom ? 'selected' : '' }}>{{ $b->bathroom }}</option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <div class="grid grid-cols-2 gap-2">
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Min Price</legend>
                                    <input type="number" name="minprice" value="{{ request('minprice') }}"
                                           placeholder="0" class="input input-sm w-full">
                                </fieldset>
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Max Price</legend>
                                    <input type="number" name="maxprice" value="{{ request('maxprice') }}"
                                           placeholder="Any" class="input input-sm w-full">
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Min Area</legend>
                                    <input type="number" name="minarea" value="{{ request('minarea') }}"
                                           placeholder="0" class="input input-sm w-full">
                                </fieldset>
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Max Area</legend>
                                    <input type="number" name="maxarea" value="{{ request('maxarea') }}"
                                           placeholder="Any" class="input input-sm w-full">
                                </fieldset>
                            </div>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="featured" class="checkbox checkbox-primary checkbox-sm"
                                       {{ request('featured') ? 'checked' : '' }}>
                                <span class="text-sm">Featured only</span>
                            </label>

                            <button type="submit" class="btn btn-primary btn-sm w-full gap-1">
                                <span class="material-icons text-sm">search</span> Search
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- Results --}}
            <div class="lg:col-span-3">
                <h1 class="text-2xl font-bold mb-6">
                    Search Results
                    <span class="text-base font-normal text-base-content/50">({{ $properties->total() }} found)</span>
                </h1>

                <div class="space-y-4">
                    @forelse($properties as $property)
                    <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                        @php($cover = $property->gallery->first())
                        @if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path))
                        <figure class="w-44 shrink-0">
                            <img src="{{ Storage::url($cover->file_path) }}" alt="{{ $property->title }}"
                                 class="h-full w-full object-cover">
                        </figure>
                        @elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image)))
                        <figure class="w-44 shrink-0">
                            @php($legacyPath = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image)
                            <img src="{{ Storage::url($legacyPath) }}" alt="{{ $property->title }}"
                                 class="h-full w-full object-cover">
                        </figure>
                        @endif
                        <div class="card-body p-4">
                            <a href="{{ route('property.show', $property->slug) }}">
                                <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                                    {{ $property->title }}
                                </h3>
                            </a>
                            <p class="flex items-center gap-1 text-sm text-base-content/60">
                                <span class="material-icons text-sm">location_city</span>{{ ucfirst($property->city) }}
                                <span class="material-icons text-sm ml-1">place</span>{{ ucfirst($property->address) }}
                            </p>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-lg font-bold text-primary">
                                    Ksh {{ number_format($property->price ?? 0) }}
                                </span>
                                <span class="badge badge-outline badge-sm">{{ ucfirst($property->type) }} · {{ ucfirst($property->status) }}</span>
                            </div>
                            <div class="flex flex-wrap gap-3 text-xs text-base-content/60 mt-1">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> {{ $property->bedroom }} bed</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> {{ $property->bathroom }} bath</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> {{ $property->area }} sqft</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">comment</span> {{ $property->comments_count }}</span>
                                @if($property->is_featured)
                                    <span class="badge badge-warning badge-sm ml-auto">Featured</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert">
                        <span class="material-icons">info</span>
                        No properties found matching your criteria.
                    </div>
                    @endforelse
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $properties->appends([
                        'city'      => request('city'),
                        'type'      => request('type'),
                        'status'    => request('status'),
                        'bedroom'   => request('bedroom'),
                        'bathroom'  => request('bathroom'),
                        'minprice'  => request('minprice'),
                        'maxprice'  => request('maxprice'),
                        'minarea'   => request('minarea'),
                        'maxarea'   => request('maxarea'),
                        'featured'  => request('featured'),
                    ])->links() }}
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
