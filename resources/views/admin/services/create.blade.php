@extends('backend.layouts.app')

@section('title', 'Create Service')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Create Service</h2>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="{{ route('admin.services.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Service Title</legend>
                <input type="text" name="title" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Description</legend>
                <textarea name="description" rows="4" class="textarea w-full"></textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Icon</legend>
                <input type="text" name="icon" class="input w-full" placeholder="e.g. home, business, search">
                <p class="fieldset-label">Use <a href="https://fonts.google.com/icons" target="_blank" class="link link-primary">Material Icons</a> names</p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Order</legend>
                <input type="number" name="order" class="input w-full" min="1">
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
