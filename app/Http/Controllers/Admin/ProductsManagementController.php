<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsManagementController extends Controller
{
    public function index() {
        $products = Product::paginate(15);
        $q = Product::query();

        $brands = Brand::all()->pluck('wording', 'code');
        $materials = Material::all()->pluck('wording', 'code');
        $categories = Category::all()->pluck('name', 'id');

        $q->with(['brand','material','category']);

        $products = $q->paginate(15);

        return view("admin.products.index", [
            "brands" => $brands,
            "materials" => $materials,
            "categories" => $categories,
            "products" => $products,
        ]);
    }

    public function edit(Request $request) {
        // $product = Product::findOrFail($request->get('id'));
        // dd($product);
        // $q = Product::query();

        // $brand = Brand::all()->pluck('wording', 'code');
        // $material = Material::all()->pluck('wording', 'code');
        // $category = Category::all()->pluck('name', 'id');

        // $q->with(['brand','material','category']);

        // $product = $q->paginate(15);

        // return view("admin.products.edit", [
        //     "brands" => $brand,
        //     "materials" => $material,
        //     "categories" => $category,
        //     "product" => $product,
        // ]);
    }

    public function add(Request $request) {}

    public function update(Request $request) {
        // try {
        //     //Si la req n'est pas POST
        //     throw_if(!$request->isMethod('POST'));

        //     $request->validate([
        //         'name' => 'required|string',
        //         'email' => 'required|email',
        //         'message' => 'required|string',
        //     ]);
        //     $comment = new Comment();
        
        //     $comment->name = $request->input('name');
        //     $comment->email = $request->input('email');
        //     $comment->comment = $request->input('message');
        
        //     $comment->save();
        // } catch (Exception|Throwable $e) {} 
        // finally {
        //     return redirect()->back()->with('throwBack','Votre demande de contact a bien été prise en compte.');
        // }
    }

    public function delete(Request $request) {
        // try {
        //     //Si la req n'est pas POST
        //     throw_if(!$request->isMethod('POST'));

        //     $product = new Product();
        //     $product->delete();
        // } catch (Exception|Throwable $e) {} 
        // finally {
        //     return redirect()->back()->with('throwBack','L\'article a bien été supprimé.');
        // }
    }
}
