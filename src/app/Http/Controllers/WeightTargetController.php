<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget; 

class WeightTargetController extends Controller
{
     // 目標体重設定フォーム表示
     public function edit()
     {
         return view('weight_logs.goal_setting');  // goal_setting.blade.php ビューを表示
     }
 
     // 目標体重を更新
     public function update(Request $request)
     {
         // バリデーションを行う
         $validated = $request->validate([
             'goal_weight' => 'required|numeric|min:1',  // 数値で1以上の値
         ]);
 
         // ユーザーが設定した目標体重をデータベースに保存（例: `WeightTarget` モデルを使って保存）
         $user = auth()->user();  // 現在ログインしているユーザーを取得
         $user->weight_target = $validated['goal_weight'];  // `weight_target` カラムに目標体重を設定
 
         $user->save();  // 保存
 
         // 成功した場合はリダイレクトまたはメッセージを返す
         return redirect()->route('weight_logs.goal_setting')->with('success', '目標体重が更新されました！');
     }
}
