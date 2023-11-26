<?php

namespace App\Http\Requests\Rent;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class RentCreateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'tel' => ['required'],
            'email' => ['required', 'email'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'comment' => ['nullable', 'min:5'],
            'products' => ['required', 'array'],
            'products.*' => ['numeric', 'exists:products,id'],
//            'total_price' => ['required', 'numeric', RentService::checkTotalPrice($this->input())],
            'total_price' => ['required', 'numeric'],

        ];
    }

    public function messages()
    {
        return [
            'products.*.exists' => 'One or more products are missing from your cart, please clear the card and add the products back to your cart',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $real_price = 0;

            foreach ($this->input('products') as $product) {
                $real_price += Product::find($product)?->price;
            }

            $real_price *= Carbon::create($this->input('start_date'))->diffInDays(
                    Carbon::create($this->input('end_date'))
                ) + 1;

            if ($real_price !== (float)$this->input('total_price')) {
                $validator->errors()->add(
                    'total_price',
                    'The price of one or more items from the cart has changed, please clear the card and add the products back to your cart'
                );
            }
        });
    }
}
