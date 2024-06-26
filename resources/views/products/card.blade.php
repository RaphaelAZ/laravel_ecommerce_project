<div class="max-w-sm rounded overflow-hidden shadow-lg block">
    <!--container carte-->
    <article class="px-6 py-4 h-full flex flex-col">

        <img
            class="w-full mb-2"
            src="{{ asset($product->image ?? 'placeholder.png') }}"
            alt="Image">

        <h3 class="font-bold text-xl mb-2">{{ $product->name }}</h3>
        <p class="text-gray-700 text-base">{{ mb_strimwidth($product->description, 0, 150, '...') }}</p>

        <div class="pt-4 pb-2 flex items-center gap-x-4">
            <p>{{ $product->price }} €</p>

            @auth
                @if(\App\Helpers\Basket::inBasket($product))
                    <span class="chip w-fit flex" title="{{ \App\Helpers\Basket::getItem($product)->quantity }} dans le panier">
                        {{ \App\Helpers\Basket::getItem($product)->quantity }}
                        <iconify-icon class="ml-2" class="inline-block" icon="mdi:cart"></iconify-icon>
                    </span>
                @endif
            @endauth
        </div>

        <!--tableau products-->
        <div class="flex flex-col *:items-center">
            <div class="grid grid-cols-2">
                <p class="col-start-1 col-end-2 font-bold">Usage</p>
                <span class="col-start-2 col-end-3">{{ $product->usage }}</span>
            </div>

            <hr class="my-1">

            <div class="grid grid-cols-2">
                <p class="col-start-1 col-end-2 font-bold">Matériau</p>
                <span class="col-start-2 col-end-3">{{ optional($product->material)->wording }}</span>
            </div>

            <hr class="my-1">

            <div class="grid grid-cols-2">
                <p class="col-start-1 col-end-2 font-bold">Marque</p>
                <span class="col-start-2 col-end-3">{{ optional($product->brand)->wording }}</span>
            </div>

            <hr class="my-1">

            <div class="grid grid-cols-2">
                <p class="col-start-1 col-end-2 font-bold">Catégorie</p>
                <span class="col-start-2 col-end-3">{{ optional($product->category)->name }}</span>
            </div>
        </div>

        <div class="mt-auto pt-6 mb-4 flex space-between gap-2 justify-center items-center">
            <a href="{{ route('products.show', $product->id) }}">
                <span class="btn btn-primary h-10">Voir</span>
            </a>
            <a href="{{ route('product.edit', $product->id) }}">
                <span class="btn btn-warning h-10"><iconify-icon icon="ph:pen"></iconify-icon></span>
            </a>
            <form action="{{route('product.delete', $product->id)}}" method="POST" class="h-10">
            @csrf
                <button type="submit" class="btn btn-danger">
                    <iconify-icon icon="ph:trash"></iconify-icon>
                </button>
            </form>
        </div>
    </article>
</div>
