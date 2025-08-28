<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\SalonCode;

class SalonController extends Controller
{
    public function index()
    {
        $ownerId = Auth::guard('petowner')->id();

        $salonCodes = SalonCode::with('salon')
            ->where('petowner_id', $ownerId)
            ->latest()
            ->get();

        return view('mypage.salon', compact('salonCodes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'salon_code' => ['required', 'string', 'max:100', Rule::exists('salons', 'salon_code')],
        ]);

        $ownerId = Auth::guard('petowner')->id();

        $dup = SalonCode::where('petowner_id', $ownerId)
            ->where('salon_code', $data['salon_code'])
            ->exists();

        if ($dup) {
            return back()->with('error', 'This salon is already registered.')->withInput();
        }

        SalonCode::create([
            'petowner_id' => $ownerId,
            'salon_code'  => $data['salon_code'],
        ]);

        return back()->with('success', 'Added the salon.');
    }


    public function destroy(SalonCode $salonCode)
    {
        abort_unless($salonCode->petowner_id === Auth::guard('petowner')->id(), 403);

        $salonCode->delete();
        return back()->with('success', 'The salon has been removed.');
    }
}
