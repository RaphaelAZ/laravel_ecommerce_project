<div class="glide__slide relative grid gap-y-2 bg-gray-200 rounded-lg overflow-hidden">
    <!--image container-->
    <div class="w-full h-auto flex flex-col rounded-b-lg">
        <img
            class="w-full max-h-30 object-cover object-center"
            alt="no"
            src="{{ $offer['product']->image }}">
    </div>

    <div class="p-8 grid gap-y-4 justify-center w-full" data-target-bg>
        <!--title-->
        <h3 class="text-xl font-bold text-center">{{ $offer['product']->name }}</h3>

        <!--container prices-->
        <div class="grid grid-cols-3 gap-x-4 items-center">
            <!--initial price-->
            <p class="line-through font-thin text-sm text-right">
                {{ $offer['product']->price }} €
            </p>

            <p class="relative bg-sec rounded-lg font-bold py-2 w-full h-fit text-center">
                -{{ $offer['offer'] }}%
            </p>

            <!--final price-->
            <p class="font-bold text-lg text-left">
                {{ $offer['afterPrice'] }} €
            </p>
        </div>

        <div class="w-full h-fit flex justify-center">
            <a
                href="{{ route('products.show', $offer['product']->id) }}"
                class="btn btn-primary w-fit gap-x-2"
            >
                <iconify-icon icon="mdi:eye"></iconify-icon>
                Voir
            </a>
        </div>

    </div>

</div>
