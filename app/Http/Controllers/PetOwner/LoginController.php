<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('pet_owner.login');
    }

    public function login(Request $request)
    {
        // 1.validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'remember_me' が存在し、'on' の値を持つことを検証
            'remember_me' => 'accepted',
        ]);

        // 2. 認証情報の準備
        $credentials = [
            'email_address' => $request->email,
            'password' => $request->password,
        ];

        // 3. 認証の試行
        // バリデーションが通ったので、Auth::attempt()には'true'か'false'を渡す
        $remember = $request->has('remember_me');
        if (Auth::guard('petowner')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mypage/profile');
        }

        // 4. 認証失敗
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('petowner')->logout();

        // セッションを無効化
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pet_owner.login')->with('status', 'You have been logged out.');

    }
}
