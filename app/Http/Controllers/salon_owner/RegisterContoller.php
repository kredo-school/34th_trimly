<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalonOwnerController extends Controller
{
    // Step 1: Show registration form
    public function create()
    {
        return view('salon_owner.register.salon-info');
    }

    // Step 2: Confirm input data
    public function confirm(Request $request)
    {
        // Validation rules matching database fields
        $validated = $request->validate([
            'salonname' => 'required|string|max:100',
            'ownerFirstName' => 'required|string|max:100',
            'ownerLastName' => 'required|string|max:100',
            'emailAddress' => 'required|email|unique:salons,email_address|max:100',
            'phoneNumber' => 'required|string|max:20',
            'businessAddress' => 'required|string',  // Not in DB, session only
            'city' => 'required|string',            // Not in DB, session only
            'state' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'website' => 'nullable|url|max:255',
            'businessLicense' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Map form field names to DB column names
        $data = [
            'salonname' => $validated['salonname'],
            'firstname' => $validated['ownerFirstName'],
            'lastname' => $validated['ownerLastName'],
            'email_address' => $validated['emailAddress'],
            'phone' => $validated['phoneNumber'],
            'state' => $validated['state'],
            'password' => $validated['password'],
            'website' => $validated['website'] ?? null,
            'licencenum' => $validated['businessLicense'] ?? null,
            'description' => $validated['description'] ?? null,
            // Keep business_address and city for display purposes
            'businessAddress' => $validated['businessAddress'],
            'city' => $validated['city'],
        ];

        // Store in session
        $request->session()->put('salon_registration', $data);
        
        return view('salon_owner.register.confirm', ['data' => $data]);
    }

    // Step 3: Generate salon code and save to database
    public function store(Request $request)
    {
        $data = $request->session()->get('salon_registration');
        
        if (!$data) {
            return redirect()->route('salon.register.create');
        }

        // Generate unique salon code
        $salonCode = $this->generateUniqueSalonCode();

        // Save to database
        $salon = Salon::create([
            'salon_code' => $salonCode,
            'salonname' => $data['salonname'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email_address' => $data['email_address'],
            'phone' => $data['phone'],
            'state' => $data['state'],
            'password' => Hash::make($data['password']),
            'website' => $data['website'],
            'licencenum' => $data['licencenum'],
            'description' => $data['description'],
            'open_time' => '09:00:00',
            'close_time' => '18:00:00',
        ]);

        // Clear registration data and store salon code
        $request->session()->forget('salon_registration');
        $request->session()->put('salon_code', $salonCode);

        return view('salon_owner.register.salon-code', ['salonCode' => $salonCode]);
    }

    // Step 4: Show completion page
    public function complete(Request $request)
    {
        $salonCode = $request->session()->get('salon_code');
        
        if (!$salonCode) {
            return redirect()->route('salon.register.create');
        }

        $request->session()->forget('salon_code');
        
        return view('salon_owner.register.complete');
    }

    // Generate unique salon code
    private function generateUniqueSalonCode()
    {
        do {
            $code = 'G' . rand(1, 9) . 'P' . rand(100000, 999999);
        } while (Salon::where('salon_code', $code)->exists());

        return $code;
    }
}