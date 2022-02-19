<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required', 
            'service_type' => 'required', 
            'price' => 'integer|required',
            'menu_file' => 'image|mimes:jpeg,png,jpg,|max:3000'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'メニュー名は必須です。',
            'price.integer' => '価格は半角数字のみで記入してください。',
            'price.required' => '価格を入力してください。',
            'menu_file' => '「jpg」,「jpeg」,「png」の画像を添付してください。',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


}
