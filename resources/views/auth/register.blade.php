@extends('frontend.layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center">{{ __('Create Account') }}</h1>

                    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                        @csrf

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Full Name') }}</legend>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                   class="input w-full {{ $errors->has('name') ? 'input-error' : '' }}"
                                   required autofocus>
                            @if($errors->has('name'))
                                <p class="fieldset-label text-error">{{ $errors->first('name') }}</p>
                            @endif
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('E-Mail Address') }}</legend>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="input w-full {{ $errors->has('email') ? 'input-error' : '' }}"
                                   required>
                            @if($errors->has('email'))
                                <p class="fieldset-label text-error">{{ $errors->first('email') }}</p>
                            @endif
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Password') }}</legend>
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

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="agent" class="checkbox checkbox-primary checkbox-sm">
                            <span class="text-sm">{{ __('Register as Agent') }}</span>
                        </label>

                        <button type="submit" class="btn btn-primary w-full mt-1">{{ __('Register') }}</button>

                        <div class="divider text-xs my-0">Already have an account?</div>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-sm w-full">{{ __('Login') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
