<?php

namespace App\Http\Controllers\salon_owner;

use App\Models\Salon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SalonOwnerRegisterController extends Controller
{
    /**
     * Step 1: Show registration form
     * Display the initial salon information input form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('salon_owner.register.salon-info');
    }

    /**
     * Step 2: Confirm input data
     * Validate form data and show confirmation page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
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

        // Map form field names to database column names
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

        // Store validated data in session for next step
        $request->session()->put('salon_registration', $data);
        
        return view('salon_owner.register.confirm', ['data' => $data]);
    }

    /**
     * Step 3: Generate salon code and save to database
     * Create salon record and automatically log in the new user
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        // Retrieve registration data from session
        $data = $request->session()->get('salon_registration');
        
        // Redirect to start if no session data found
        if (!$data) {
            return redirect()->route('salon.register.create');
        }

        // Generate unique salon code
        $salonCode = $this->generateUniqueSalonCode();

        // Create new salon record
        $salon = Salon::create([
            'salon_code' => $salonCode,
            'salonname' => $data['salonname'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email_address' => $data['email_address'],
            'phone' => $data['phone'],
            'business_address' => $data['businessAddress'],
            'city' => $data['city'],
            'state' => $data['state'],
            'password' => Hash::make($data['password']),
            'website' => $data['website'],
            'licencenum' => $data['licencenum'],
            'description' => $data['description'],
            'open_time' => '09:00:00',  // Default opening time
            'close_time' => '18:00:00', // Default closing time
        ]);

        // Automatically log in the newly registered salon owner
        $request->session()->put('salon_owner_id', $salon->id);
        $request->session()->put('salon_code', $salon->salon_code);
        $request->session()->put('salon_name', $salon->salonname);
        // Store salon ID in session for additional security checks
        $request->session()->put('salon_id', $salon->id);

        // Clear registration data from session
        $request->session()->forget('salon_registration');
        
        // Store salon code in session for display on next page
        $request->session()->put('salon_code', $salonCode);

        return view('salon_owner.register.salon-code', ['salonCode' => $salonCode]);
    }

    /**
     * Step 4: Show completion page
     * Display registration complete message and dashboard link
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function complete(Request $request)
    {
        // Retrieve salon code from session
        $salonCode = $request->session()->get('salon_code');
        
        // Redirect to start if no salon code found (prevents direct access)
        if (!$salonCode) {
            return redirect()->route('salon.register.create');
        }

        // Clear salon code from session after displaying
        // $request->session()->forget('salon_code');
        
        return view('salon_owner.register.complete');
    }

    /**
     * Generate unique salon code
     * Creates a code in format: G[1-9]P[100000-999999]
     *
     * @return string
     */
    private function generateUniqueSalonCode()
    {
        do {
            // Generate code with pattern: G + single digit + P + 6 digits
            $code = 'G' . rand(1, 9) . 'P' . rand(100000, 999999);
        } while (Salon::where('salon_code', $code)->exists());

        return $code;
    }
}