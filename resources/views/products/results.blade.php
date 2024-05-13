@extends('layouts.template')

@section('content')
    <div>
        <h1 class="text-3xl justify-center w-full my-8 flex items-center">
            <iconify-icon icon="mdi:filter" class="mr-4"></iconify-icon>
            Résultats de recherhce
        </h1>

        <hr class="my-8">

        <!-- DEPRECATED
        <section id="filters-details" class="flex">
            @foreach($filters as $name => $val)
                <p class="semi-chip">
                    <span>{{ $name }}</span>
                    <span>{{ $val }}</span>
                </p>
            @endforeach
        </section>


        <hr class="my-8">
        -->


        <section id="products" class="grid grid-cols-5 gap-4">
            @foreach($products as $index => $product)
                @include('products.card', ["product" => $product])
            @endforeach
        </section>
    </div>
@endsection
