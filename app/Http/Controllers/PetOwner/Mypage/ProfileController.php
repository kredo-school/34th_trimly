<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $petOwner = Auth::guard('petowner')->user();

        return view('mypage.profile', compact('petOwner'));
    }

    public function updatePassword(Request $request)
    {
       
        // 1. バリデーション
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. 現在のパスワードの確認
        $petOwner = Auth::guard('petowner')->user();

        if (!Hash::check($request->current_password, $petOwner->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        // 3. パスワードの更新
        $petOwner->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('status', 'Password updated successfully!');
       
    
    }
}
