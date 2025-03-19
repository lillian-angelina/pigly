<!-- resources/views/auth/register_step1.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register_step1.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>アカウント作成</h2>
        <form action="{{ url('/register/step1') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">次へ</button>
        </form>
    </div>
@endsection
