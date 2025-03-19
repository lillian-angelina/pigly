<!-- weight_logs/search.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
<h1>体重検索</h1>
<form action="{{ route('weight_logs.search') }}" method="get">
    <label>日付: <input type="date" name="date"></label>
    <button type="submit">検索</button>
</form>
<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection