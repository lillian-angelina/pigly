<?php

// app/Http/Controllers/WeightLogController.php
namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\WeightLogRequest;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric',
            'calories' => 'required|numeric',
            'exercise_time' => 'required|integer',
            'exercise_content' => 'nullable|string',
        ]);

        WeightLog::create($validated);

        return response()->json([
            'message' => '登録が完了しました',
        ]);
    }

    public function search(Request $request)
    {
        // フォームの入力値を取得
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = WeightLog::query();

        if ($startDate) {
            $query->where('date', '>=', $startDate);
            $startDateFormatted = Carbon::parse($startDate)->format('Y年m月d日'); // 日本語形式に変換
        } else {
            $startDateFormatted = '指定なし';
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
            $endDateFormatted = Carbon::parse($endDate)->format('Y年m月d日');
        } else {
            $endDateFormatted = '指定なし';
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(10);

        return view('weight_logs.search', compact('weightLogs', 'startDateFormatted', 'endDateFormatted'));
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
