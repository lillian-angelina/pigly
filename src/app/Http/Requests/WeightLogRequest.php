<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 認証が不要な場合はtrue。必要に応じて認証条件を追加
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date', // 日付は必須で、正しい日付形式である必要がある
            'weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/', // 体重は必須、数値、4桁以内、小数点1桁
            'calories' => 'required|numeric', // カロリーは必須、数値
            'exercise_time' => 'required|numeric', // 運動時間は必須、数値
            'exercise_content' => 'max:120', // 運動内容は120文字以内
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '日付が正しくありません',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.digits_between' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.numeric' => '運動時間は数字で入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
