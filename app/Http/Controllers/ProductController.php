<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct()
    {
        $product = Product::create([
            'name' => 'track ',
        ]);

        $product->product_photo()->create([
            'image'=>'sports1.jfif',
        ]);

        $categories = Category::find([1]);
        $product->category()->attach($categories);
    }

    public function manyToMany(){
        $datas[0] = Category::all();
        $datas[1] = Product::all();
        return view('category', compact('datas'));
    }
}
