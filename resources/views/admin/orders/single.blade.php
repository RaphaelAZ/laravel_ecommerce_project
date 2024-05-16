@extends('layouts.template')

@section('content')
<div class="container mx-auto mt-4 grid gap-y-16">
    <h1 class="text-3xl text-center w-full font-bold">Commande N°{{ $order->id }}</h1>

    <!--container infos order-->
    <div>
        <h2 class="text-xl text-center w-full font-medium pb-2">Détails de la commande</h2>

        <table class="min-w-full border-gray-700 bg-white shadow-md rounded-lg overflow-hidden mb-5">
            <thead class="bg-gray-800 text-white">
            <tr class="*:border-l *:border-white *:py-2 *:px-4">
                <th>Code commande</th>
                <th>Utilisateur</th>
                <th>Total</th>
                <th>Etat</th>
                <th>Reçue le</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            <tr class="*:border *:border-gary-300 *:py-2 *:px-4">
                <td>{{ $order->id }}</td>
                <td>
                    {{ $order->user->name }}<br/>
                    (<a class="underline" href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>)
                </td>
                <td>{{ $total }} €</td>
                <td>{{ $order->etat->state }}</td>
                <td>{{ \App\Helpers\Dates::clean($order->created_at, true) }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--container items order-->
    <div>
        <h2 class="text-xl text-center w-full font-medium pb-2">{{ $nbrProducts }} Item{{ $nbrProducts > 1 ? 's' : '' }} dans la commande</h2>

        <table class="min-w-full border-gray-700 bg-white shadow-md rounded-lg overflow-hidden mb-5">
            <thead class="bg-gray-800 text-white">
            <tr class="*:border-l *:border-white *:py-2 *:px-4">
                <th>N°</th>
                <th>Nom</th>
                <th>Quantité commande</th>
                <th>Total item</th>
                <th>Stock</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($order->products as $index => $product)
                <tr class="*:border *:border-gary-300 *:py-2 *:px-4">
                    <td>{{ $product->id }}</td>
                    <td>
                        <a class="underline" href="{{ route('products.show', $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ round($product->pivot->quantity * $product->price,2) }} €</td>
                    <td>{{ $product->stock }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!--container actions-->
    <div class="">
        <h2 class="text-xl text-center w-full font-medium pb-2">Actions</h2>

        <form
            class="grid grid-cols-4 gap-x-8"
            method="POST"
            action="{{ route('orders.admin.change') }}"
        >
            @CSRF

            <!--hidden input for order ID-->
            <input type="hidden" value="{{ $order->id }}" name="__order_id">

            <!--container change state-->
            <div class="w-full col-start-1 col-end-4">
                @include('components.select', [
                    "name" => "curr_state",
                    "required" => true,
                    "options" => $states,
                    "selected" => $order->state,
                    "authoriseEmpty" => false,
                ])
            </div>

            <!--submit button-->
            <button
                type="submit"
                class="btn btn-primary flex justify-center h-fit"
            >
                <iconify-icon icon="material-symbols:send"></iconify-icon>
                Modifier état
            </button>
        </form>
    </div>
</div>
@endsection
