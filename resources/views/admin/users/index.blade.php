@extends('layouts.template')

@section('content')
    <div class="overflow-x-auto mt-5 mx-5">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/4 py-2 px-4">ID</th>
                    <th class="w-1/4 py-2 px-4">Nom</th>
                    <th class="w-1/4 py-2 px-4">Email</th>
                    <th class="w-1/4 py-2 px-4">Rôle</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($users as $user)
                <tr>
                    <td class="border border-gray-300 py-2 px-4">{{ $user->id }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $user->name }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $user->email }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $user->role }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop