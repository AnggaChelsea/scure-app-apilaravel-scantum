<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\WEB\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{
    public function show()
    {
        $products = Products::all();
        // dd($products);
        return view('welcome', ['products' => $products]);
    }
}
