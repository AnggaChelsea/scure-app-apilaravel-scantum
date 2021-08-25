<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\Product as ProductResource;
use Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'name'=>'required|min:3|max:20',
                'price'=>'required',
                'description'=>'required|min:20',
                'category'=>'required',
                'images'=>'required',
            ]
        );
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $products = Products::create($input);
        return $this->sendResponse(new ProductResource($products), 'add created');
    }

    public function deleteproduct($id)
    {
    //    $product = Products::findOrFail($id);
    //     return $this->sendResponse(new ProductResource($product), 'delete deleted');
    $product = DB::delete('delete from products where id = ?', [$id]);
    return response()->json(['message'=>"delete deleted success dengan data yang di delete", 'data'=>$product]);
    }

    public function getbyid($id)
    {
        $products = Products::find($id);
        if(is_null($products)){
            return $this->sendError("Sorry barang yang kamu cari dengan id $id belum ada");
        }
        return $this->sendResponse(new ProductResource($products), 'success product ada');
    }

    public function getall()
    {
        $products = Products::all();
        return $this->sendResponse(ProductResource::collection($products), 'get all sussess'); 
    }

    public function updateproduct(Request $request, $id)
    {
  

         $name= $request->input("name");
         $price = $request->input("price");
         $description = $request->input("description");
         $category = $request->input("category");
         $images = $request->input("images");

         DB::update('update products set name = ?,  price = ?  , description = ? , category = ? , images = ? where id = ?', [$name, $price, $description, $category, $images,$id]);
         return response()->json(['message'=>'update success']);

    }

   

    
}
