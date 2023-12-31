<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2'],
            'main_image' => ['required', 'mimes:jpeg,jpg,bmp,png,webp', 'max:2000'],
            'slider_image' => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:2000'],
            'description' => ['nullable', 'string', 'min:10'],
            'price' => ['required', 'numeric'],
            'slider' => ['nullable', 'boolean'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'kits' => ['nullable', 'array'],
            'kits.*' => ['numeric', 'exists:kits,id'],
            'similars' => ['nullable', 'array'],
            'similars.*' => ['numeric', 'exists:products,id'],
        ];
    }
}
