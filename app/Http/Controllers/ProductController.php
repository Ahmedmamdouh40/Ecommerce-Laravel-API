<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        $productResource = ProductResource::collection(($products));
        return $productResource;
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(["Error"=>"No such a catgory with this id"],404);
        }
        return new ProductResource($product);
    }

    
    public function store(Request $request)
    {
        $file = $request->file('image');
        $pic_name=time().$file->getClientOriginalName();
        $path = $file->storeAs(
            'Media/Products',$pic_name
         );

         $product = Product::create([
            'name'=>$request->name,
            'image'=>$pic_name,
            'ske'=>$request->ske,
            'category_id'=>$request->category_id,
            'brand_id'=>$request->brand_id     
        ]);

        if($product)
        {
            return response()->json([
                "Success" => 'The product was added',
                "Data:"=> new ProductResource($product),],200);
        }
        if(!$product){
            return response()->json(["Error"=>"Product was not added due to an error"],404);
        }
    }

    
   
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $file = $request->file('image');
        if($file){
            $pic_name=time().$file->getClientOriginalName();
            $path = $file->storeAs(
                'Media/Products',$pic_name
            );
        }
        else $pic_name = $product->image;
        if(is_null($product)){
            return response()->json(["Error"=>"No such a product with this id"],404);
        }
        $product->update([
            'name'=>$request->name,
            'image'=>$pic_name,
            'ske'=>$request->ske,
            'category_id'=>$request->category_id,
            'brand_id'=>$request->brand_id
        ]);
    }

    
    public function destroy($id)
    {
        $product =Product::find($id);
        if(is_null($product)){
            return response()->json(["Error"=>"No such a product with this id"],404);
        }
        $product->delete();
        return response()->json(["Success"=>"P  roduct deleted successfully"],200);
    }
}
