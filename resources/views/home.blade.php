@extends('layouts.template')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6">Bienvenue sur notre site d'e-commerce !</h1>

    <div class="glide multi">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <li class="glide__slide bg-gray-100 rounded-lg p-8">0</li>
                <li class="glide__slide bg-gray-200 rounded-lg p-8">1</li>
                <li class="glide__slide bg-gray-300 rounded-lg p-8">2</li>
            </ul>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left bg-blue-500 text-white rounded-full p-2" data-glide-dir="<">Précèdent</button>
            <button class="glide__arrow glide__arrow--right bg-blue-500 text-white rounded-full p-2" data-glide-dir=">">Suivant</button>
        </div>
    </div>
</div>
@stop
