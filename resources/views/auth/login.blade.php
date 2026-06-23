@extends('frontend.layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center">{{ __('Login') }}</h1>

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
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

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">{{ __('Password') }}</legend>
                            <input id="password" type="password" name="password"
                                   class="input w-full {{ $errors->has('password') ? 'input-error' : '' }}"
                                   required>
                            @if($errors->has('password'))
                                <p class="fieldset-label text-error">{{ $errors->first('password') }}</p>
                            @endif
                        </fieldset>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <span class="text-sm">{{ __('Remember Me') }}</span>
                        </label>

                        <div class="flex items-center gap-4 mt-1">
                            <button type="submit" class="btn btn-primary flex-1">{{ __('Login') }}</button>
                            <a href="{{ route('password.request') }}" class="link link-primary text-sm whitespace-nowrap">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>

                        <div class="divider text-xs my-0">Don't have an account?</div>
                        <a href="{{ route('register') }}" class="btn btn-outline btn-sm w-full">
                            {{ __('Create Account') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
