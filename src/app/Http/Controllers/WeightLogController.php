<?php

// app/Http/Controllers/WeightLogController.php
namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\WeightLogRequest;

class WeightLogController extends Controller
{
    public function index()
    {
        // 2023/11/19から2023/11/26までのデータを取得
        $weightLogs = WeightLog::whereBetween('date', ['2023-11-19', '2023-11-26'])->get();
        $weightLogs = WeightLog::orderBy('date', 'desc')->paginate(8);

        return view('weight_logs.index', compact('weightLogs'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(WeightLogRequest $request)
    {
        // バリデーションを追加
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0', // weightが必須かつ0以上の数字
            'calories' => 'nullable|numeric',
            'exercise_time' => 'nullable|date_format:H:i:s',
            'exercise_content' => 'nullable|string',
        ]);

        // バリデーションを通過した後にデータを挿入
        DB::table('weight_logs')->insert([
            'user_id' => auth()->id(),
            'date' => now()->toDateString(),
            'weight' => $request->validated()['weight'],
            'calories' => $request->validated()['calories'],
            'exercise_time' => $request->validated()['exercise_time'],
            'exercise_content' => $request->validated()['exercise_content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', '記録が追加されました！');
    }

    public function search(Request $request)
    {
        // バリデーション（オプションで必要なら追加）
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // start_dateより後であることを確認
        ]);

        // 開始日と終了日が指定されていれば、該当するデータを取得
        $weightLogs = WeightLog::query()
            ->where('user_id', auth()->id())
            ->when($request->start_date, function ($query) use ($request) {
                return $query->where('date', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->where('date', '<=', $request->end_date);
            })
            ->orderBy('date', 'desc') // 日付順で並べる
            ->paginate(8);

        // ビューにデータを渡す
        return view('weight_logs.index', compact('weightLogs'));
    }

    public function show(WeightLog $weightLog)
    {
        if (!$weightLog) {
            return redirect()->route('weight_logs.index')->with('error', 'Weight log not found');
        }

        // weight_target が存在しない場合に備えて、null チェックを追加
        $weightTarget = $weightLog->user->weightTargets->first(); // もし weightTargets が存在しない場合は null になる

        // ビューに渡す前に null チェック
        if (!$weightTarget) {
            return redirect()->route('weight_logs.index')->with('error', 'Weight target not found for the user');
        }

        return view('weight_logs.show', compact('weightLog', 'weightTarget'));
    }

    public function edit(WeightLog $weightLog)
    {
        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, WeightLog $weightLog)
    {
        // バリデーションを通過した後にデータを更新
        $weightLog->update($request->validated());

        return redirect('/weight_logs');
    }

    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect('/weight_logs');
    }
}
