<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerItemRequest extends FormRequest
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
            'quantity' => 'required',
            'purchase_datetime' => 'required|before:today'
        ];
    }

    /**
     * カラム名
     *
     * @return array カラム名
     */
    public function attributes()
    {
        return [
            'quantity' => '購入数',
            'purchase_datetime' => '購入日時'
        ];
    }
}
