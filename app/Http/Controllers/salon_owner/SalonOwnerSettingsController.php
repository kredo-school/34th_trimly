<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SalonOwnerSettingsController extends Controller
{
    /**
     * Get current salon from session
     */
    private function getCurrentSalon(Request $request)
    {
        $salonCode = $request->session()->get('salon_code');
        
        if (!$salonCode) {
            return null;
        }
        
        return Salon::where('salon_code', $salonCode)->first();
    }

    /**
     * Display settings page
     */
    public function showSettingsPage(Request $request)
    {
        // ========================================
        // TODO: REMOVE BEFORE PRODUCTION!
        // Development mode: Skip authentication temporarily
        // ========================================
        if (!$request->session()->has('salon_owner_id')) {
            // Development: Set default test data
            $request->session()->put('salon_owner_id', 2);
            $request->session()->put('salon_code', 'G2P674052');
            $request->session()->put('salon_name', 'TEST');
            
            Log::warning('Development mode: Using default test salon data. Remove before production!');
        }
        // ========================================

        $salon = $this->getCurrentSalon($request);

        // Production: Implement proper authentication check here
        if (!$salon) {
            // TODO: In production, redirect to proper login page
            // return redirect()->route('salonowner.login')
            //     ->with('error', 'Please login to access settings');
            
            // Development: Show error message
            abort(404, 'Salon not found. Check session data.');
        }

        // Get open days
        $openDays = DB::table('salon_open_days')
            ->where('salon_id', $salon->id)
            ->whereNull('deleted_at')
            ->pluck('day_of_week')
            ->toArray();

        return view('salon_owner.dashboard.settings', [
            'salon' => $salon,
            'openDays' => $openDays
        ]);
    }

    /**
     * Get all settings data via API
     */
    public function index(Request $request)
    {
        try {
            $salon = $this->getCurrentSalon($request);

            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get open days
            $openDays = DB::table('salon_open_days')
                ->where('salon_id', $salon->id)
                ->whereNull('deleted_at')
                ->pluck('day_of_week')
                ->toArray();

            return response()->json([
                'success' => true,
                'data' => [
                    'salon' => [
                        'id' => $salon->id,
                        'salon_code' => $salon->salon_code,
                        'salonname' => $salon->salonname,
                        'firstname' => $salon->firstname,
                        'lastname' => $salon->lastname,
                        'email_address' => $salon->email_address,
                        'phone' => $salon->phone,
                        'business_address' => $salon->business_address,
                        'city' => $salon->city,
                        'state' => $salon->state,
                        'website' => $salon->website,
                        'licencenum' => $salon->licencenum,
                        'description' => $salon->description,
                        'open_time' => $salon->open_time,
                        'close_time' => $salon->close_time,
                    ],
                    'open_days' => $openDays
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch settings: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch settings',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Update all settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Basic Information
            'salonname' => 'required|string|max:100',
            'email_address' => 'required|email|max:100',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            
            // Address
            'business_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            
            // Optional
            'website' => 'nullable|string|max:255',
            'licencenum' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            
            // Business Hours
            'operating_days' => 'nullable|array',
            'operating_days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            
            // Password (optional)
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        
        try {
            $salon = $this->getCurrentSalon($request);

            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Update salon information
            $salonData = [
                'salonname' => $validated['salonname'],
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'email_address' => $validated['email_address'],
                'phone' => $validated['phone'],
                'business_address' => $validated['business_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'website' => $validated['website'] ?? null,
                'licencenum' => $validated['licencenum'] ?? null,
                'description' => $validated['description'] ?? null,
                'open_time' => $validated['open_time'] ?? '09:00',
                'close_time' => $validated['close_time'] ?? '18:00',
            ];

            // Update password if provided
            if (!empty($validated['password'])) {
                $salonData['password'] = Hash::make($validated['password']);
            }

            $salon->update($salonData);

            // Update open days
            if (isset($validated['operating_days'])) {
                // Soft delete existing open days
                DB::table('salon_open_days')
                    ->where('salon_id', $salon->id)
                    ->update(['deleted_at' => now()]);

                // Insert new open days
                foreach ($validated['operating_days'] as $day) {
                    DB::table('salon_open_days')->insert([
                        'salon_id' => $salon->id,
                        'day_of_week' => $day,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            // Update session if salon name changed
            if ($salon->salonname !== $request->session()->get('salon_name')) {
                $request->session()->put('salon_name', $salon->salonname);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to update settings: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update settings',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}