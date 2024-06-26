@php
    //Helpers
    use App\Helpers\Basket;
@endphp

@if(Basket::numberOfItems() > 0)
<section id="payment" class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">


            @if(session()->has("coupon_state"))
                @if(session('coupon_state'))
                    @include('components.alert', [
                        "color" => "green",
                        "text" => "Coupon bien appliqué.",
                    ])
                @else
                    @include('components.alert', [
                        "color" => "red",
                        "title" => "Ouch !",
                        "text" => "Le coupon n'est plus valide ou n'existe pas.",
                    ])
                @endif

                @php session()->remove('coupon_state') @endphp
            @endif

            <form
                method="POST"
                action="{{ route('basket.apply') }}"
                class="flex w-full h-fit my-8 items-end gap-x-4"
            >
                @csrf

                <!--container coupon code-->
                <div class="col-start-1 col-end-3">
                    @include('components.input', [
                        "id" => "coupon",
                        "label" => "Coupon",
                        "type" => "text",
                        "name" => "coupon",
                        "placeholder" => "Votre coupon"
                    ])
                </div>

                <!--button submit-->
                <button class="btn btn-green flex">
                    <iconify-icon icon="mdi:send"></iconify-icon>
                    Envoyer
                </button>
            </form>

            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Paiement</h2>

            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                <form method="POST" action="{{ route('orders.add') }}"
                      class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                    @CSRF
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <!--Num carte container-->
                        <div class="col-start-1 col-end-3">
                            @include('components.input', [
                                "id" => "card-number-input",
                                "label" => "Numéro de carte",
                                "required" => true,
                                "type" => "text",
                                "name" => "nbr-carte",
                                "placeholder" => "xxxx xxxx xxxx xxxx"
                            ])
                        </div>

                        <!--Date expiration-->
                        <div>
                            <label for="card-expiration-input"
                                   class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Date
                                d'expiration <span class="text-red-600">*</span> </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                    <iconify-icon icon="mdi:calendar" aria-hidden="true"
                                                  class="h-4 w-4 text-gray-500 dark:text-gray-400"></iconify-icon>
                                </div>
                                <input datepicker id="card-expiration-input" type="text"
                                       class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-9 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                       name="date"
                                       placeholder="mm/aa" required/>
                            </div>
                        </div>

                        <!--CCV container-->
                        <div>
                            @include('components.input', [
                                "id" => "cvv-input",
                                "label" => "CVV",
                                "required" => true,
                                "type" => "number",
                                "name" => "ccv",
                                "placeholder" => "•••",
                            ])
                        </div>
                    </div>

                    <!--Btn-payer-->
                    <button type="submit"
                            class="btn btn-green flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <iconify-icon icon="line-md:confirm-circle" class="mr-2"></iconify-icon>
                        Payer
                    </button>
                </form>

                <div class="mt-6 grow sm:mt-8 lg:mt-0">
                    <div
                        class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Sous-total</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">{{ Basket::getSubTotal() }} €</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                    Code de réduction <br/>
                                    @if(Basket::codeApplied())
                                        (Code {{ session()->get('discount_code') }})
                                    @endif
                                </dt>
                                <dd class="text-base font-medium text-green-500 w-fit inline-block">-{{ Basket::getDiscountedPrice() }} €</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Livraison</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">9.99 €</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">TVA</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">{{ Basket::getTVA() }} €</dd>
                            </dl>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white">{{ Basket::getTotal() }} €</dd>
                        </dl>
                    </div>

                    <!--logos carte-->
                    <div class="mt-6 flex items-center justify-center gap-8">
                        <iconify-icon class="h-8 w-auto" icon="logos:paypal" title="Paypal"></iconify-icon>
                        <iconify-icon class="h-8 w-auto" icon="logos:visa" title="Visa"></iconify-icon>
                        <iconify-icon class="h-8 w-auto" icon="logos:mastercard" title="Master Card"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
