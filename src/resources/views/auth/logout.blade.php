<!-- auth/logout.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/logout.css') }}">
@endsection

@section('content')
<h1>ログアウト</h1>
<p>ログアウトしますか？</p>
<form id="form" action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <!-- ドアアイコンの追加 -->
    <button type="submit" class="logout-btn"><i class="fas fa-door-open"></i>ログアウト</button>
</form>

<a href="{{ route('weight_logs.index') }}">キャンセル</a>
@endsection