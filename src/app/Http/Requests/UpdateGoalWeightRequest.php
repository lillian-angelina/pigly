<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalWeightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 現在のユーザーがこのリクエストを実行できるか確認
        return true; // 認証が必要な場合はauth()->check()などを使用
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goal_weight' => 'required|numeric|min:1',  // 目標体重は必須かつ1以上の数値
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
            'goal_weight.required' => '目標体重は必須です。',
            'goal_weight.numeric' => '目標体重は数値で入力してください。',
            'goal_weight.min' => '目標体重は1以上でなければなりません。',
        ];
    }
}
