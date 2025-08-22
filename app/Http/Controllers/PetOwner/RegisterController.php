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
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{
    // Step 1: display salon_code 
    public function showSalonCode()
    {
        return view('pet_owner.register.salon_code');
    }

    // Step 1: validate salon_code & keep session
    public function postSalonCode(Request $request)
    {
        $request->validate([
            'salonCode' => ['required', 'string', 'max:100'],
        ]);

        // Check the salon_code in the salons table.
        $salon = Salon::where('salon_code', $request->input('salonCode'))->first();

        if ($salon) {
            // If it exists, store only the salon_code in the session
            // After the user registration is complete, link it with the PetOwner ID and register it in the salon_code table
            Session::put('registration_data.salon_code', $salon->salon_code);

            // Redirect to the next page with a success message.
            return redirect()->route('pet_owner.register.petowner')
                ->with('success', 'Valid salon code');
        }

        // f it fails, return to the original page with an error message.
        return back()->withErrors(['salonCode' => 'Invalid salon code. Please check with your salon.'])->withInput();
    }



    // Step 2: display pet_owner page
    public function showPetOwner()
    {
        // If the SalonCode is not present in the session, return to step1.
        if (!Session::has('registration_data.salon_code')) {
            return redirect()->route('pet_owner.register.saloncode');
        }
        return view('pet_owner.register.pet_owner');
    }

    // // Step 2: validate pet_owner info & keep session
    public function postPetOwner(Request $request)
    {
        // validation
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pet_owners,email_address'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:255'],
            'prefecture' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // hush password
        $validatedData = $request->only(['firstName', 'lastName', 'email', 'phoneNumber', 'city', 'prefecture']);
        $validatedData['password'] = Hash::make($request->input('password'));

        // keep in the session
        Session::put('registration_data.pet_owner', $validatedData);

        // redirect to the step3
        return redirect()->route('pet_owner.register.pet');
    }


    // Step 3: display pet page
    public function showPet()
    {
        return view('pet_owner.register.pet');
    }

    // Step 3: validate pet info & keep session
    public function postPet(Request $request)
    {

        // Check if Pet Owner data exists in the session.
        if (!Session::has('registration_data.pet_owner')) {
            return redirect()->route('pet_owner.register.petowner');
        }

        try {
            // Validate multiple pet information as an array.
            $request->validate([
                'pets' => ['required', 'array', 'min:1'],
                'pets.*.pet_name' => ['required', 'string', 'max:255'],
                'pets.*.breed' => ['required', 'string', 'max:255'],
                'pets.*.age' => ['required', 'string', 'max:255'],
                'pets.*.weight' => ['required', 'string', 'max:255'],
                'pets.*.gender' => ['required', 'string', 'max:255'],
                'pets.*.special_notes' => ['nullable', 'string'],
            ]);
        } catch (ValidationException $e) {
            // If a validation error occurs, return with an error message.
            return back()->withInput()->withErrors($e->errors());
        }

        // If a validation error occurs, return with an error message.
        Session::put('registration_data.pets', $request->input('pets'));

        return redirect()->route('pet_owner.register.confirm');
    }


    // Step 4: display confrim page
    public function showConfirm()
    {

        // Retrieve all registered data from the session.
        $registrationData = Session::get('registration_data');

        // If the required data is missing from the session, return to the first step.
        if (! $registrationData || !isset($registrationData['pet_owner']) || !isset($registrationData['pets'])) {
            return redirect()->route('pet_owner.register.saloncode');
        }

        // Pass the retrieved data to the view.
        return view('pet_owner.register.confirm', [
            'salonCode' => $registrationData['salon_code'],
            'petOwner' => $registrationData['pet_owner'],
            'pets' => $registrationData['pets'],
        ]);
    }

    // Step 4:  validate all data & store 
    public function postConfirm(Request $request)
    {
        // Check if the Terms of Service checkbox is checked.
        $request->validate([
            'terms_consent' => 'required|accepted',
        ]);

        // Retrieve all registered data from the session.
        $registrationData = Session::get('registration_data');

        // Check if the data exists in the session.
        if (! $registrationData || !isset($registrationData['pet_owner']) || !isset($registrationData['pets'])) {
            return redirect()->route('pet_owner.register.saloncode')->with('error', 'Registration data not found. Please start over.');
        }

        try {
            // Format the Pet Owner data to match the table.
            $petOwnerData = [
                'firstname' => $registrationData['pet_owner']['firstName'],
                'lastname' => $registrationData['pet_owner']['lastName'],
                'email_address' => $registrationData['pet_owner']['email'],
                'phone' => $registrationData['pet_owner']['phoneNumber'], // テーブルの列名に合わせる
                'city' => $registrationData['pet_owner']['city'],
                'prefecture' => $registrationData['pet_owner']['prefecture'],
                'password' => $registrationData['pet_owner']['password'],
            ];

            // 1. Save the Pet Owner to the database.
            $petOwner = PetOwner::create($petOwnerData);

            // 2. Save the Pet information to the database.
            foreach ($registrationData['pets'] as $petData) {
                // Format the Pet data to match the table.
                $petFormattedData = [
                    'pet_owner_id' => $petOwner->id,
                    'name' => $petData['pet_name'],
                    'breed' => $petData['breed'],
                    'age' => $petData['age'],
                    'weight' => $petData['weight'],
                    'gender' => $petData['gender'],
                    'notes' => $petData['special_notes'], // テーブルの列名に合わせる
                ];
                Pet::create($petFormattedData);
            }

            // 3. Save the Salon Code information to the database.
            $salonCode = new SalonCode();
            $salonCode->salon_code = $registrationData['salon_code'];
            $salonCode->petowner_id = $petOwner->id; // 外部キーにPetOwnerのIDをセット
            $salonCode->save();

            // 4. Clear the session data.
            Session::forget('registration_data');

            // 5. Redirect to the　complete page.
            return redirect()->route('pet_owner.register.complete');
        } catch (\Exception $e) {
            
            // If error 
            return back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    // Step 5:  display complete page
    public function showComplete()
    {
        return view('pet_owner.register.complete');
    }
}
