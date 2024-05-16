@extends('layouts.template')

@section('content')
    <h1 class="text-3xl text-center font-bold mt-4 flex items-center justify-center gap-x-2">
        <iconify-icon icon="mdi:edit"></iconify-icon>
        Editer le coupon {{ $coupon->id }}
    </h1>

    <hr class="my-12">

    <form
        class="container mx-auto"
        method="POST"
        action="{{ route('admin.coupons.update', $coupon->id) }}"
    >
        @csrf
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="col-start-1 col-end-3">
                @include('components.input', [
                    "name" => "code",
                    "label" => "Code",
                    "id" => "code",
                    "value" => $coupon->code,
                    "type" => "text",
                    "required" => true,
                ])
            </div>

            <div class="col-start-1 col-end-2">
                @include('components.input', [
                    "name" => "discount",
                    "label" => "Promotion (%)",
                    "id" => "discount",
                    "value" => $coupon->discount,
                    "type" => "number",
                    "required" => true,
                ])
            </div>

            <div class="col-start-2 col-end-3">
                @include('components.input', [
                    "name" => "expiration",
                    "label" => "Date d'expiration",
                    "id" => "expiration",
                    "value" => \App\Helpers\Dates::clean(($coupon->expiration)->format('Y-m-d')),
                    "type" => "text",
                    "placeholder"=>"yyyy-mm-dd",
                    "required" => true,
                ])
            </div>
        </div>

        <div class="flex w-full items-center justify-center">
            <button class="btn btn-primary flex" type="submit">
                <iconify-icon icon="mdi:send"></iconify-icon>
                Créer !
            </button>
        </div>
    </form>

@endsection
