@extends('backend.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-lg">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Category Name</legend>
                <input type="text" name="name" value="{{ $category->name }}" class="input w-full" required>
            </fieldset>
            @if(Storage::disk('public')->exists('category/thumb/'.$category->image))
            <div>
                <img src="{{ Storage::url('category/thumb/'.$category->image) }}" alt="{{ $category->name }}" class="h-24 rounded-box object-cover">
            </div>
            @endif
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Replace Image</legend>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
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
