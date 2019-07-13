<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transformers\ProductTransformer;
use App\Http\Requests\Products\ProductUpdate as UpdateRequest;
use App\Http\Requests\Products\ProductDelete as DestroyRequest;
use App\Http\Requests\Products\ProductCreate as CreateRequest;

/**
 * Get Product Information For a user.
 *
 * Class UserProductController
 * @package App\Http\Controllers\Auth
 */
class UserProductController extends Controller
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
     * Display the product
     *
     * @param $id - Product Id
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

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
