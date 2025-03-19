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
            <div class="content_block-2">
                <div class="content_block--item4">

                    <!-- 日付入力フォーム -->
                    <div class="date-range">
                        <input type="date" id="start_date" name="start_date"> ~
                        <input type="date" id="end_date" name="end_date">
                    </div>

                    <!-- 検索ボタン -->
                    <button class="search-btn">検索</button>

                    <!-- データ追加ボタン -->
                    <button class="add-data-btn">データ追加</button>
                </div>
            </div>
            <div class="content_block-3">
                <table class="table">
                    <thead>
                        <tr class="table_tr">
                            <th class="table_th">日付</th>
                            <th>体重</th>
                            <th>食事摂取カロリー</th>
                            <th>運動時間</th>
                            <th>編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/26</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/25</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/24</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/23</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/22</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/21</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/20</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
                        <tr class="table_tr">
                            <td class="table_td">2023/11/19</td>
                            <td>46.5kg</td>
                            <td>1200cal</td>
                            <td>00:15</td>
                            <td><i class="fas fa-pen"></i></td>
                        </tr>
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
@endsection