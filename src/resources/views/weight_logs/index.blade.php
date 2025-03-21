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
            </div>
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
                        @foreach ($weightLogs as $log)
                            <tr class="table_tr">
                                <td class="table_td--first">{{ $log->date }}</td>
                                <td class="table_td">{{ $log->weight }}kg</td>
                                <td class="table_td">{{ $log->calories }}cal</td>
                                <td class="table_td">{{ $log->exercise_time }}</td>
                                <td class="table_td">
                                    <a href="{{ route('weight_logs.edit', $log->id) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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

    <!-- モーダルウィンドウ -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span> <!-- 閉じるボタン -->
            <div id="modal-body">
                <!-- ここに /weight_logs/create の内容を読み込む -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("modal");
            const openModalBtn = document.getElementById("openModal");
            const modalBody = document.getElementById("modal-body");

            // 初期状態はモーダルを非表示
            modal.style.display = "none";

            // 「データ追加」ボタンを押したときの処理
            openModalBtn.addEventListener("click", function (event) {
                event.preventDefault(); // ページ遷移を防ぐ

                fetch("{{ route('weight_logs.create') }}")
                    .then(response => response.text())
                    .then(html => {
                        modalBody.innerHTML = html; // モーダル内に取得したHTMLを挿入
                        modal.style.display = "flex"; // モーダルを表示
                        attachCloseEvent(); // 閉じるイベントを設定
                    })
                    .catch(error => console.error("Error loading modal content:", error));
            });

            // モーダルを閉じる処理
            function closeModal() {
                modal.style.display = "none";
                modalBody.innerHTML = ""; // モーダルの内容をリセット
            }

            // 閉じるボタンや背景クリックでモーダルを閉じる処理
            function attachCloseEvent() {
                setTimeout(() => {
                    const closeBtn = document.querySelector(".close-btn"); // 再取得
                    const cancelBtn = document.querySelector("#cancel-btn"); // キャンセルボタン

                    if (closeBtn) {
                        closeBtn.addEventListener("click", closeModal);
                    }

                    if (cancelBtn) {
                        cancelBtn.addEventListener("click", closeModal);
                    }

                    // モーダル外をクリックしたら閉じる
                    modal.addEventListener("click", function (event) {
                        if (event.target === modal) {
                            closeModal();
                        }
                    });
                }, 300); // 少し遅延させて確実に要素を取得
            }
        });
    </script>


@endsection