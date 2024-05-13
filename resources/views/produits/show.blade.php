@extends('layouts.template')

@php
//Helpers
use App\Helpers\Pannier;
@endphp

@section('content')
    <div class="grid grid-cols-2 grid-rows-1 gap-8 w-full my-8">
        <img
            class="col-start-1 col-end-2 w-full rounded-r-2xl overflow-hidden h-auto"
            id="main-photo"
            alt="hey"
            src="{{ $produit->image }}"
        >

        <div id="infos" class="col-start-2 col-end-3 flex flex-col">
            <!--container données-->
            <div class="h-fit mb-8">
                <h1 class="text-4xl font-extrabold">{{ $produit->nom }}</h1>
                <h3 class="text-2xl mt-4">{{ $produit->description }}</h3>
            </div>

            <hr class="mb-8">

            <div class="w-100 grid grid-cols-3 gap-4 text-xl text-center h-fit mb-8">
                <!--stock-->
                <p class="text-center font-dark flex items-center py-5 px-2 rounded justify-center" @class([
                    'bg-red-400 font-bold' => ($produit->stock <= 0),
                    'bg-orange-300 font-medium' => ($produit->stock <= 20 && $produit->stock > 0),
                ])>
                    @if(($produit->stock ?? 0) > 0)
                        {{ $produit->stock }} en stock.
                    @else
                        Aucun stock disponible.
                    @endif
                </p>

                <!--prix-->
                <div class="bg-gray-200 py-5 flex items-center px-2 text-xl flex-col">
                    <iconify-icon icon="material-symbols:euro"></iconify-icon>
                    <p class="" id="price">{{ $produit->prix }}</p>
                    <span class="font-light text-sm text-gray-600">Prix hors TTC.</span>
                </div>

                <!--usage-->
                <div class="flex items-center px-2 py-5 flex-col overflow-hidden">
                    <p class="text-center mb-4">Marque</p>
                    <p class="chip break-words w-100 text-sm">{{ $produit->marque->libelle }}</p>
                </div>
            </div>

            <hr class="mb-8">

            <!--pannier-->
            <div class="h-fit mb-8">
                @guest
                    Veuillez vous connecter pour ajouter cet article dans votre pannier.
                @else
                    <form
                        class="contents"
                        action="{{ route(Pannier::inPannier($produit) ? 'pannier.remove' : 'pannier.add') }}"
                        method="POST"
                    >
                        @csrf
                        <input name="id" type="hidden" value="{{ $produit->id }}">
                        @if(Pannier::inPannier($produit))
                            <div class="flex items-center row gap-x-4">
                                <p><span>{{ Pannier::getItem($produit)->quantite }}</span> items dans le pannier.</p>
                                <p class="font-bold">Total des items: {{ Pannier::getItem($produit)->quantite * $produit->prix }} €</p>
                                <button class="btn btn-danger flex items-center">
                                    <iconify-icon icon="mdi:cart-off"></iconify-icon>
                                </button>
                            </div>

                        @else
                            <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantitée</label>
                            <div class="flex items-center row gap-x-4">
                                <!--input nombre-->
                                <div>
                                    <div class="relative flex items-center max-w-[8rem]">
                                        <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <iconify-icon icon="ic:baseline-minus" class="text-gray-900 dark:text-white"></iconify-icon>
                                        </button>
                                        <input value="1" name="quantite" type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
                                        <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <iconify-icon icon="ic:baseline-plus" class="text-gray-900 dark:text-white"></iconify-icon>
                                        </button>
                                    </div>
                                </div>

                                <button class="btn btn-primary flex items-center">
                                    <iconify-icon icon="mdi:cart"></iconify-icon>
                                </button>
                            </div>





                        @endif
                    </form>
                @endguest
            </div>


        </div>
    </div>
@endsection