<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;


class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'discount_.*' => 'integer|min:1|required',
        ];
    }

    public function messages(){
        return [
            'discount_.*.integer' => '割引額は半角数字のみで記入してください。',
            'discount_.*.min' => '割引額は1以上の半角数字を記入してください。',
            'discount_.*.required' => '割引額の欄に1以上の半角数字を必ず設定してください。',
        ];
    }
}
