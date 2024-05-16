<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
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

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'stock' => 'required|integer',
                'price' => 'required|numeric',
                'height' => 'required|numeric',
                'length' => 'required|numeric',
                'width' => 'required|numeric',
                'usage' => 'required|string',
                'material' => 'nullable|string',
                'brand' => 'nullable|string',
                'category' => 'nullable|string',
            ]);

            dd($request->select('material'));

            $oldProduct = Product::findOrFail($id);

            $oldProduct->name = $request->get('name');
            $oldProduct->description = $request->get('description');
            $oldProduct->stock = $request->get('stock');
            $oldProduct->price = $request->get('price');
            $oldProduct->height = $request->get('height');
            $oldProduct->length = $request->get('length');
            $oldProduct->width = $request->get('width');
            $oldProduct->usage = $request->get('usage');
            $oldProduct->material->id = $request->get('material');
            $oldProduct->brand->id = $request->get('brand');
            $oldProduct->category->id = $request->get('category');

            // dd($oldProduct);

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
