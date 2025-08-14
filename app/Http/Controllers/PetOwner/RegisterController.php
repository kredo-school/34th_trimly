<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\PetOwner;
use App\Models\Pet;
use App\Models\Salon;
use App\Models\SalonCode;


class RegisterController extends Controller
{
    public function showSalonCode()
    {
        return view('pet_owner.register.salon_code');
    }
    public function showPetOwner()
    {
        // SalonCodeがセッションに存在しない場合、最初のステップに戻す
        // if (!Session::has('registration_data.salon_code')) {
        //     return redirect()->route('pet_owner.register.saloncode');
        // }
        return view('pet_owner.register.pet_owner');
    }
    public function showPet()
    {
        return view('pet_owner.register.pet');
    }
    public function showConfirm()
    {
        return view('pet_owner.register.confirm');
    }
    public function showComplete()
    {
        return view('pet_owner.register.complete');
    }

    // Step 1: サロンコードの検証とセッション保存
    public function postSalonCode(Request $request)
    {
        $request->validate([
            'salonCode' => ['required', 'string', 'max:100'],
        ]);

        // salonsテーブルでsalon_codeをチェック
        $salon = Salon::where('salon_code', $request->input('salonCode'))->first();

        if ($salon) {
            // 存在する場合、salon_codeだけをセッションに保存
            // ユーザー登録完了後にPetOwner IDと紐づけてsalon_codeテーブルに登録する
            Session::put('registration_data.salon_code', $salon->salon_code);

            // 成功メッセージと共に次のページへリダイレクト
            return redirect()->route('pet_owner.register.petowner')
                ->with('success', 'Valid salon code');
        }

        // 失敗した場合、エラーメッセージと共に元のページへ戻る
        return back()->withErrors(['salonCode' => 'Invalid salon code. Please check with your salon.'])->withInput();
    }


    // Step 2: ペットオーナー情報の検証とセッション保存
    public function postPetOwner(Request $request)
    {
        // バリデーション
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pet_owners,email'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:255'],
            'prefecture' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // パスワードをハッシュ化
        $validatedData = $request->only(['firstName', 'lastName', 'email', 'phoneNumber', 'city', 'prefecture']);
        $validatedData['password'] = Hash::make($request->input('password'));

        // セッションに一時保存
        Session::put('registration_data.pet_owner', $validatedData);

        // 次のステップ（ペット情報入力）へリダイレクト
        return redirect()->route('pet_owner.register.pet');
    }
}
