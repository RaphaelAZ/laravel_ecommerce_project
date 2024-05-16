<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $products = Product::paginate(15);
        $q = Product::query();



        $brands = Brand::all()->pluck('wording', 'code');
        $materials = Material::all()->pluck('wording', 'code');
        $categories = Category::all()->pluck('name', 'id');

        $q->with(['brand','material','category']);

        $products = $q->paginate(15);

        return view("products.index", [
            "brands" => $brands,
            "materials" => $materials,
            "categories" => $categories,
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $product = Product::findOrFail($id);
        return view("products.show", [
            "product" => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function filters(Request $request)
    {
        $filters = array_filter($request->all(), function($val) {
            return (
                $val !== null &&
                $val !== '__none__' &&
                $val !== "0"
            );
        });

        $q = Product::with(['brand','material','category']);

        if(isset($filters["name-prod"])) {
            $q->where("name", "like", "%".$filters['name-prod']."%");
        }

        if(isset($filters["brand-wording"])) {
            $q->where("id_brand", "=", $filters["brand-wording"]);
        }

        if(isset($filters["material-wording"])) {
            $q->where("id_material", "=", (int) $filters["material-wording"]);
        }

        if(isset($filters["category-wording"])) {
            $q->where("id_category", "=", $filters["category-wording"]);
        }

        if(isset($filters["input-min"]) || isset($filters["input-max"])) {
            $q->whereBetween("price", [
                (int)($filters["input-min"] ?? 0),
                (int)($filters["input-max"] ?? PHP_INT_MAX),
            ]);
        }

        return view("products.results", [
            "products" => $q->get(),
            "filters" => $filters,
        ]);
    }

    public function category(Category $category)
    {

    }
}
