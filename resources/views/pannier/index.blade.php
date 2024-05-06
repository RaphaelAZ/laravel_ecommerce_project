@extends('layouts.template')

@php
    //Helpers
    use App\Helpers\Pannier;
@endphp

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl justify-center w-full my-8 flex items-center">
            <iconify-icon icon="mdi:cart" class="mr-4"></iconify-icon>
            Pannier
        </h1>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantité
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total HT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach(Pannier::getAll() as $index => $item)
                    @if(!empty($item))
                        @include('pannier.line', [
                            'produit' => $item->produit,
                            'quantite' => $item->quantite,
                            'itemNo' => $index + 1,
                        ])
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <h2>Total: {{ Pannier::getTotal() }} € <span class="font-light">HT</span></h2>
    </div>

@endsection
