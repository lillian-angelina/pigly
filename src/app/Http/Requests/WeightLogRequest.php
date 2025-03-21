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
        // 現在のユーザーがこのリクエストを実行できるか確認
        return true; // ここで認証チェックを追加したい場合は適切な条件を設定
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => 'required|numeric|min:0', // 体重は必須かつ0以上の数値
            'calories' => 'nullable|numeric', // カロリーは任意、数値
            'exercise_time' => 'nullable|date_format:H:i:s', // 時間形式（H:i:s）
            'exercise_content' => 'nullable|string', // 運動内容は任意、文字列
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
            'weight.required' => '体重は必須です。',
            'weight.numeric' => '体重は数値で入力してください。',
            'weight.min' => '体重は0以上でなければなりません。',
            'calories.numeric' => 'カロリーは数値で入力してください。',
            'exercise_time.date_format' => '運動時間はH:i:sの形式で入力してください。',
            'exercise_content.string' => '運動内容は文字列で入力してください。',
        ];
    }
}
