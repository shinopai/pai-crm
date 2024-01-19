<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'price' => 'required|numeric|between:300,9999',
            'status' => 'required'
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
            'name' => '商品名',
            'price' => '値段',
            'status' => '販売状況'
        ];
    }
}
