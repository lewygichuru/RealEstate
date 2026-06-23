@extends('backend.layouts.app')

@section('title', 'Edit Feature')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-lg">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Feature</h2>
            <a href="{{ route('admin.features.index') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.features.update', $feature->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Feature Name</legend>
                <input type="text" name="name" value="{{ $feature->name }}" class="input w-full" required>
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
