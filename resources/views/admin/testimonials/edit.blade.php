@extends('backend.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Testimonial</h2>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" name="name" value="{{ $testimonial->name }}" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Testimonial</legend>
                <textarea name="content" rows="4" class="textarea w-full">{{ $testimonial->content }}</textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Image</legend>
                @if(Storage::disk('public')->exists('testimonial/'.$testimonial->image))
                    <img src="{{ Storage::url('testimonial/'.$testimonial->image) }}" id="testimonial-preview" alt="{{ $testimonial->name }}" class="w-24 h-24 object-cover rounded-full mb-2">
                @else
                    <img src="" id="testimonial-preview" class="w-24 h-24 object-cover rounded-full mb-2 hidden">
                @endif
                <input type="file" name="image" id="testimonial-image-input" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('testimonial-image-input').addEventListener('change', function() {
    var preview = document.getElementById('testimonial-preview');
    if (this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endpush
