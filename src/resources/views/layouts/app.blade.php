<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    @yield('css')
    <header class="header">
        <a class="header-a" href="{{ route('weight_logs.index') }}">PiGLy</a>
        <div class="header-frame">
            <form class="header-frame_setting" action="{{ route('weight_logs.goal_setting') }}" method="GET">
                @csrf
                <!-- 歯車アイコンの追加 -->
                <i class="fas fa-cog"></i>
                <a class="header-frame_setting-btn" href="{{ route('weight_logs.goal_setting') }}">目標体重設定</a>
            </form>
            <div class="header-frame_logout">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <!-- ドアアイコンの追加 -->
                    <button type="submit" class="header-frame_logout-btn"><i class="fas fa-door-open"></i>ログアウト</button>
                </form>
            </div>
        </div>
    </header>

@yield('js')

    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
</body>

</html>