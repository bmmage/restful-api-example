<?php

namespace App\Transformers;

use App\Product;

class ProductTransformer extends SimpleTransformer
{
    protected $expectedClass = Product::class;

    /**
     * User model with a token and refresh property added
     * @inheritdoc
     */
    protected function mapItem($item): array
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'image_url' => $item->image_url,
            'thumbnail_url' => $item->thumbnail_url,
        ];
    }
}