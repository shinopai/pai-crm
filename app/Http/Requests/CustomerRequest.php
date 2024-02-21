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
            'postcode' => 'required|string|regex:/^[0-9]{7}$/',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'gender' => 'required',
            'memo' => 'max:255'
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
            'name' => '顧客名',
            'tel' => '電話番号',
            'email' => 'メールアドレス',
            'postcode' => '郵便番号',
            'address' => '住所',
            'birthday' => '生年月日',
            'gender' => '性別',
            'memo' => 'メモ'
        ];
    }
}
