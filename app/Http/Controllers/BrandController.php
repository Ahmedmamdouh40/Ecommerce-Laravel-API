<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    
    public function index()
    {
        $brand = Brand::all();
        $brandResource = BrandResource::collection(($brand));
        return $brandResource;
    }

    
    public function store(Request $request)
    {
        
        $brand = Brand::create([
            'name'=>$request->name     
        ]);

        if($brand)
        {
            return response()->json([
                "Success" => 'The brand was added',
                "Data:"=> new BrandResource($brand),],200);
        }
        if(!$brand){
            return response()->json(["Error"=>"Brand was not added due to an error"],404);
        }
    }

    
    public function show($id)
    {
        $brand = Brand::find($id);
        if(is_null($brand)){
            return response()->json(["Error"=>"No such a brand with this id"],404);
        }
        return new BrandResource($brand);
    }

   
    public function update(Request $request, $id)
    {
        $brand =Brand::find($id);
        if(is_null($brand)){
            return response()->json(["Error"=>"No such a brand with this id"],404);
        }
        $brand->update([
            'name'=>$request->name     
        ]);
        return response()->json(["Success"=>"Brand is Updated",
                                    "New data:"=> new BrandResource($brand)],200);
    }

    public function destroy($id)
    {
        $brand =Brand::find($id);
        if(is_null($brand)){
            return response()->json(["Error"=>"No such a brand with this id"],404);
        }
        $brand->delete();
        return response()->json(["Success"=>"brand deleted successfully"],200);
    }
}
