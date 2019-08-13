@extends('layouts.app')

@section('content')
<div class="bg-grey-lighter font-sans">
        <div class="container mx-auto flex justify-center">
            <div class="lg:w-1/3 sm:w-screen">
                <div>
                    <div class="font-hairline mb-6 text-center text-3xl">{{ __('Register Here') }}</div>

                    <div class="p-8 bg-white mb-6 shadow-lg rounded-lg" style="border-top: 1rem solid #2eaef1;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="font-bold text-grey-darker block mb-2 text-lg">{{ __('Name') }}</label>

                            <div class="mb-6">
                                <input id="name" type="text" class="block appearance-none w-full bg-white border
                                border-grey-light hover:border-grey px-2 py-2 shadow text-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="font-bold text-grey-darker block mb-2 text-lg">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 shadow text-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="font-bold text-grey-darker block mb-2 text-lg">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 shadow text-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="font-bold text-grey-darker block mb-2 text-lg">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 shadow text-lg" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button bg-blue hover:bg-blue-light">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-center">Already have an account? <a href="{{ route('login') }}" class="text-primary-blue-dark">Signin Here</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
