@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Change Password</h2>

                        <form action="{{ route('agent.changepassword.update') }}" method="POST" class="flex flex-col gap-4 max-w-md">
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
            </div>

        </div>
    </div>
</section>
@endsection
