@extends('layouts.template')

@section('content')
    <div>
        <h1 class="text-3xl justify-center w-full my-8 flex items-center">
            <iconify-icon icon="mdi:unidentified-flying-object-outline" class="mr-4"></iconify-icon>
            Produits
        </h1>

        <section id="filters" class="container relative">
            @if(session('throwBack'))
                <div class="bg-green-200 text-green-800 border border-green-600 px-4 py-2 rounded relative" role="alert">
                    {{ session('throwBack') }}
                </div>
            @endif
            <button type="button" id="target-btn" class="btn btn-primary w-fit ml-10">
                <iconify-icon icon="mdi:filter"></iconify-icon>
                Filtres
            </button>

            <form
                method="POST"
                action="{{ route('products.filters.result') }}"
                id="target-filters"
                class="border-gray-600 bg-blue-200 rounded border-2 hidden grid-cols-3 p-8 gap-8 mx-10"
            >
                @CSRF

                <div class="col-start-1 col-end-4">
                    @include('components.input', [
                        "id" => "input-name",
                        "name" => "name-prod",
                        "label" => "Nom du produit"
                    ])
                </div>

                <div class="col-start-1 col-end-2">
                    @include('components.select', [
                        "id" => "input-brand",
                        "name" => "brand-wording",
                        "label" => "Marque",
                        "options" => $brands,
                    ])
                </div>

                <div class="col-start-2 col-end-3">
                    @include('components.select', [
                        "id" => "input-material",
                        "name" => "material-wording",
                        "label" => "Matériau",
                        "options" => $materials
                    ])
                </div>

                <div class="col-start-3 col-end-4">
                    @include('components.select', [
                        "id" => "input-category",
                        "name" => "category-wording",
                        "label" => "Catégorie",
                        "options" => $categories,
                    ])
                </div>

                <div class="col-start-1 col-end-4 grid grid-cols-2 gap-8">
                    <div class="relative mb-6">
                        <label for="input-min">Prix minimum <span class="font-light" id="spec-min">()</span></label>
                        <input id="input-min" name="input-min" type="range" value="0" min="0" max="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">0 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">33 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">66 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">100 €</span>
                    </div>

                    <div class="relative mb-6">
                        <label for="input-max">Prix maximum <span class="font-light" id="spec-max">()</span></label>
                        <input id="input-max" name="input-max" type="range" value="0" min="0" max="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">0 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">33 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">66 €</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">100 €</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-green col-start-2 col-end-3">
                    <iconify-icon icon="formkit:submit" class="mr-4"></iconify-icon>
                    Envoyer
                </button>
            </form>
        </section>

        <hr class="my-3">

        <section id="products" class="grid grid-cols-5 gap-5">
            @foreach($products as $index => $product)
                @include('products.card', ["product" => $product])
            @endforeach
        </section>

        <hr class="my-3">

        {{ $products->links() }}
    </div>
@stop

@section('scripts')
    <script>
        const btn = document.getElementById('target-btn')
        const filters = document.getElementById('target-filters')

        btn.addEventListener("click", function(event) {
            event.preventDefault()
            filters.classList.toggle('hidden')
            filters.classList.toggle('grid')
        });
    </script>

    <script>
        const iMax = document.getElementById('input-max')
        const iMin = document.getElementById('input-min')

        iMax.addEventListener('input', (event) => {
            const val = event.target.value
            document.getElementById('spec-max').textContent = "(" + val + " €" + ")"
        })

        iMin.addEventListener('input', (event) => {
            const val = event.target.value
            document.getElementById('spec-min').textContent = "(" + val + " €" + ")"
        })

        const evDOMLoad = new Event('input');

        document.addEventListener("DOMContentLoaded", (event) => {
            iMax.dispatchEvent(evDOMLoad)
            iMin.dispatchEvent(evDOMLoad)
        })
    </script>
@endsection
