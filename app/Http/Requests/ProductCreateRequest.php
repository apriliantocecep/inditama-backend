<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_category_id' => 'required|exists:App\Models\ProductCategory,id'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $content = [
            'error' => true,
            'data' => [
                'message' => $validator->errors()->first(),
            ]
        ];

        $response = new \Illuminate\Http\Response($content, 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
