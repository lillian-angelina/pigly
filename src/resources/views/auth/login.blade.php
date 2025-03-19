<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>ログイン</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary"><a href="/login">ログイン</a></button>
        </form>
    </div>
@endsection
