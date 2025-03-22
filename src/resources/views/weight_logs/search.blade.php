@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
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
                <span class="value">-1.5<span class="kg">kg</span></span>
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
                        <form class="search" method="GET" action="{{ route('weight_logs.search') }}">
                            @csrf
                            <input class="date-range_start" type="date" id="start_date" name="start_date"
                                value="{{ request('start_date') }}"> ~
                            <input class="date-range_end" type="date" id="end_date" name="end_date"
                                value="{{ request('end_date') }}">
                            <button class="search-btn" type="submit">検索</button>

                        </form>
                        <button class="add-data-btn" id="openModal">データ追加</button>
                    </div>
                </div>
                <p class="search-result">
                    {{ $startDateFormatted }}～{{ $endDateFormatted }} の検索結果
                    <span>{{ $weightLogs->total() }}件</span>
                </p>

            </div>

            <!-- 検索結果のテーブル -->
            <div class="content_block-3">
                <table class="table">
                    <thead>
                        <tr class="table_tr--head">
                            <th class="table_th">日付</th>
                            <th>体重</th>
                            <th>食事摂取カロリー</th>
                            <th>運動時間</th>
                            <th class="table_th--end">編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($weightLogs as $log)
                            <tr class="table_tr">
                                <td class="table_td--first">{{ $log->date }}</td>
                                <td class="table_td">{{ $log->weight }}kg</td>
                                <td class="table_td">{{ $log->calories }}cal</td>
                                <td class="table_td">{{ $log->exercise_time }}</td>
                                <td class="table_td"><i class="fas fa-pen"></i></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="table_td">該当するデータがありません</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="content_block-4">
                <div class="pagination">
                    @if ($weightLogs->onFirstPage())
                        <span class="prev disabled">&lt;</span>
                    @else
                        <a href="{{ $weightLogs->previousPageUrl() }}" class="prev">&lt;</a>
                    @endif

                    @foreach ($weightLogs->getUrlRange(1, $weightLogs->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="page-number {{ $page == $weightLogs->currentPage() ? 'active' : '' }}">{{
                        $page }}</a>
                    @endforeach

                    @if ($weightLogs->hasMorePages())
                        <a href="{{ $weightLogs->nextPageUrl() }}" class="next">&gt;</a>
                    @else
                        <span class="next disabled">&gt;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection