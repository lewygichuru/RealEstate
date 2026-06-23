@extends('backend.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Profile</h2>
            <a href="{{ route('admin.changepassword') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">lock</span> Change Password
            </a>
        </div>
        <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Name</legend>
                    <input type="text" name="name" value="{{ $profile->name ?? '' }}" class="input w-full" required>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Username</legend>
                    <input type="text" name="username" value="{{ $profile->username ?? '' }}" class="input w-full">
                </fieldset>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Email</legend>
                <input type="email" name="email" value="{{ $profile->email ?? '' }}" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Profile Image</legend>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">About</legend>
                <textarea name="about" rows="4" class="textarea w-full">{{ $profile->about ?? '' }}</textarea>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
