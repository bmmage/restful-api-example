<?php

namespace App\Transformers;

use App\User;

class JwtUserTransformer extends SimpleTransformer
{
    protected $expectedClass = User::class;

    /**
     * User model with a token and refresh property added
     * @inheritdoc
     */
    protected function mapItem($item): array
    {
        return [
            'token' => $item->token,
            'first_name' => $item->first_name,
            'last_name' => $item->last_name,
            'full_name' => $item->first_name . ' ' . $item->last_name,
            'email' => $item->email,
        ];
    }
}