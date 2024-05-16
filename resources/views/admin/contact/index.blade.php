@extends('layouts.template')

@section('content')
    <div class="mt-5 mx-5">
        <table class="min-w-full border-gray-700 bg-white shadow-md rounded-lg overflow-hidden mb-5">
            <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/11 py-2 px-4">Name</th>
                <th class="w-1/11 py-2 px-4">Email</th>
                <th class="w-7/11 py-2 px-4">Comment</th>
                <th class="w-2/11 py-2 px-4">Reçu le</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($comments as $index => $com)
                <tr>
                    <td class="border border-gray-300 py-2 px-4">{{ $com->name }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $com->email }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $com->comment }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ \App\Helpers\Dates::clean($com->created_at, true) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $comments->links() }}
@endsection
