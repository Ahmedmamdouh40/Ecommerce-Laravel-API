<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categries = Category::all();
        $categryResource = CategoryResource::collection(($categries));
        return $categryResource;
    }

    
    public function store(Request $request)
    {
         $category = Category::create([
            'name'=>$request->name     
        ]);

        if($category)
        {
            return response()->json([
                "Success" => 'The category was added',
                "Data:"=> new CategoryResource($category),],200);
        }
        if(!$category){
            return response()->json(["Error"=>"Category was not added due to an error"],404);
        }
             
    }

    
    public function show($id)
    {
        $category = Category::find($id);
        if(is_null($category)){
            return response()->json(["Error"=>"No such a catgory with this id"],404);
        }
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        $category =Category::find($id);
        if(is_null($category)){
            return response()->json(["Error"=>"No such a brand with this id"],404);
        }
        $category->update([
            'name'=>$request->name     
        ]);
        return response()->json(["Success"=>"Category is Updated",
                                    "New data:"=> new CategoryResource($category)],200);
        
    }

    
    public function destroy($id)
    {
        $category =Category::find($id);
        if(is_null($category)){
            return response()->json(["Error"=>"No such a category with this id"],404);
        }
        $category->delete();
        return response()->json(["Success"=>"Category deleted successfully"],200);
        
    }
}
