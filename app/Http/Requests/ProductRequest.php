<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'product_name' => 'required|string|max:20',
            'company_name' => 'required|string',
            'price' => 'required|numeric|max:999',
            'stock' => 'required|integer',
        ];
    }

    public function attributes() {
        return [
            'product_name' => '商品名',
            'company_name' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
        ];
    }

    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
        ];
    }
}
