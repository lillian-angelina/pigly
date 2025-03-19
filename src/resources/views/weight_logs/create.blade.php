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
@endsection