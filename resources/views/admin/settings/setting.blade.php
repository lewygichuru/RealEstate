@extends('backend.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-2xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">General Settings</h2>
            <a href="{{ route('admin.profile') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </div>
        <form action="{{ route('admin.settings.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Site Title</legend>
                    <input type="text" name="name" value="{{ $settings->name ?? '' }}" class="input w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Email</legend>
                    <input type="email" name="email" value="{{ $settings->email ?? '' }}" class="input w-full">
                </fieldset>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Phone</legend>
                    <input type="text" name="phone" value="{{ $settings->phone ?? '' }}" class="input w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Footer Text</legend>
                    <input type="text" name="footer" value="{{ $settings->footer ?? '' }}" class="input w-full">
                </fieldset>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Address</legend>
                <input type="text" name="address" value="{{ $settings->address ?? '' }}" class="input w-full">
                <p class="fieldset-label">HTML tags allowed</p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">About Us</legend>
                <textarea name="aboutus" rows="4" class="textarea w-full">{{ $settings->aboutus ?? '' }}</textarea>
            </fieldset>

            <div class="divider text-sm">Social Links</div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Facebook</legend>
                    <input type="text" name="facebook" value="{{ $settings->facebook ?? '' }}" class="input w-full" placeholder="username">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Twitter</legend>
                    <input type="text" name="twitter" value="{{ $settings->twitter ?? '' }}" class="input w-full" placeholder="username">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">LinkedIn</legend>
                    <input type="text" name="linkedin" value="{{ $settings->linkedin ?? '' }}" class="input w-full" placeholder="username">
                </fieldset>
            </div>

            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
