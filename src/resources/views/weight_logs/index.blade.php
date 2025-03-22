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


    @section('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("modal");
                const openModalBtn = document.getElementById("openModal");
                const modalBody = document.getElementById("modal-body");

                // **モーダルを開く処理**
                if (openModalBtn) {
                    openModalBtn.addEventListener("click", function (event) {
                        event.preventDefault();

                        fetch("{{ route('weight_logs.create') }}")
                            .then(response => response.text())
                            .then(html => {
                                modalBody.innerHTML = html;
                                modal.classList.add("show");

                                // **モーダルのフォームにイベントを追加**
                                setTimeout(() => {
                                    attachFormSubmitEvent(); // フォーム送信処理を追加
                                }, 300);
                            })
                            .catch(error => console.error("Error loading modal content:", error));
                    });
                } else {
                    console.warn('openModal button not found!');
                }

                // **モーダルを閉じる処理**
                function closeModal() {
                    console.log("Closing modal...");
                    modal.classList.remove("show");
                    setTimeout(() => {
                        modalBody.innerHTML = ""; // モーダルの内容をリセット
                    }, 300);
                }

                modal.addEventListener("click", function (event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });

                document.addEventListener("click", function (event) {
                    if (event.target.classList.contains("close-btn")) {
                        closeModal();
                    }
                });

                // **フォーム送信処理をモーダル内に適用**
                function attachFormSubmitEvent() {
                    const weightLogForm = document.getElementById('weightLogForm');
                    if (!weightLogForm) {
                        console.warn("weightLogForm not found! Skipping event attachment.");
                        return;
                    }

                    weightLogForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        let formData = new FormData(this);
                        let submitButton = document.getElementById('submitBtn');

                        submitButton.disabled = true;

                        fetch("{{ route('weight_logs.store') }}", {
                            method: 'POST',
                            body: formData,
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);

                                if (data.errors) {
                                    if (data.errors.date) {
                                        document.getElementById('date-error').innerText = data.errors.date[0];
                                    }
                                    if (data.errors.weight) {
                                        document.getElementById('weight-error').innerText = data.errors.weight[0];
                                    }
                                    if (data.errors.calories) {
                                        document.getElementById('calories-error').innerText = data.errors.calories[0];
                                    }
                                    if (data.errors.exercise_time) {
                                        document.getElementById('exercise_time-error').innerText = data.errors.exercise_time[0];
                                    }
                                    if (data.errors.exercise_content) {
                                        document.getElementById('exercise_content-error').innerText = data.errors.exercise_content[0];
                                    }
                                } else {
                                    alert('登録が完了しました');
                                    location.reload();
                                }

                                submitButton.disabled = false;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                submitButton.disabled = false;
                            });
                    });
                }
            });
        </script>



    @endsection

@endsection