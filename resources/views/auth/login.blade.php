@extends('layouts.app')

@section('content')
<div class="bg-grey-lighter font-sans">
    <div class="container mx-auto flex justify-center">
        <div class="lg:w-1/3 sm:w-screen">
            <div>
                <div class="font-hairline mb-6 text-center text-3xl">{{ __('Login') }}</div>

                <div class="p-8 bg-white mb-6 shadow-lg rounded-lg" style="border-top: 1rem solid #2eaef1;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mb-6">
                            <label for="email" class="font-bold text-grey-darker block mb-2 text-lg">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email"
                                    type="email"
                                    class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 shadow text-lg @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Your Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <label for="password" class="font-bold text-grey-darker block mb-2 text-xl">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password"
                                    type="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 shadow text-lg @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="Your Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="flex justify-between">
                                <button type="submit" class="button bg-blue hover:bg-blue-light text-lg">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-center">Don't have an account? <a href="{{ route('register') }}">Create Account</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
