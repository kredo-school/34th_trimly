<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

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
        /** @var \App\Models\PetOwner $petOwner */
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



    public function editProfile()
    {
        $petOwner = Auth::guard('petowner')->user();
        return view('mypage.profile-edit', compact('petOwner'));
    }

    public function updateProfile(Request $request)
    {
        $petOwner = Auth::guard('petowner')->user();

        // バリデーション
        $request->validate([
            'firstName' => ['required', 'string', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'email_address' => ['required', 'string', 'email', 'max:100', Rule::unique('pet_owners')->ignore($petOwner->id, 'id')],
            'phone' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'prefecture' => ['required', 'string', 'max:100'],
        ]);

        // データベースの更新
        /** @var \App\Models\PetOwner $petOwner */
        $petOwner->update([
            'firstname' => $request->input('firstName'),
            'lastname' => $request->input('lastName'),
            'email_address' => $request->input('email_address'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'prefecture' => $request->input('prefecture'),
        ]);

        return redirect()->route('mypage.profile')->with('success', 'Your profile has been updated!');
    }
}
