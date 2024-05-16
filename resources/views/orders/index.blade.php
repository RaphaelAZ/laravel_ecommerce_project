@extends('layouts.template')

@section('content')
    <h1 class="text-center text-3xl mt-4 flex items-center justify-center">
        <iconify-icon icon="mdi:timer-sand"></iconify-icon>
        Historique des commandes
    </h1>

    <hr class="my-4">

    <!--container tables-->
    <div class="relative overflow-x-auto container mx-auto">
        @if(count($orders)>0)
            @foreach($orders as $index => $order)
                <!--container single table-->
                <div class="relative flex flex-col mx-8 mb-16 bg-gray-200 rounded p-4" data-id="{{ $index }}">
                    <!--info commande-->
                    <div class="flex flex-row items-center gap-x-8">
                        <p>Code commande <span class="font-bold">{{ $order->id }}</span></p>
                        <p>Total <span class="font-bold">{{ str_replace(".",",",$order->total) }} €</span></p>
                        <p>Nbr Items <span class="font-bold">{{ sizeof($order->products) }}</span></p>
                        <p>Etat <span class="font-bold">{{ optional($order->etat ?? $order)->state }}</span></p>
                        <p>Date <span class="font-bold">{{ \App\Helpers\Dates::clean($order->date) }}</span></p>
                        <button type="button" class="btn btn-primary" data-el="plus">
                            <iconify-icon icon="mdi:plus"></iconify-icon>
                        </button>

                        <button type="button" class="btn btn-primary hidden" data-el="minus">
                            <iconify-icon icon="mdi:minus"></iconify-icon>
                        </button>
                    </div>

                    <!--table products-->
                    <table data-el="table" class="w-full hidden text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-3">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantité
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total HT
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $i => $product)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 underline">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ round($product->pivot->quantity * $product->price,2) }} €
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @else
        <div class="max-w-md mx-auto mt-5 bg-white text-center overflow-hidden mb-6">
            <h2>Aucune commande passée sur ce compte</h2>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('[data-id]').forEach((el) => {
        //click sur 'plus'
        el.querySelector('[data-el="plus"]').addEventListener('click', (event) => {
            event.preventDefault()
            //Montrer btn moins
            el.querySelector('[data-el="minus"]').classList.remove('hidden')
            el.querySelector('[data-el="plus"]').classList.add('hidden')
            el.querySelector('[data-el="table"]').classList.remove('hidden')
        })

        //click sur moins
        el.querySelector('[data-el="minus"]').addEventListener('click', (event) => {
            event.preventDefault();
            //montrer plus
            el.querySelector('[data-el="minus"]').classList.add('hidden')
            el.querySelector('[data-el="plus"]').classList.remove('hidden')
            el.querySelector('[data-el="table"]').classList.add('hidden')
        })
    })
</script>
@endsection
