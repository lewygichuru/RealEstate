@extends('frontend.layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center">{{ __('Forgot Password') }}</h1>
                    <p class="text-sm text-base-content/60 text-center">
                        Enter your email address and we'll send you a password reset link.
                    </p>

                    @if(session('status'))
                        <div class="alert alert-success">
                            <span class="material-icons">check_circle</span>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                        @csrf

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('E-Mail Address') }}</legend>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="input w-full {{ $errors->has('email') ? 'input-error' : '' }}"
                                   required autofocus>
                            @if($errors->has('email'))
                                <p class="fieldset-label text-error">{{ $errors->first('email') }}</p>
                            @endif
                        </fieldset>

                        <button type="submit" class="btn btn-primary w-full">
                            {{ __('Send Password Reset Link') }}
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="link link-primary text-sm">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
