<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class SendBasicRequest extends FormRequest
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
     * @return array
     */
    public function rules() {
        return [
            'first_start_time' => 'nullable|date_format:H:i',
            'first_end_time' => 'nullable|date_format:H:i',
            'second_start_time' => 'nullable|date_format:H:i',
            'second_end_time' => 'nullable|date_format:H:i',
            'third_start_time' => 'nullable|date_format:H:i',
            'third_end_time' => 'nullable|date_format:H:i',
            'fourth_start_time' => 'nullable|date_format:H:i',
            'fourth_end_time' => 'nullable|date_format:H:i',
            'sentence' => 'required|max:300',
            'image' =>  'file|image|mimes:jpeg,png,jpg|max:3000',
            'number_of_seats' => 'nullable|integer',
            'payment_options' => 'required',
            'hp' => 'nullable|starts_with:http',
            'sns' => 'nullable|starts_with:http',
            'twitter' => 'nullable|starts_with:https://twitter.com',
            'instagram' => 'nullable|starts_with:https://www.instagram.com',
            'facebook' => 'nullable|starts_with:https://www.facebook.com',
            'holiday' => 'nullable',
            'lunch_estimated_amount' => 'nullable',
            'dinner_estimated_amount' => 'nullable',
        ];
    }

    public function messages(){
        return [
            'first_start_time.date_format' => "開始時間（昼）の入力形式が違います。",
            'second_start_time.date_format' => "開始時間（夜）の入力形式が違います。",
            'third_start_time.date_format' => "開始時間（昼）の入力形式が違います。",
            'fourth_start_time.date_format' => "開始時間（夜）の入力形式が違います。",
            'first_end_time.date_format' => "終了時間(昼)の入力形式が違います。",
            'second_end_time.date_format' => "終了時間(夜)の入力形式が違います。",
            'third_end_time.date_format' => "終了時間(昼)の入力形式が違います。",
            'fourth_end_time.date_format' => "終了時間(夜)の入力形式が違います。",
            'sentence.required' => '紹介は必須です。',
            'sentence.max' => '紹介は300字までに収めてください。',
            'number_of_seats.required' => '席数は必須です。',
            'number_of_seats.integer' => '席数は半角数字のみで記入してください。',
            'image' => 'トップ画像は「jpg」,「jpeg」,「png」のみ可能です。'
        ];
    }

}
