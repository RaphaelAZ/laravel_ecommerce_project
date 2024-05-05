<a href="{{ route('produits.show', $produit->id) }}"
   class="max-w-sm rounded overflow-hidden shadow-lg block"
>
    <!--container carte-->
    <article class="px-6 py-4">

        <img
            class="w-full mb-2"
            src="{{ $produit->image ?? 'placeholder.png' }}"
            alt="no">

        <h3 class="font-bold text-xl mb-2">{{ $produit->nom }}</h3>
        <p class="text-gray-700 text-base">{{ mb_strimwidth($produit->description, 0, 150, '...') }}</p>

        <div class="pt-4 pb-2">
            <p>{{ $produit->prix }} €</p>
            <!--
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
            -->
        </div>

        <span class="btn btn-primary">Voir</span>

    </article>
</a>
