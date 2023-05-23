<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function all()
    {
        $data = \App\Models\ProductCategory::all();
        $data->transform(function($product_category) {
            return new \App\Http\Resources\ProductCategoryResource($product_category);
        });

        return \App\Helper\ResponseHelper::ok($data);
    }

    public function create(\App\Http\Requests\ProductCategoryRequest $request)
    {
        $product_category = \App\Models\ProductCategory::create($request->validated());

        $content = new \App\Http\Resources\ProductCategoryResource($product_category);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function read($id)
    {
        $product_category = \App\Models\ProductCategory::where('id', $id)->first();
        
        if (!$product_category) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }
        
        $content = new \App\Http\Resources\ProductCategoryResource($product_category);

        return \App\Helper\ResponseHelper::ok($content);
    }
    
    public function update(\App\Http\Requests\ProductCategoryRequest $request, $id)
    {
        $product_category = \App\Models\ProductCategory::where('id', $id)->first();
        
        if (!$product_category) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }

        $product_category->name = $request->name;
        $product_category->save();

        $content = new \App\Http\Resources\ProductCategoryResource($product_category);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function delete($id)
    {
        $product_category = \App\Models\ProductCategory::where('id', $id)->first();
        
        if (!$product_category) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }
        
        $product_category->delete();

        return \App\Helper\ResponseHelper::ok([
            'message' => 'Data successfully deleted',
        ]);
    }
}
