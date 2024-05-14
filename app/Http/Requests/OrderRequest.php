<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mockery\Generator\Method;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() == "POST")
            return [
                'user_id' => 'required|string',
                'products' => 'required|array',
                'products.*.product_id' => 'required|string',
                'products.*.quantity' => 'required|integer|min:1',
                'products.*.unit_price' => 'required|numeric|min:0'
            ];
        return [
            'status' => 'integer|in:0,1,2',
            'cancelled_by' => 'integer|in:0,1,2',
            'products' => 'array',
            'products.*.product_id' => 'required_with:products|string',
            'products.*.quantity' => 'required_with:products|integer|min:1',
            'products.*.unit_price' => 'required_with:products|numeric|min:0',
        ];
    }
}
