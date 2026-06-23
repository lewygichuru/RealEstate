@extends('backend.layouts.app')

@section('title', 'Edit Post')

@section('content')
@php
    $selectedCategories = $post->categories->pluck('id')->toArray();
    $selectedTags = $post->tags->pluck('id')->toArray();
@endphp
<form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body gap-4">
            <div class="flex items-center justify-between">
                <h2 class="card-title">Edit Post</h2>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline btn-sm gap-1">
                    <span class="material-icons text-sm">arrow_back</span> Back
                </a>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Post Title</legend>
                <input type="text" name="title" value="{{ $post->title }}" class="input w-full" required>
            </fieldset>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="published" name="status" value="1" class="checkbox checkbox-primary" {{ $post->status ? 'checked' : '' }}>
                <label for="published" class="label-text cursor-pointer">Published</label>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Body</legend>
                <textarea name="body" id="tinymce" class="textarea w-full min-h-48">{{ $post->body }}</textarea>
            </fieldset>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm h-fit">
        <div class="card-body gap-4">
            <h2 class="card-title text-base">Post Options</h2>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Categories</legend>
                <select name="categories[]" multiple class="select w-full h-28">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tags</legend>
                <select name="tags[]" multiple class="select w-full h-28">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Featured Image</legend>
                @if(Storage::disk('public')->exists('posts/'.$post->image))
                    <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}" class="h-20 rounded-box object-cover mb-2">
                @endif
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <button type="submit" class="btn btn-primary gap-2">
                <span class="material-icons text-sm">save</span> Update Post
            </button>
        </div>
    </div>

</div>
</form>
@endsection

@push('scripts')
<script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
<script>
tinymce.init({
    selector: 'textarea#tinymce',
    height: 350,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
});
tinymce.suffix = '.min';
tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
</script>
@endpush
