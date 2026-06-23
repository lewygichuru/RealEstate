@extends('backend.layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="card bg-base-100 shadow-sm max-w-md">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Change Password</h2>
            <a href="{{ route('admin.profile') }}" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </div>
        <form action="{{ route('admin.changepassword') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Current Password</legend>
                <input type="password" name="currentpassword" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">New Password</legend>
                <input type="password" name="newpassword" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Confirm New Password</legend>
                <input type="password" name="newpassword_confirmation" class="input w-full" required>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">lock</span> Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
