@extends('layouts.template')

@section('content')

    <div class="mt-5 mx-5 grid gap-y-24">
        @foreach($orders as $state => $allOrders)
            <div class="">
                <h1 class="text-center text-3xl font-bold">{{ $state }}</h1>

                <table class="min-w-full border-gray-700 bg-white shadow-md rounded-lg overflow-hidden mb-5">
                    <thead class="bg-gray-800 text-white">
                    <tr class="*:border-l *:border-white">
                        <th class="py-2 px-4">N°</th>
                        <th class="py-2 px-4">Utilisateur</th>
                        <th class="py-2 px-4">Total</th>
                        <th class="py-2 px-4">Reçue le</th>
                        <th class="py-2 px-4"><iconify-icon icon="mdi:gear"></iconify-icon></th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($allOrders as $index => $order)
                        <tr class="*:border *:border-gary-300 *:py-2 *:px-4">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->total }} €</td>
                            <td>{{ \App\Helpers\Dates::clean($order->created_at, true) }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('orders.admin.single', $order->id) }}">
                                    <iconify-icon icon="mdi:eye"></iconify-icon>
                                    Voir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @endforeach
    </div>
@endsection
