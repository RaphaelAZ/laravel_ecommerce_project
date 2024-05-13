@extends('layouts.template')

@section('content')
    <h1 class="text-center text-3xl mt-4 flex items-center justify-center">
        <iconify-icon icon="mdi:timer-sand"></iconify-icon>
        Historique des commandes
    </h1>

    <hr class="my-4">

    <!--container tables-->
    <div class="relative overflow-x-auto container mx-auto">
        @foreach($commandes as $index => $commande)
            <!--container single table-->
            <div class="relative flex flex-col mx-8 mb-16 bg-gray-200 rounded p-4" data-id="{{ $index }}">
                <!--info commande-->
                <div class="flex flex-row items-center gap-x-8">
                    <p>Code commande <span class="font-bold">{{ $commande->id }}</span></p>
                    <p>Total <span class="font-bold">{{ str_replace(".",",",$commande->total) }} €</span></p>
                    <p>Nbr Items <span class="font-bold">{{ sizeof($commande->produits) }}</span></p>
                    <p>Etat <span class="font-bold">{{ $commande->etat }}</span></p>
                    <p>Date <span class="font-bold">{{ \App\Helpers\Dates::clean($commande->date) }}</span></p>

                    <button type="button" class="btn btn-primary" data-el="plus">
                        <iconify-icon icon="mdi:plus"></iconify-icon>
                    </button>

                    <button type="button" class="btn btn-primary hidden" data-el="minus">
                        <iconify-icon icon="mdi:minus"></iconify-icon>
                    </button>
                </div>

                <!--table produits-->
                <table data-el="table" class="w-full hidden text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        @foreach($commande->produits as $i => $produit)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <a href="{{ route('produits.show', $produit) }}">{{ $produit->nom }}</a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $produit->pivot->quantite }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ round($produit->pivot->quantite * $produit->prix,2) }} €
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
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
