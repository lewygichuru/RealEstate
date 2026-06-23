@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('user.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Profile</h2>

                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Name</legend>
                                    <input type="text" name="name" value="{{ $profile->name }}" class="input w-full" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Username</legend>
                                    <input type="text" name="username" value="{{ $profile->username ?? '' }}" class="input w-full">
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Email</legend>
                                    <input type="email" name="email" value="{{ $profile->email }}" class="input w-full" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Profile Image</legend>
                                    <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
                                </fieldset>
                            </div>

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
            </div>

        </div>
    </div>
</section>
@endsection
