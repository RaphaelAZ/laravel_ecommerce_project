<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dates;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProductsManagementController extends Controller
{
    public function edit(int $id) {
        $product = Product::findOrFail($id);
        $q = Product::query();

        $brand = Brand::all()->pluck('wording', 'code');
        $material = Material::all()->pluck('wording', 'code');
        $category = Category::all()->pluck('name', 'id');

        $q->with(['brand','material','category']);

        return view("admin.products.edit", [
            "brands" => $brand,
            "materials" => $material,
            "categories" => $category,
            "product" => $product,
        ]);
    }

    public function add(Request $request) {}

    public function update(Request $request,int $id) {
        try {
            throw_if(!$request->isMethod('POST'));

            Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'stock' => 'required|string',
                'price' => 'required|string',
                'height' => 'nullable|string',
                'length' => 'nullable|string',
                'width' => 'nullable|string',
                'usage' => 'nullable|string',
                'material' => 'required|string',
                'brand' => 'required|string',
                'category' => 'required|string',
            ]);

            $oldProduct = Product::findOrFail($id);

            $oldProduct->name = $request->get('name');
            $oldProduct->description = $request->get('description');
            $oldProduct->stock = intval($request->get('stock'));
            $oldProduct->price = floatval($request->get('price'));
            $oldProduct->height = intval($request->get('height'));
            $oldProduct->length = intval($request->get('length'));
            $oldProduct->width = intval($request->get('width'));
            $oldProduct->usage = $request->get('usage');
            $oldProduct->id_material = Material::findOrFail($request->get('material'))->code;
            $oldProduct->id_brand = Brand::findOrFail($request->get('brand'))->code;
            $oldProduct->id_category = Category::findOrFail($request->get('category'))->id;

            // dd($oldProduct->toArray());

            $oldProduct->save();
        } catch (Exception|Throwable $e) {} finally {
            return redirect()->back()->with('throwBack','L\'article a bien été mis à jour.');
        }
    }

    public function delete(Request $request,int $id) {
        try {
            throw_if(!$request->isMethod('POST'));

            $product = Product::findOrFail($id);
            $product->delete();
        } catch (Exception|Throwable $e) {} 
        finally {
            return redirect()->back()->with('throwBack','L\'article a bien été supprimé.');
        }
    }
}
