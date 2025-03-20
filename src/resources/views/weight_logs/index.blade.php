<!-- weight_logs/index.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="content_block-1">
            <div class="weight-item">
                <p class="label">目標体重</p>
                <span class="value">45.0<span class="kg">kg</span></span>
            </div>
            <div class="separator"></div>
            <div class="weight-item">
                <p class="label">目標まで</p>
                <spanpp class="value">-1.5<span class="kg">kg</span></spanpp>
            </div>
            <div class="separator"></div>
            <div class="weight-item">
                <p class="label">最新体重</p>
                <span class="value">46.5<span class="kg">kg</span></span>
            </div>
        </div>
        <div class="content_block-double">
            <div class="content_block-2">
                <div class="content_block--item4">

                    <!-- 日付入力フォーム -->
                    <div class="date-range">
                        <input class="date-range_start" type="date" id="start_date" name="start_date"> ~
                        <input class="date-range_end" type="date" id="end_date" name="end_date">
                        <!-- 検索ボタン -->
                        <form class="search" method="POST" action="{{ route('weight_logs.index') }}">
                            @csrf
                            <button class="search-btn">検索</button>
                            <!-- データ追加ボタン -->
                            <button class="add-data-btn">データ追加</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content_block-3">
                <table class="table">
                    <thead>
                        <tr class="table_tr--head">
                            <th class="table_th">日付</th>
                            <th>体重</th>
                            <th>食事摂取カロリー</th>
                            <th>運動時間</th>
                            <th class="table_th--end">編集</thclass>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weightLogs as $log)
                            <tr class="table_tr">
                                <td class="table_td--first">{{ $log->date }}</td>
                                <td class="table_td">{{ $log->weight }}kg</td>
                                <td class="table_td">{{ $log->calories }}cal</td>
                                <td class="table_td">{{ $log->exercise_time }}</td>
                                <td class="table_td"><i class="fas fa-pen"></i></td>
                            </tr>
                        @endforeach
                        <!-- ページネーションリンクを表示 -->
                        <div class="pagination">
                            {{ $weightLogs->links() }}
                        </div>
                    </tbody>
                </table>
            </div>
            <div class="content_block-4">
                <!-- ページネーション -->
                <div class="pagination">
                    <a href="#" class="prev">&lt;</a>
                    <a href="#" class="page-number">1</a>
                    <a href="#" class="page-number">2</a>
                    <a href="#" class="page-number">3</a>
                    <a href="#" class="next">&gt;</a>
                </div>
            </div>
        </div>

    </div>
@endsection