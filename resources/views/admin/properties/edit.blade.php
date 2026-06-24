@extends('backend.layouts.app')

@section('title', 'Edit Property')

@section('content')
<form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Left column --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-4">
                <h2 class="card-title">Edit Property</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <fieldset class="fieldset sm:col-span-2"><legend class="fieldset-legend">Title</legend>
                        <input type="text" name="title" class="input w-full" value="{{ old('title', $property->title) }}" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Type</legend>
                        <input type="text" name="type" class="input w-full" value="{{ old('type', $property->type) }}" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Status</legend>
                        <select name="status" class="select w-full" required>
                            @php($statusValue = old('status', $property->status))
                            <option value="available" @selected($statusValue === 'available')>Available</option>
                            <option value="rented" @selected($statusValue === 'rented')>Rented</option>
                            <option value="maintenance" @selected($statusValue === 'maintenance')>Maintenance</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Price ($)</legend>
                        <input type="number" name="price" class="input w-full" value="{{ old('price', $property->price) }}" required>
                    </fieldset>
                    <div class="sm:col-span-2">
                        @include('partials.property-location')
                    </div>
                </div>
                <label class="label cursor-pointer gap-2 justify-start w-fit">
                    <input type="checkbox" name="is_featured" value="1" class="checkbox checkbox-primary checkbox-sm" @checked(old('is_featured', $property->is_featured))>
                    <span>Featured Property</span>
                </label>
                <fieldset class="fieldset"><legend class="fieldset-legend">Description</legend>
                    <textarea name="description" id="tinymce" rows="8" class="textarea w-full">{{ old('description', $property->description) }}</textarea>
                </fieldset>
                @include('partials.property-amenities')
            </div>
        </div>


        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-4">
                <h3 class="font-bold">Unit Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <fieldset class="fieldset"><legend class="fieldset-legend">Unit Number</legend>
                        <input type="text" name="unit_number" class="input w-full" value="{{ old('unit_number', $unit?->unit_number ?? '') }}">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Floor</legend>
                        <input type="number" name="floor" class="input w-full" value="{{ old('floor', $unit?->floor ?? '') }}">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Bedrooms</legend>
                        <input type="number" name="bedroom" class="input w-full" value="{{ old('bedroom', $unit?->bedrooms ?? '') }}" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Bathrooms</legend>
                        <input type="number" name="bathroom" class="input w-full" value="{{ old('bathroom', $unit?->bathrooms ?? '') }}" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Size (sqft)</legend>
                        <input type="number" name="size_sqft" class="input w-full" value="{{ old('size_sqft', $unit?->size_sqft ?? '') }}">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Rent Amount</legend>
                        <input type="number" name="rent_amount" class="input w-full" value="{{ old('rent_amount', $unit?->rent_amount ?? '') }}">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Deposit Amount</legend>
                        <input type="number" name="deposit_amount" class="input w-full" value="{{ old('deposit_amount', $unit?->deposit_amount ?? '') }}">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Unit Status</legend>
                        @php($unitStatusValue = old('unit_status', $unit?->status ?? 'available'))
                        <select name="unit_status" class="select w-full">
                            <option value="available" @selected($unitStatusValue === 'available')>Available</option>
                            <option value="occupied" @selected($unitStatusValue === 'occupied')>Occupied</option>
                            <option value="maintenance" @selected($unitStatusValue === 'maintenance')>Maintenance</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset sm:col-span-2"><legend class="fieldset-legend">Unit Notes</legend>
                        <textarea name="unit_notes" rows="3" class="textarea w-full">{{ old('unit_notes', $unit?->notes ?? '') }}</textarea>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="space-y-4">
        @if($property->gallery->count())
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">Gallery</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach($property->gallery as $gallery)
                    <img src="{{ $gallery->file_path }}" alt="{{ $gallery->file_name }}" class="w-full h-24 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">Add Gallery Image</h3>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
                <p class="text-xs text-base-content/60">Uploading an image adds it to the property gallery.</p>
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline gap-1">
                        <span class="material-icons text-sm">arrow_back</span> Back
                    </a>
                    <button type="submit" class="btn btn-primary gap-1">
                        <span class="material-icons text-sm">save</span> Update
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            tinymce.init({ selector: "textarea#tinymce", theme: "modern", height: 300,
                plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak','searchreplace wordcount visualblocks visualchars code fullscreen','insertdatetime media nonbreaking save table contextmenu directionality','emoticons template paste textcolor colorpicker textpattern imagetools'],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons', image_advtab: true
            });
            tinymce.suffix = ".min"; tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });

        // Ensure TinyMCE content is saved before form submission
        $('form').on('submit', function(e) {
            if (typeof tinymce !== 'undefined' && tinymce.get('tinymce')) {
                tinymce.triggerSave();
            }
        });
    </script>
@endpush
