<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|integer',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string|max:1000',
            'img_path' => 'nullable|file|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'company_id.required' => 'メーカーは必須です。',
            'price.required' => '価格は必須です。',
            'price.integer' => '価格は数値で入力してください。',
            'price.min' => '価格は0以上で入力してください。',
            'stock.required' => '在庫数は必須です。',
            'stock.integer' => '在庫数は数値で入力してください。',
            'stock.min' => '在庫数は0以上で入力してください。',
            'img_path.file' => 'ファイルを選択してください。',
            'img_path.max' => 'ファイルのサイズは2MB以下にしてください。'
        ];
    }


}
