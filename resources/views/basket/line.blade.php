<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $itemNo }}
    </th>
    <td class="px-6 py-4">
        <a href="{{ route('products.show', $product) }}">{{ $product->nom }}</a>
    </td>
    <td class="px-6 py-4">
        <form action="{{ route('basket.update') }}" method="POST" class="flex flex-row gap-x-4 w-fit">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="relative flex items-center max-w-[8rem]">
                <button type="button" id="decrement-button-{{ $product->id }}" data-input-counter-decrement="quantity-input-{{ $product->id }}" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <iconify-icon icon="ic:baseline-minus" class="text-gray-900 dark:text-white"></iconify-icon>
                </button>
                <input value="{{ $quantite }}" name="quantite" type="text" id="quantity-input-{{ $product->id }}" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
                <button type="button" id="increment-button-{{ $product->id }}" data-input-counter-increment="quantity-input-{{ $product->id }}" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <iconify-icon icon="ic:baseline-plus" class="text-gray-900 dark:text-white"></iconify-icon>
                </button>
            </div>

            <button type="submit" class="btn btn-primary w-fit flex items-center" title="Modifier l'article">
                <iconify-icon icon="mdi:edit"></iconify-icon>
            </button>
        </form>
    </td>
    <td class="px-6 py-4">
        {{ \App\Helpers\Basket::getItemTotal($product) }} €
    </td>
    <td class="px-6 py-4">
        <form action="{{ route('basket.remove') }}" method="POST">
            @csrf
            <input name="id" type="hidden" value="{{ $product->id }}">

            <button type="submit" class="btn btn-danger w-fit flex items-center" title="Supprimer l'article">
                <iconify-icon icon="mdi:cart-off"></iconify-icon>
            </button>
        </form>
    </td>
</tr>
