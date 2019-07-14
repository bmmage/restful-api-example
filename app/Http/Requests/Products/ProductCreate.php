<?php

namespace  App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;

class ProductCreate extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('add-product');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:products,name',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'image_url' => 'sometimes|max:255',
            'thumbnail_url' => 'sometimes|max:255'
        ];
    }
}
