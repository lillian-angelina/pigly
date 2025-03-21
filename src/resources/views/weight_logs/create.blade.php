<!-- weight_logs/create.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h1>体重登録</h1>
    <form action="{{ route('weight_logs.store') }}" method="post">
        @csrf
        <label>体重: <input type="number" step="0.1" name="weight" required></label>
        <button type="submit">登録</button>
    </form>
    <a href="{{ route('weight_logs.index') }}">戻る</a>
    <!-- モーダル -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>データ追加</h2>
            <form method="POST" action="{{ route('weight_logs.store') }}">
                @csrf
                <label for="weight_id">体重（kg）:</label>
                <input type="number" id="weight_id" name="weight" step="0.1" required>

                <label for="calories_id">摂取カロリー:</label>
                <input type="number" id="calories_id" name="calories">

                <label for="exercise_time_id">運動時間:</label>
                <input type="time" id="exercise_time_id" name="exercise_time">

                <label for="exercise_content_id">運動内容:</label>
                <textarea id="exercise_content_id" name="exercise_content"></textarea>


                <button type="submit">追加</button>
            </form>

        </div>
    </div>
@endsection
