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
                            <h2 class="card-title">Create Property</h2>
                            <a href="{{ route('agent.properties.index') }}" class="btn btn-outline btn-sm gap-1">
                                <span class="material-icons text-sm">arrow_back</span> Back
                            </a>
                        </div>

                        <form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Title</legend>
                                <input type="text" name="title" class="input w-full" value="{{ old('title') }}" maxlength="200" required>
                            </fieldset>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Type</legend>
                                    <input type="text" name="type" class="input w-full" value="{{ old('type') }}" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Status</legend>
                                    @php($statusValue = old('status', 'available'))
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
                                    <input type="number" name="price" class="input w-full" value="{{ old('price') }}" required>
                                </fieldset>
                                <div class="sm:col-span-2">
                                    @include('partials.property-location', ['as_textarea' => true])
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" value="1" class="checkbox checkbox-primary" @checked(old('is_featured'))>
                                <span class="label-text">Featured Property</span>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Description</legend>
                                <textarea name="description" rows="5" class="textarea w-full" required>{{ old('description') }}</textarea>
                            </fieldset>

                            @include('partials.property-amenities')

                            <div class="divider">Unit Details</div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Number</legend>
                                    <input type="text" name="unit_number" class="input w-full" value="{{ old('unit_number') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Floor</legend>
                                    <input type="number" name="floor" class="input w-full" value="{{ old('floor') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bedrooms</legend>
                                    <input type="number" name="bedroom" class="input w-full" value="{{ old('bedroom') }}" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bathrooms</legend>
                                    <input type="number" name="bathroom" class="input w-full" value="{{ old('bathroom') }}" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Size (sqft)</legend>
                                    <input type="number" name="size_sqft" class="input w-full" value="{{ old('size_sqft') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Rent Amount</legend>
                                    <input type="number" name="rent_amount" class="input w-full" value="{{ old('rent_amount') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Deposit Amount</legend>
                                    <input type="number" name="deposit_amount" class="input w-full" value="{{ old('deposit_amount') }}">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Status</legend>
                                    @php($unitStatusValue = old('unit_status', 'available'))
                                    <select name="unit_status" class="select w-full">
                                        <option value="available" @selected($unitStatusValue === 'available')>Available</option>
                                        <option value="occupied" @selected($unitStatusValue === 'occupied')>Occupied</option>
                                        <option value="maintenance" @selected($unitStatusValue === 'maintenance')>Maintenance</option>
                                    </select>
                                </fieldset>
                                <fieldset class="fieldset sm:col-span-2">
                                    <legend class="fieldset-legend">Unit Notes</legend>
                                    <textarea name="unit_notes" rows="3" class="textarea w-full">{{ old('unit_notes') }}</textarea>
                                </fieldset>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Gallery Image</legend>
                                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full" required>
                                <p class="fieldset-label">Uploaded image is added to the property gallery</p>
                            </fieldset>

                            <div>
                                <button type="submit" class="btn btn-primary gap-2">
                                    <span class="material-icons text-sm">send</span> Submit
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
