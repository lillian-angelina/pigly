<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ログインしていない場合は、ゲストユーザーとして処理する
        if (!Auth::check()) {
            // ここで特別な処理を行う場合は追加
        }

        return $next($request);
    }
}
