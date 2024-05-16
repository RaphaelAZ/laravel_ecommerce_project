@extends('layouts.template')

@section('content')
    <div class="overflow-x-auto mt-5 mx-5">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-5">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/11 py-2 px-4">Nom</th>
                    <th class="w-1/11 py-2 px-4">Description</th>
                    <th class="w-1/11 py-2 px-4">Stock</th>
                    <th class="w-1/11 py-2 px-4">Prix</th>
                    <th class="w-1/11 py-2 px-4">Taille</th>
                    <th class="w-1/11 py-2 px-4">Longueur</th>
                    <th class="w-1/11 py-2 px-4">Largeur</th>
                    <th class="w-1/11 py-2 px-4">Usage</th>
                    <th class="w-1/11 py-2 px-4">Matériau</th>
                    <th class="w-1/11 py-2 px-4">Marque</th>
                    <th class="w-1/11 py-2 px-4">Catégorie</th>
                    <th class="w-1/11 py-2 px-4"><iconify-icon icon="mdi:gear"></iconify-icon></th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <tr>
                    <td class="border border-gray-300 py-2 px-4"><a href="../produits/{{$product->id}}">{{ $product->name }}</a></td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->description }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->stock }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->price }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->height }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->length }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->width }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ $product->usage }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ optional($product->material)->wording }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ optional($product->brand)->wording }}</td>
                    <td class="border border-gray-300 py-2 px-4">{{ optional($product->category)->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
