@extends('layouts.template')

@section('content')
    <div class="max-w-md mx-auto mt-5 bg-white shadow-md rounded-md overflow-hidden mb-6">
        <div class="p-4">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Informations de votre compte</h2>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Nom</label>
                <span>{{ $user->name }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Email</label>
                <span>{{ $user->email }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Téléphone</label>
                <span>{{ $user->phone }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Ville</label>
                <span>{{ $user->city }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Code Postal</label>
                <span>{{ $user->zipcode }}</span>
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Adresse</label>
                <span>{{ $user->address }}</span>
            </div>
            <div class="mt-6 mb-4">
                <a href="{{ route('commandes.index') }}" class="btn btn-primary">
                    <iconify-icon icon="mdi:cart"></iconify-icon>
                    Historique des commandes
                </a>
            </div>
            
        </div>
    </div>
@stop
