<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name.*' => 'nullable', 
            'price.*' => 'integer|nullable',
            'drink_name' => 'nullable', 
            'drink_price' => 'integer|nullable', 
            'food_name' => 'nullable', 
            'food_price' => 'integer|nullable', 
            'course_name' => 'nullable', 
            'course_price' => 'integer|nullable',
            'detail' => 'nullable',
        ];
    }


    public function messages(){
        return [
            'name.required' => 'メニュー名は必須です。',
            'drink_name.required' => 'メニュー名は必須です。',
            'food_name.required' => 'メニュー名は必須です。',
            'course_name.required' => 'コース名は必須です。',
            'price.*.integer' => '価格は半角数字のみで記入してください。',
            'drink_price.integer' => '価格は半角数字のみで記入してください。',
            'food_price.integer' => '価格は半角数字のみで記入してください。',
            'course_price.integer' => '価格は半角数字のみで記入してください。'
        ];
    }
}
