<!-- resources/views/weight_logs/goal_setting.blade.php -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>目標体重設定</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('weight_logs.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="goal_weight">目標体重</label>
                <input type="number" name="goal_weight" id="goal_weight" class="form-control" value="{{ auth()->user()->weight_target }}" required>
            </div>

            <button type="submit" class="btn btn-primary">更新する</button>
        </form>
    </div>
@endsection
