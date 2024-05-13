@extends('layouts.template')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl font-bold mb-4">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold">{{ __('Username') }}</label>
                <input id="name" type="text" class="form-input mt-1 block w-full border border-gray-300 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-input mt-1 block w-full border border-gray-300 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-semibold">{{ __('Address') }}</label>
                <input id="address" type="text" class="form-input mt-1 block w-full border border-gray-300 @error('address') border-red-500 @enderror" name="address" required autocomplete="address">
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="city" class="block text-sm font-semibold">{{ __('City') }}</label>
                <input id="city" type="text" class="form-input mt-1 block w-full border border-gray-300 @error('city') border-red-500 @enderror" name="city" required autocomplete="city">
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="zipcode" class="block text-sm font-semibold">{{ __('Zip Code') }}</label>
                <input id="zipcode" type="text" class="form-input mt-1 block w-full border border-gray-300 @error('zipcode') border-red-500 @enderror" name="zipcode" required autocomplete="zipcode">
                @error('zipcode')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-semibold">{{ __('Phone') }}</label>
                <input id="phone" type="text" class="form-input mt-1 block w-full border border-gray-300 @error('phone') border-red-500 @enderror" name="phone" required autocomplete="phone">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input mt-1 block w-full border border-gray-300 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-semibold">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-input mt-1 block w-full border border-gray-300 @error('password-confirm') border-red-500 @enderror" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">{{ __('Register') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
