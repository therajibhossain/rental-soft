<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\APITrait;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Validator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use APITrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
        try {
            $products = Product::all();
            return $this->handleResponse(ProductResource::collection($products), 'Products retrived successfully.');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try{
            $input = $request->all();
            $validator = Validator::make($input, [
                'code' => 'required',
                'name' => 'required',
            ]);

            if($validator->fails()){
                return $this->handleError($validator->errors());       
            }

            $product = Product::create($input);
            return $this->handleResponse(new ProductResource($product), 'Product created!');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try{
            $product = Product::find($id);
            if (is_null($product)) {
                return $this->handleError('Product not found!');
            }

            return $this->handleResponse(new ProductResource($product), 'Product retrieved.');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        try{
            $input = $request->all();
            $validator = Validator::make($input, [
                'code' => 'required',
                'name' => 'required',
            ]);

            if($validator->fails()){
                return $this->handleError($validator->errors());       
            }

            $product->fill($request->all());
            $product->save();

            return $this->handleResponse(new ProductResource($product), 'Product updated!');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        try{
            $product->delete();
            return $this->handleResponse([], 'Product deleted!');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}