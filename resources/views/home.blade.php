@extends('layouts.template')

@section('content')
<section id="main" class="w-full h-screen">
    <div
        class="w-full h-full bg-primary flex flex-col justify-center overflow-hidden relative bg-no-repeat bg-cover bg-center"
        style="background-image: url({{ asset('img/front-page.webp') }})"
    >
        <h1 class="text-8xl font-bold mb-6 text-white text-center w-full main-font z-10 leading-snug user-select-none">
            Cursed <br/> Bazaar
        </h1>

        <h2 class="text-2xl text-center text-white">Votre magasin <b>numéro 1</b> des objets étranges !</h2>
        <p class="font-light text-white text-center">Approuvé par le ministère de la vérité</p>

    </div>
</section>

<section id="glider-section" class="container mx-auto py-12">
    <h1 class="text-5xl font-black mb-6 text-primary text-center w-full title-font z-10 leading-snug user-select-none">
        Les dernières offres
    </h1>

    <h3 class="text-primary title-font text-2x text-center">
        Catégorie

        <a
            class="text-decoration-underline"
            href="{{ route('products.category', $category->id) }}"
        >
            {{ $category->nom }}
        </a>
    </h3>

    <div id="glide" class="multi">
        <div class="glide__track" data-glide-el="track">
            <div class="glide__slides">
                <div class="glide__slide p-8">Cock</div>
            </div>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left btn btn-primary" data-glide-dir="<">
                <iconify-icon icon="material-symbols:chevron-left"></iconify-icon>
            </button>
            <button class="glide__arrow glide__arrow--right btn btn-primary" data-glide-dir=">">
                <iconify-icon icon="material-symbols:chevron-right"></iconify-icon>
            </button>
        </div>
    </div>
</section>
@stop

@section('scripts')
    <script src="{{ mix('dist/js/homepage.js') }}"></script>
@endsection
