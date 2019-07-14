<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Transformers\ProductTransformer;
use App\Http\Requests\UserProducts\UserProductIndex as IndexRequest;
use App\Http\Requests\UserProducts\UserProductCreate as CreateRequest;
use App\Http\Requests\UserProducts\UserProductDelete as DestroyRequest;

/**
 * Get Product Information For a user.
 *
 * Class UserProductController
 * @package App\Http\Controllers\Auth
 */
class UserProductController extends Controller
{
    /**
     * @param IndexRequest $request
     * @param $userId
     * @return Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request, $userId)
    {
        $products = Product::whereHas('users', function ($q) use ($userId) {
            $q->whereId($userId);
        })->get();
        return response()->json($this->transform($products));
    }

    /**
     * @param CreateRequest $request
     * @param $userId
     * @return Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $request, $userId)
    {
        $user = User::findOrFail($userId);
        $product = Product::whereId($request->product_id)
            ->whereNotIn('id', $user->products->pluck('id'))
            ->first();
        $user->products()->attach($product->id ?? null);
        $user->refresh();
        return response()->json($this->transform($user->products));
    }

    /**
     * Remove a users products
     *
     * @param DestroyRequest $request
     * @param $userId
     * @param $productId - to be deleted
     * @return void
     */
    public function destroy(DestroyRequest $request, $userId, $productId)
    {
        $user = User::findOrFail($userId);
        $user->products()->detach($productId);
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
