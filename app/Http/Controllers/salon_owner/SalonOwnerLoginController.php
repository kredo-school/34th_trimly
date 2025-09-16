<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Salon;
use Illuminate\Http\JsonResponse;

class SalonOwnerLoginController extends Controller
{
    /**
     * Handle salon owner login
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // Validate request
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        try {
            // Find salon by email
            $salon = Salon::where('email_address', $validated['email'])->first();

            // Check if salon exists and password is correct
            if (!$salon || !Hash::check($validated['password'], $salon->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Create session for salon owner
            // Since we don't have auth guard configured, we'll use session
            $request->session()->put('salon_owner_id', $salon->id);
            $request->session()->put('salon_code', $salon->salon_code);
            $request->session()->put('salon_name', $salon->salonname);
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'id' => $salon->id,
                    'salon_code' => $salon->salon_code,
                    'salonname' => $salon->salonname,
                    'firstname' => $salon->firstname,
                    'lastname' => $salon->lastname,
                    'email' => $salon->email_address
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle salon owner logout
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Clear salon owner session
            $request->session()->forget(['salon_owner_id', 'salon_code']);
            $request->session()->flush();
    
            
            return redirect()->route('salonowner.login');
    
        } catch (\Exception $e) {
            return redirect()->route('salonowner.login');
        }
    }

    /**
     * Get current salon owner profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        try {
            // Check if salon owner is logged in
            $salonOwnerId = $request->session()->get('salon_owner_id');
            
            if (!$salonOwnerId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get salon data
            $salon = Salon::find($salonOwnerId);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Salon not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $salon->id,
                    'salon_code' => $salon->salon_code,
                    'salonname' => $salon->salonname,
                    'firstname' => $salon->firstname,
                    'lastname' => $salon->lastname,
                    'email' => $salon->email_address,
                    'phone' => $salon->phone,
                    'state' => $salon->state,
                    'website' => $salon->website,
                    'description' => $salon->description
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if salon owner is authenticated
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function check(Request $request): JsonResponse
    {
        $isAuthenticated = $request->session()->has('salon_owner_id');

        return response()->json([
            'success' => true,
            'authenticated' => $isAuthenticated
        ], 200);
    }
}
/**
 * Get navigation data for authenticated salon owner
 *
 * @param Request $request
 * @return array
 */
