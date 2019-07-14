<?php

namespace  App\Http\Requests\UserProducts;

use App\Http\Requests\BaseRequest;

class UserProductDelete extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // The authenticated user is the user request access, or the user had an admin permission
        return auth()->user()->id == $this->userId || auth()->user()->can('delete-product-for-user');
    }
}
