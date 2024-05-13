@extends('layouts.template')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl font-bold mb-4">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-input mt-1 block w-full border border-gray-300 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input mt-1 block w-full border border-gray-300 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-checkbox">
                <label for="remember" class="ml-2">{{ __('Remember Me') }}</label>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-600 ml-2">{{ __('Forgot Your Password?') }}</a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
