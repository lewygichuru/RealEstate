@extends('backend.layouts.app')

@section('title', 'Edit Album')

@section('content')
<div class="max-w-2xl mx-auto card bg-base-100 shadow-sm h-fit">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title text-base">Edit Album</h2>
            <a href="{{ route('admin.album') }}" class="btn btn-sm btn-outline gap-2">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.album.update', $album->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Album Name</legend>
                <input type="text" name="name" class="input w-full" value="{{ $album->title }}" required>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Update Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
