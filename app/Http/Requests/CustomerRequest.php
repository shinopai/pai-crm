<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'tel' => 'required|numeric|digits_between:8,11|unique:customers',
            'email' => 'required|email:filter,dns|unique:customers',
            'postcode' => 'required|string|regex:/^d{3}d{4}$/',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required',
            'memo' => 'max:255'
        ];
    }
}
