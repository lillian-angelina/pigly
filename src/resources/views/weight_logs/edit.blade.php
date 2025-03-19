<!-- weight_logs/edit.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<h1>体重更新</h1>
<form action="{{ route('weight_logs.update', $weightLog->id) }}" method="post">
    @csrf
    @method('PUT')
    <label>体重: <input type="number" step="0.1" name="weight" value="{{ $weightLog->weight }}" required></label>
    <button type="submit">更新</button>
</form>
<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection