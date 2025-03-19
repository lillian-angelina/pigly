<!-- weight_logs/show.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<h1>体重詳細</h1>
<p>体重: {{ $weightLog->weight }} kg</p>
<p>記録日: {{ $weightLog->created_at }}</p>
<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection
