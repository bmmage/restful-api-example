<?php

namespace  App\Http\Requests\Products;

class ProductUpdate extends ProductCreate
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update-product');
    }
}
