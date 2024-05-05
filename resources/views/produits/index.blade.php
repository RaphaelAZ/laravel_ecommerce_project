@extends('layouts.template')

@section('content')
    <div>
        <h1>Page produits :)</h1>

        <hr class="my-3">

        <section id="products" class="grid grid-cols-5 gap-4">
            @foreach($products as $index => $produit)
                @include('produits.card', ["produit" => $produit])
            @endforeach
        </section>

        <hr class="my-3">

        {{ $products->links() }}
    </div>
@stop
