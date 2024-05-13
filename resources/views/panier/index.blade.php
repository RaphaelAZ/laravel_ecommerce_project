@extends('layouts.template')

@php
    //Helpers
    use App\Helpers\Panier;
@endphp

@section('content')
    <section id="panier">
        <div class="container mx-auto">
            <h1 class="text-3xl justify-center w-full my-8 flex items-center">
                <iconify-icon icon="mdi:cart" class="mr-4"></iconify-icon>
                Panier
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
                    @foreach(Panier::getAll() as $index => $item)
                        @if(!empty($item))
                            @include('panier.line', [
                                'produit' => $item->produit,
                                'quantite' => $item->quantite,
                                'itemNo' => $index + 1,
                            ])
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include("panier.form")

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection

@section('scripts')
    <script>
        const numberInput = document.querySelector("input#card-number-input")
        numberInput.addEventListener("input", (event) => {
            //Sans les espaces
            const val = event.target.value.replace(/\s/g, "");

            //array contenant les futurs bouts du champ
            const spacedArray = [];

            for(let i in val.split("")) {
                //Si c'est le 4ème nombre dans l'input
                if(i%4 === 0 && i > 0 && i < 16) {
                    //Mise d'un espace
                    spacedArray.push(" ");
                }
                spacedArray.push(val[i])
            }

            //Si la longueur n'est pas valide
            if(val.length>16) {
                spacedArray.pop()
            }

            //Mise du chiffre dans l'input
            numberInput.value = spacedArray.join("")
        })

    </script>
@endsection

<!--TODO codes réduction
<div class="">
    <label for="code-reducion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code de réduction</label>
    <input type="text" id="code-reducion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
</div>
-->
