<!-- resources/views/auth/register_step2.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register_step2.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>目標体重設定</h2>
        <form action="{{ url('/register/step2') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="goal_weight">目標体重</label>
                <input type="number" name="goal_weight" id="goal_weight" class="form-control" value="{{ old('goal_weight') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">設定する</button>
        </form>
    </div>
@endsection
