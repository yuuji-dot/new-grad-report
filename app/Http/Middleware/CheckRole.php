<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
{
    $user = Auth::user();
    $currentRoute = $request->route()->getName();

    if ($user && isset($user->authority) ) {
        // ユーザーがログインしており、権限が要求されるものと一致する場合の処理
        return $next($request);
    } else if (
        
        ($request->is('/') || $currentRoute === 'top' || $currentRoute === 'reset') && !$user ||

        $currentRoute === 'password.reset' ||  // パスワードリセット
        $currentRoute === 'user.toppage'  // ユーザートップページ
    ) {
        // ログインしていない場合かつ特定のルートの場合はそのまま表示
        Log::info('Middleware: No matching authority roles.');
        return $next($request);
    } else if (!$user) {
        // ログインしていない場合はログイン画面にリダイレクト
        return Redirect::to('/');
    } else {
        // ログインしており、権限が不一致の場合は共通のトップページにリダイレクト
        return Redirect::to('/top');
    }
}

}




