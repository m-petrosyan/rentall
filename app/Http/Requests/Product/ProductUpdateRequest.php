<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'min:2'],
            'image' => ['nullable', 'mimes:jpeg,jpg,bmp,png,webp', 'max:2000'],
            'description' => ['nullable', 'string', 'min:10'],
            'price' => ['nullable', 'numeric'],
            'slider' => ['nullable', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'kits' => ['nullable', 'array'],
            'kits.*' => ['numeric'],
        ];
    }
}
