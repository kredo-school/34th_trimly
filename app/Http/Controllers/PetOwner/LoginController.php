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
           
        ]);

        // 2. prepare for credentials
        $credentials = [
            'email_address' => $request->email,
            'password' => $request->password,
        ];

        // 3. try to do credential
        // バリデーションが通ったので、Auth::attempt()には'true'か'false'を渡す
        $remember = $request->has('remember_me');
        if (Auth::guard('petowner')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mypage/profile');
        }

        // 4. If error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('petowner')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pet_owner.login')->with('status', 'You have been logged out.');

    }
}
