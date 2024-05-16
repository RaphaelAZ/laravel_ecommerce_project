@extends('layouts.template')

@section('content')
    <h1 class="text-3xl text-center font-bold mt-4">Coupons</h1>
    <div class="w-full flex justify-center mt-2">
        <a class="btn btn-primary justify-center" href="{{ route('admin.coupons.create') }}">
            <iconify-icon icon="carbon:add-filled"></iconify-icon>
            Créer
        </a>
    </div>


    <hr class="my-12">


    <div class="mt-5 mx-5 grid gap-y-6">

        @foreach($couponsAll as $title => $coupons)
            <div class="grid gap-y-2">
                <h2 class="text-xl text-center mb-8">Coupons {{ $title }}</h2>

                <table class="min-w-full border-gray-700 bg-white shadow-md rounded-lg overflow-hidden mb-5">
                    <thead class="bg-gray-800 text-white">
                    <tr class="*:py-2 *px-4">
                        <th>Numéro</th>
                        <th>Code</th>
                        <th>Pourcentage</th>
                        <th>Expiration le</th>
                        <th>Créé le</th>
                        <th><iconify-icon icon="mdi:gear"></iconify-icon></th>
                    </tr>
                    </thead>

                    <tbody class="text-gray-700">
                    @foreach($coupons as $index => $coupon)
                        <tr class="*:border *:border-gray-300 *:py-2 *:px-4">
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->discount }} %</td>
                            <td>{{ \App\Helpers\Dates::clean($coupon->expiration) }}</td>
                            <td>{{ \App\Helpers\Dates::clean($coupon->created_at, true) }}</td>
                            <td class="flex items-center gap-x-2 justify-center">
                                <a class="btn btn-warning flex w-fit" href="{{ route('admin.coupons.edit', $coupon) }}">
                                    <iconify-icon icon="mdi:edit"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @endforeach
    </div>
@endsection
