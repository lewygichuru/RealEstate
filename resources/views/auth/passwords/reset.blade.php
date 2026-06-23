@extends('frontend.layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center">{{ __('Reset Password') }}</h1>

                    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-4">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('E-Mail Address') }}</legend>
                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                                   class="input w-full {{ $errors->has('email') ? 'input-error' : '' }}"
                                   required autofocus>
                            @if($errors->has('email'))
                                <p class="fieldset-label text-error">{{ $errors->first('email') }}</p>
                            @endif
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('New Password') }}</legend>
                            <input id="password" type="password" name="password"
                                   class="input w-full {{ $errors->has('password') ? 'input-error' : '' }}"
                                   required>
                            @if($errors->has('password'))
                                <p class="fieldset-label text-error">{{ $errors->first('password') }}</p>
                            @endif
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Confirm Password') }}</legend>
                            <input id="password-confirm" type="password" name="password_confirmation"
                                   class="input w-full" required>
                        </fieldset>

                        <button type="submit" class="btn btn-primary w-full mt-1">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
