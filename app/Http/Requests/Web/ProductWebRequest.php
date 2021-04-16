<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductWebRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'id' => ['numeric', 'exists:products,id', 'nullable'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string']
        ];
    }

}
