<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function all()
    {
        $products = \App\Models\Product::all();
        $products->transform(function($product) {
            return new \App\Http\Resources\ProductResource($product);
        });

        return \App\Helper\ResponseHelper::ok($products);
    }

    public function create(\App\Http\Requests\ProductCreateRequest $request)
    {
        $path = $request->file('image')->store('products');

        $product = \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'product_category_id' => $request->product_category_id,
        ]);

        $content = new \App\Http\Resources\ProductResource($product);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function read($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        
        if (!$product) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }
        
        $content = new \App\Http\Resources\ProductResource($product);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function update(\App\Http\Requests\ProductUpdateRequest $request, $id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        
        if (!$product) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }

        // delete old file
        Storage::delete($product->image);

        $path = $request->file('image')->store('products');

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $path;
        $product->product_category_id = $request->product_category_id;
        $product->save();

        $content = new \App\Http\Resources\ProductResource($product);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function delete($id)
    {
        $product = \App\Models\Product::where('id', $id)->first();
        
        if (!$product) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Data not found',
            ]);
        }
        
        // delete old file
        Storage::delete($product->image);
        $product->delete();

        return \App\Helper\ResponseHelper::ok([
            'message' => 'Data successfully deleted',
        ]);
    }
}
