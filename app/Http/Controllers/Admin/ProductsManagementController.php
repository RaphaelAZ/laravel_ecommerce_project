<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function add() {
        $brand = Brand::all()->pluck('wording', 'code');
        $material = Material::all()->pluck('wording', 'code');
        $category = Category::all()->pluck('name', 'id');

        return view("admin.products.add", [
            "materials" => $material,
            "categories" => $category,
            "brands" => $brand
        ]);
    }

    public function create(Request $request) {
        try {
            throw_if(!$request->isMethod('POST'));

            $newProduct = new Product();

            Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'stock' => 'required|string',
                // 'file' => 'required',
                'price' => 'required|string',
                'height' => 'nullable|string',
                'length' => 'nullable|string',
                'width' => 'nullable|string',
                'usage' => 'nullable|string',
                'material' => 'required|string',
                'brand' => 'required|string',
                'category' => 'required|string',
            ]);

            $file = $request->file('file');
            $fileName = $file->hashName();
            $imagePath = "img/products/".$fileName;

            $contents = file_get_contents($file);

            file_put_contents(public_path()."/".$imagePath, $contents);

            $newProduct->name = $request->get('name');
            $newProduct->description = $request->get('description');
            $newProduct->stock = intval($request->get('stock'));
            $newProduct->image = $imagePath;
            $newProduct->price = floatval($request->get('price'));
            $newProduct->height = intval($request->get('height'));
            $newProduct->length = intval($request->get('length'));
            $newProduct->width = intval($request->get('width'));
            $newProduct->usage = $request->get('usage');
            $newProduct->id_material = Material::findOrFail($request->get('material'))->code;
            $newProduct->id_brand = Brand::findOrFail($request->get('brand'))->code;
            $newProduct->id_category = Category::findOrFail($request->get('category'))->id;
            $newProduct->created_at = new \DateTime();
            $newProduct->updated_at = new \DateTime();


            /*
            $request->file('file')
                ->storeAs('img/products', $fileName);

            //Storage::put('img/products', new File($file), $fileName);
            */

            // $file->storeAs('public/img/products/', $fileName);

            $newProduct->save();
        } catch (Exception|Throwable $e) {} finally {
            return redirect()->back()->with('throwBack','L\'article a bien été créé.');
        }
    }

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
            $oldProduct->updated_at = new \DateTime();

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
