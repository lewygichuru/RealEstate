@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title">Edit Property</h2>
                            <a href="{{ route('agent.properties.index') }}" class="btn btn-outline btn-sm gap-1">
                                <span class="material-icons text-sm">arrow_back</span> Back
                            </a>
                        </div>

                        <form action="{{ route('agent.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf
                            @method('PUT')

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Title</legend>
                                <input type="text" name="title" value="{{ old('title', $property->title) }}" class="input w-full" maxlength="200" required>
                            </fieldset>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Type</legend>
                                    <input type="text" name="type" value="{{ old('type', $property->type) }}" class="input w-full" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Status</legend>
                                    @php($statusValue = old('status', $property->status))
                                    <select name="status" class="select w-full" required>
                                        <option value="available" @selected($statusValue === 'available')>Available</option>
                                        <option value="rented" @selected($statusValue === 'rented')>Rented</option>
                                        <option value="maintenance" @selected($statusValue === 'maintenance')>Maintenance</option>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Price</legend>
                                    <input type="number" name="price" value="{{ old('price', $property->price) }}" class="input w-full" required>
                                </fieldset>
                                <div class="sm:col-span-2">
                                    @include('partials.property-location', ['as_textarea' => true])
                                </div>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Description</legend>
                                <textarea name="description" rows="5" class="textarea w-full" required>{{ old('description', $property->description) }}</textarea>
                            </fieldset>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" value="1" class="checkbox checkbox-primary" @checked(old('is_featured', $property->is_featured))>
                                <span class="label-text">Featured Property</span>
                            </div>

                            @include('partials.property-amenities')

                            <div class="divider">Unit Details</div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Number</legend>
                                    <input type="text" name="unit_number" class="input w-full" value="{{ old('unit_number', $unit?->unit_number ?? '') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Floor</legend>
                                    <input type="number" name="floor" class="input w-full" value="{{ old('floor', $unit?->floor ?? '') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bedrooms</legend>
                                    <input type="number" name="bedroom" class="input w-full" value="{{ old('bedroom', $unit?->bedrooms ?? '') }}" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bathrooms</legend>
                                    <input type="number" name="bathroom" class="input w-full" value="{{ old('bathroom', $unit?->bathrooms ?? '') }}" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Size (sqft)</legend>
                                    <input type="number" name="size_sqft" class="input w-full" value="{{ old('size_sqft', $unit?->size_sqft ?? '') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Rent Amount</legend>
                                    <input type="number" name="rent_amount" class="input w-full" value="{{ old('rent_amount', $unit?->rent_amount ?? '') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Deposit Amount</legend>
                                    <input type="number" name="deposit_amount" class="input w-full" value="{{ old('deposit_amount', $unit?->deposit_amount ?? '') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Status</legend>
                                    @php($unitStatusValue = old('unit_status', $unit?->status ?? 'available'))
                                    <select name="unit_status" class="select w-full">
                                        <option value="available" @selected($unitStatusValue === 'available')>Available</option>
                                        <option value="occupied" @selected($unitStatusValue === 'occupied')>Occupied</option>
                                        <option value="maintenance" @selected($unitStatusValue === 'maintenance')>Maintenance</option>
                                    </select>
                                </fieldset>
                                <fieldset class="fieldset sm:col-span-2">
                                    <legend class="fieldset-legend">Unit Notes</legend>
                                    <textarea name="unit_notes" rows="3" class="textarea w-full">{{ old('unit_notes', $unit?->notes ?? '') }}</textarea>
                                </fieldset>
                            </div>

                            @if($property->gallery->count())
                            <div>
                                <p class="text-sm font-semibold mb-2">Gallery</p>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    @foreach($property->gallery as $gallery)
                                    <img class="w-full h-24 object-cover rounded-box" src="{{ $gallery->file_path }}" alt="{{ $gallery->file_name }}">
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Add Gallery Image</legend>
                                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
                                <p class="fieldset-label">Uploading an image adds it to the property gallery</p>
                            </fieldset>

                            <div>
                                <button type="submit" class="btn btn-primary gap-2">
                                    <span class="material-icons text-sm">save</span> Update Property
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
