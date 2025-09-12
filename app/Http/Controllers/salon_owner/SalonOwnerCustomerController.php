<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetOwner;
use App\Models\Salon;
use App\Models\SalonCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SalonOwnerCustomerController extends Controller
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
     * Display customers page
     */
    public function index(Request $request)
    {
        $salon = $this->getCurrentSalon($request);
        
        if (!$salon) {
            return redirect()->route('salonowner.login')
                ->with('error', 'Please login to access customers');
        }

        return view('salon_owner.dashboard.customers');
    }

    /**
     * Get all customers via API
     */
    public function getCustomers(Request $request)
    {
        try {
            $salon = $this->getCurrentSalon($request);

            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get search parameters
            $search = $request->get('search');

            // Get customers from salon_codes table
            $customersQuery = SalonCode::where('salon_code', $salon->salon_code)
                ->whereNull('deleted_at')
                ->with(['petOwner.pets']);

            // Apply search filters
            if ($search) {
                $customersQuery->whereHas('petOwner', function($query) use ($search) {
                    $query->where(function($q) use ($search) {
                        $q->where('firstname', 'like', "%{$search}%")
                          ->orWhere('lastname', 'like', "%{$search}%")
                          ->orWhere('email_address', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
                    });
                });
            }

            $salonCodes = $customersQuery->get();

            // Format customer data with statistics
            $customersWithStats = $salonCodes->map(function($salonCode) use ($salon) {
                $customer = $salonCode->petOwner;
                
                if (!$customer) {
                    return null;
                }

                // Default statistics
                $stats = [
                    'total_visits' => 0,
                    'total_spent' => 0,
                    'last_visit' => null,
                    'member_since' => $salonCode->created_at->format('F Y')
                ];

                // Check if appointments table exists
                if (Schema::hasTable('appointments')) {
                    try {
                        // Fixed query to work with correct table structure
                        $appointmentsQuery = DB::table('appointments')
                            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
                            ->where('appointments.salon_code', $salon->salon_code)
                            ->where('pets.pet_owner_id', $customer->id)
                            ->whereNull('appointments.deleted_at');

                        // Get total visits (status 3 = completed)
                        $stats['total_visits'] = (clone $appointmentsQuery)->where('appointments.status', 3)->count();
                        
                        // Get total spent (sum of service prices for completed appointments)
                        $totalSpentQuery = clone $appointmentsQuery;
                        $stats['total_spent'] = $totalSpentQuery
                            ->join('service_items', 'appointments.service_item_id', '=', 'service_items.id')
                            ->where('appointments.status', 3)
                            ->sum('service_items.price') ?? 0;
                        
                        // Get last visit date
                        $lastVisitQuery = clone $appointmentsQuery;
                        $lastVisit = $lastVisitQuery
                            ->where('appointments.status', 3)
                            ->orderBy('appointments.appointment_date', 'desc')
                            ->first();
                            
                        if ($lastVisit) {
                            $stats['last_visit'] = \Carbon\Carbon::parse($lastVisit->appointment_date)->format('Y/n/j');
                        }
                    } catch (\Exception $e) {
                        Log::error('Error fetching appointment stats: ' . $e->getMessage());
                        // Keep default stats
                    }
                }

                // Format pet information
                $pets = [];
                if ($customer->pets) {
                    foreach ($customer->pets as $pet) {
                        $pets[] = [
                            'id' => $pet->id,
                            'name' => $pet->name ?? 'Unknown',
                            'breed' => $pet->breed ?? 'Unknown',
                            'age' => $pet->age ?? 'Unknown',
                            'gender' => $pet->gender ?? 'Unknown',
                            'weight' => $pet->weight ?? 'Unknown',
                            'notes' => $pet->notes ?? ''
                        ];
                    }
                }

                // Format address
                $fullAddress = '';
                if ($customer->city || $customer->prefecture) {
                    $addressParts = [];
                    if ($customer->city) $addressParts[] = $customer->city;
                    if ($customer->prefecture) $addressParts[] = $customer->prefecture;
                    $fullAddress = implode(', ', $addressParts);
                }

                return [
                    'id' => $customer->id,
                    'firstname' => $customer->firstname,
                    'lastname' => $customer->lastname,
                    'full_name' => $customer->firstname . ' ' . $customer->lastname,
                    'email' => $customer->email_address,
                    'phone' => $customer->phone,
                    'address' => $fullAddress,
                    'city' => $customer->city ?? '',
                    'prefecture' => $customer->prefecture ?? '',
                    'pets' => $pets,
                    'stats' => $stats,
                    'salon_code_id' => $salonCode->id
                ];
            })->filter()->values();

            return response()->json([
                'success' => true,
                'data' => $customersWithStats
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch customers: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customers',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Delete customer (remove salon_code association)
     */
    public function destroy(Request $request, $id)
    {
        try {
            $salon = $this->getCurrentSalon($request);

            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Soft delete the salon_code association
            SalonCode::where('salon_code', $salon->salon_code)
                ->where('petowner_id', $id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer removed successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to remove customer: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove customer'
            ], 500);
        }
    }

    /**
     * Get customer details
     */
    public function show(Request $request, $id)
    {
        try {
            $salon = $this->getCurrentSalon($request);

            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get customer with pets
            $customer = PetOwner::with(['pets'])->find($id);

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            $appointments = [];
            
            // Get appointment history if table exists
            if (Schema::hasTable('appointments')) {
                $appointments = DB::table('appointments')
                    ->join('service_items', 'appointments.service_item_id', '=', 'service_items.id')
                    ->join('pets', 'appointments.pet_id', '=', 'pets.id')
                    ->where('appointments.salon_code', $salon->salon_code)
                    ->where('pets.pet_owner_id', $id)
                    ->whereNull('appointments.deleted_at')
                    ->select(
                        'appointments.*',
                        'service_items.servicename as service_name',
                        'service_items.price',
                        'pets.name as pet_name'
                    )
                    ->orderBy('appointments.appointment_date', 'desc')
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'customer' => $customer,
                    'appointments' => $appointments
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch customer details: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customer details'
            ], 500);
        }
    }
}