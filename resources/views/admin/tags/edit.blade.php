@extends('backend.layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-lg">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Tag</h2>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tag Name</legend>
                <input type="text" name="name" value="{{ $tag->name }}" class="input w-full" required>
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
