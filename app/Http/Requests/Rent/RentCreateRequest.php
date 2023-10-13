<?php

namespace App\Http\Requests\Rent;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'full_name' => ['required', 'string', 'min:3'],
            'tel' => ['required', 'regex:/^[+0-9]+$/', 'min:9', 'max:16'],
            'email' => ['required', 'email'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'comment' => ['nullable', 'min:5'],
            'products' => ['required', 'array'],
            'products.*' => ['numeric', 'exists:products,id'],

        ];
    }
}
