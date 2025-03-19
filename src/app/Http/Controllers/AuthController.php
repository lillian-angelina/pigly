<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // 登録フォームの表示（Step 1）
    public function showRegistrationForm()
    {
        return view('auth.register_step1');
    }

    // 登録処理（Step 1）
    public function register(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ユーザーの作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録したユーザーでログイン
        Auth::login($user);

        return redirect()->route('register.step2');  // Step 2 にリダイレクト
    }

    // 初期目標設定フォームの表示（Step 2）
    public function showInitialGoalForm()
    {
        return view('auth.register_step2');
    }

    // 初期目標設定（Step 2）
    public function setInitialGoal(Request $request)
    {
        // バリデーション
        $request->validate([
            'goal_weight' => 'required|numeric|min:1',
        ]);

        // 現在ログイン中のユーザーを取得
        $user = Auth::user();
        
        // 初期目標体重を設定
        $user->weight_target = $request->goal_weight;
        $user->save();

        return redirect()->route('home');  // ログイン後にホーム画面にリダイレクト
    }

    // ログインフォームの表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // ログイン試行
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');  // ログイン後にホーム画面にリダイレクト
        }

        // ログイン失敗時のエラーメッセージ
        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');  // ログインページにリダイレクト
    }
}
