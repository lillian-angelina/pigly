<?php

// app/Http/Controllers/WeightLogController.php
namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index() {
        // 2023/11/19から2023/11/26までのデータを取得
        $weightLogs = WeightLog::whereBetween('date', ['2023-11-19', '2023-11-26'])->get();
        $weightLogs = WeightLog::orderBy('date', 'desc')->paginate(8);

        return view('weight_logs.index', compact('weightLogs'));
    }

    public function create() {
        return view('weight_logs.create');
    }

    public function store(Request $request) {
        WeightLog::create($request->all());
        return redirect('/weight_logs');
    }

    public function search(Request $request) {
        $logs = WeightLog::where('date', $request->date)->get();
        return view('weight_logs.search', compact('logs'));
    }

    public function show(WeightLog $weightLog) {
        return view('weight_logs.show', compact('weightLog'));
    }

    public function edit(WeightLog $weightLog) {
        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(Request $request, WeightLog $weightLog) {
        $weightLog->update($request->all());
        return redirect('/weight_logs');
    }

    public function destroy(WeightLog $weightLog) {
        $weightLog->delete();
        return redirect('/weight_logs');
    }
}
