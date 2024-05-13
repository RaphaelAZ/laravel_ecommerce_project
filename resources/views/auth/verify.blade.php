@extends('layouts.template')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl font-bold mb-4">{{ __('Verify Your Email Address') }}</h2>

        <div class="mb-4">
            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </div>
            @endif

            <p class="mb-2">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p class="mb-2">{{ __('If you did not receive the email') }},</p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="text-blue-500 hover:text-blue-700">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
