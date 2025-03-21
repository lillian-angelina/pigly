<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\UpdateGoalWeightRequest; 

class WeightTargetController extends Controller
{
    // 目標体重設定フォーム表示
    public function goalSetting(): RedirectResponse|View
    {
        // ログインしているユーザーを取得
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        // ユーザーに関連する目標体重を取得
        $weightTarget = $user->weightTarget;  // もし weight_target が存在しない場合は null になります
    
        return view('weight_logs.goal_setting', compact('weightTarget'));
    }

    // 目標体重設定フォーム表示
    public function edit()
    {
        // ログインしているユーザーを取得
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        // ユーザーに関連する目標体重を取得
        $weightTarget = $user->weightTarget;  // もし weight_target が存在しない場合は null になります
    
        return view('weight_logs.goal_setting', compact('weightTarget'));  // 目標体重をビューに渡す
    }

    // 目標体重を更新
    public function update(UpdateGoalWeightRequest $request)
    {
        // バリデーションを行う
        $validated = $request->validate([
            'goal_weight' => 'required|numeric|min:1',  // 数値で1以上の値
        ]);

        // ユーザーが設定した目標体重をデータベースに保存（例: `WeightTarget` モデルを使って保存）
        $user = auth()->user();  // 現在ログインしているユーザーを取得
        $user->weight_target = $request->validated()['goal_weight'];  // 目標体重を更新

        $user->save();  // 保存

        // 成功した場合はリダイレクトまたはメッセージを返す
        return redirect()->route('weight_logs.goal_setting')->with('success', '目標体重が更新されました！');
    }
}
