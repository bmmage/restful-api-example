<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transformers\ProductTransformer;
use App\Http\Requests\Products\ProductUpdate as UpdateRequest;
use App\Http\Requests\Products\ProductDelete as DestroyRequest;
use App\Http\Requests\Products\ProductCreate as CreateRequest;

/**
 * Get Product Information.
 *
 * Class ProductController
 * @package App\Http\Controllers\Auth
 */
class ProductController extends Controller
{
    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->transform(Product::all()));
    }

    /**
     * @param CreateRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json($this->transform($product));
    }

    /**
     * update the product
     * @param UpdateRequest $request
     * @param $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json($this->transform($product));
    }

    /**
     * Display the product
     *
     * @param $id - Product Id
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->transform(Product::findOrFail($id)));
    }

    /**
     * Remove a product
     *
     * @param DestroyRequest $request
     * @param $id - Product Id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json([],204);
    }

    /**
     * Transform the model
     * @param $data
     * @return mixed
     */
    private function transform($data)
    {
        return resolve(ProductTransformer::class)->transform($data);
    }
}
