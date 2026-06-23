@extends('backend.layouts.app')

@section('title', 'Create Post')

@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body gap-4">
            <div class="flex items-center justify-between">
                <h2 class="card-title">Create Post</h2>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline btn-sm gap-1">
                    <span class="material-icons text-sm">arrow_back</span> Back
                </a>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Post Title</legend>
                <input type="text" name="title" value="{{ old('title') }}" class="input w-full" required>
            </fieldset>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="published" name="status" value="1" class="checkbox checkbox-primary">
                <label for="published" class="label-text cursor-pointer">Published</label>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Body</legend>
                <textarea name="body" id="tinymce" class="textarea w-full min-h-48">{{ old('body') }}</textarea>
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
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tags</legend>
                <select name="tags[]" multiple class="select w-full h-28">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Featured Image</legend>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <button type="submit" class="btn btn-primary gap-2">
                <span class="material-icons text-sm">save</span> Save Post
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
