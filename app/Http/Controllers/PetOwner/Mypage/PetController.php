<?php

namespace App\Http\Controllers\PetOwner\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet; 

class PetController extends Controller
{
    public function index()
    {
        $petOwner = Auth::guard('petowner')->user();

        $pets = $petOwner->pets;

        return view('mypage.pet', compact('pets'));
    }

    public function create()
    {
        return view('mypage.add-pet');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\PetOwner $petOwner */
        $petOwner = Auth::guard('petowner')->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $petOwner->pets()->create($request->all());

        return redirect()->route('mypage.pets.index')->with('success', 'Your new pet has been added!');
    }

    public function edit(Pet $pet)
    {
        // 認証済みユーザーがこのペットのオーナーであることを確認
        if (Auth::guard('petowner')->user()->id !== $pet->pet_owner_id) {
            abort(403);
        }

        return view('mypage.pet-edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        // 認証済みユーザーがこのペットのオーナーであることを確認
        if (Auth::guard('petowner')->user()->id !== $pet->pet_owner_id) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $pet->update($request->all());

        return redirect()->route('mypage.pets.index')->with('success', 'Your pet information has been updated!');
    }

    public function destroy(Pet $pet)
    {
        if (Auth::guard('petowner')->user()->id !== $pet->pet_owner_id) {
            abort(403);
        }

        $pet->delete();

        return redirect()->route('mypage.pets.index')->with('success', 'Pet has been removed successfully!');
    }


}
