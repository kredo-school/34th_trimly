<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceItem;
use App\Models\Salon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalonOwnerServiceController extends Controller
{
    /**
     * Get current salon from session
     */
    private function getCurrentSalon(Request $request)
    {
        // Get salon code from session
        $salonCode = $request->session()->get('salon_code');
        
        if (!$salonCode) {
            return null;
        }
        
        // Find salon by salon code
        return Salon::where('salon_code', $salonCode)->first();
    }

    /**
     * Get salon owner's service list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get service list
            $services = ServiceItem::where('salon_code', $salon->salon_code)
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->get();

            // Format response data
            $formattedServices = $services->map(function ($service) {
                $features = $this->parseFeatures($service->servicefeatures);
                
                return [
                    'id' => $service->id,
                    'salon_code' => $service->salon_code,
                    'servicename' => $service->servicename,
                    'category' => $service->category,
                    'duration' => $service->duration,
                    'formatted_duration' => $this->formatDuration($service->duration),
                    'price' => $service->price,
                    'formatted_price' => number_format($service->price, 2),
                    'description' => $service->description,
                    'servicefeatures' => $service->servicefeatures,
                    'features' => $features,
                    'features_count' => count($features),
                    'created_at' => $service->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $service->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedServices
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch services: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch service list',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get service details
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, $id): JsonResponse
    {
        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $service = ServiceItem::where('salon_code', $salon->salon_code)
                ->where('id', $id)
                ->first();

            if (!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found'
                ], 404);
            }

            $features = $this->parseFeatures($service->servicefeatures);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $service->id,
                    'salon_code' => $service->salon_code,
                    'servicename' => $service->servicename,
                    'category' => $service->category,
                    'duration' => $service->duration,
                    'formatted_duration' => $this->formatDuration($service->duration),
                    'price' => $service->price,
                    'formatted_price' => number_format($service->price, 2),
                    'description' => $service->description,
                    'servicefeatures' => $service->servicefeatures,
                    'features' => $features,
                    'features_count' => count($features),
                    'created_at' => $service->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $service->updated_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch service details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Create a new service
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        Log::info('This is some useful information.');
        return redirect()->route('salonowner.dashboard.services.get');
        dd($request);
        $validated = $request->validate([
            'servicename' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'duration' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Process features (count selected features for integer field)
            $servicefeatures = 0;
            if ($request->has('features') && is_array($request->features)) {
                // Store count of selected features
                $servicefeatures = count($request->features);
            }

            $serviceData = array_merge($validated, [
                'salon_code' => $salon->salon_code,
                'servicefeatures' => $servicefeatures
            ]);

            $service = ServiceItem::create($serviceData);

            // Get feature details for response
            $features = [];
            if ($request->has('features') && is_array($request->features)) {
                $features = DB::table('servicefeatures_statuses')
                    ->whereIn('id', $request->features)
                    ->whereNull('deleted_at')
                    ->get()
                    ->map(function ($feature) {
                        return [
                            'id' => $feature->id,
                            'name' => $feature->display_name
                        ];
                    })
                    ->toArray();
            }

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => [
                    'id' => $service->id,
                    'salon_code' => $service->salon_code,
                    'servicename' => $service->servicename,
                    'category' => $service->category,
                    'duration' => $service->duration,
                    'formatted_duration' => $this->formatDuration($service->duration),
                    'price' => $service->price,
                    'formatted_price' => number_format($service->price, 2),
                    'description' => $service->description,
                    'servicefeatures' => $service->servicefeatures,
                    'features' => $features,
                    'features_count' => count($features),
                    'created_at' => $service->created_at->format('Y-m-d H:i:s'),
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Failed to create service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Update a service
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'servicename' => 'sometimes|string|max:100',
            'category' => 'sometimes|string|max:100',
            'duration' => 'sometimes|integer|min:15',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|string',
        ]);

        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $service = ServiceItem::where('salon_code', $salon->salon_code)
                ->where('id', $id)
                ->first();

            if (!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found'
                ], 404);
            }

            // Update features count if provided
            if ($request->has('features')) {
                if (is_array($request->features)) {
                    $validated['servicefeatures'] = count($request->features);
                }
            }

            $service->update($validated);

            // Get feature details for response
            $features = [];
            if ($request->has('features') && is_array($request->features)) {
                $features = DB::table('servicefeatures_statuses')
                    ->whereIn('id', $request->features)
                    ->whereNull('deleted_at')
                    ->get()
                    ->map(function ($feature) {
                        return [
                            'id' => $feature->id,
                            'name' => $feature->display_name
                        ];
                    })
                    ->toArray();
            } else {
                // Get existing features based on count
                $features = $this->parseFeatures($service->servicefeatures);
            }

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => [
                    'id' => $service->id,
                    'salon_code' => $service->salon_code,
                    'servicename' => $service->servicename,
                    'category' => $service->category,
                    'duration' => $service->duration,
                    'formatted_duration' => $this->formatDuration($service->duration),
                    'price' => $service->price,
                    'formatted_price' => number_format($service->price, 2),
                    'description' => $service->description,
                    'servicefeatures' => $service->servicefeatures,
                    'features' => $features,
                    'features_count' => count($features),
                    'updated_at' => $service->updated_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to update service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Delete a service (soft delete)
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $service = ServiceItem::where('salon_code', $salon->salon_code)
                ->where('id', $id)
                ->first();

            if (!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found'
                ], 404);
            }

            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to delete service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Display the services page with features list
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showServicesPage(Request $request)
    {
        // Development: Skip authentication temporarily
        if (!$request->session()->has('salon_owner_id')) {
            // Set test session data
            $request->session()->put('salon_owner_id', 2);
            $request->session()->put('salon_code', 'G2P674052');
            $request->session()->put('salon_name', 'TEST');
        }
        
        // Get all service features
        $serviceFeatures = DB::table('servicefeatures_statuses')
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->get();
        
        // Get salon info for display
        $salon = $this->getCurrentSalon($request);
        
        // Use dummy data if salon not found
        if (!$salon) {
            $salon = new \stdClass();
            $salon->id = 1;
            $salon->salon_code = 'G2P674052';
            $salon->salon_name = 'TEST';
        }
        
        return view('salon_owner.dashboard.services', [
            'serviceFeatures' => $serviceFeatures,
            'salon' => $salon
        ]);
    }

    /**
     * Get all service features
     *
     * @return JsonResponse
     */
    public function getFeatures(): JsonResponse
    {
        try {
            $features = DB::table('servicefeatures_statuses')
                ->whereNull('deleted_at')
                ->orderBy('id')
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $features
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch features: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch features',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Parse features from servicefeatures field
     * servicefeatures is treated as an integer representing the count of features
     *
     * @param mixed $features
     * @return array
     */
    private function parseFeatures($features): array
    {
        if (empty($features) || !is_numeric($features)) {
            return [];
        }

        // Get default features based on count
        $featureCount = intval($features);
        if ($featureCount <= 0) {
            return [];
        }

        $allFeatures = DB::table('servicefeatures_statuses')
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->limit($featureCount)
            ->get()
            ->map(function ($feature) {
                return [
                    'id' => $feature->id,
                    'name' => $feature->display_name
                ];
            })
            ->toArray();
        
        return $allFeatures;
    }

    /**
     * Format duration for display
     *
     * @param int $duration
     * @return string
     */
    private function formatDuration(int $duration): string
    {
        if ($duration >= 120) {
            $hours = floor($duration / 60);
            $minutes = $duration % 60;
            
            if ($minutes > 0) {
                return "{$hours} hours {$minutes} minutes";
            }
            return "{$hours} hours";
        } elseif ($duration >= 60) {
            $hours = floor($duration / 60);
            $minutes = $duration % 60;
            
            if ($minutes > 0) {
                return "{$hours} hour {$minutes} minutes";
            }
            return "{$hours} hour";
        }
        
        return "{$duration} minutes";
    }

    /**
     * Get service categories for the salon
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function categories(Request $request): JsonResponse
    {
        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $categories = ServiceItem::where('salon_code', $salon->salon_code)
                ->whereNull('deleted_at')
                ->distinct()
                ->pluck('category')
                ->filter()
                ->values();

            return response()->json([
                'success' => true,
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch categories: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Display the services page with features list
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    // public function showServicesPage(Request $request)
    // {
    //     // Check if logged in
    //     if (!$request->session()->has('salon_owner_id')) {
    //         return redirect()->route('salonowner.login');
    //     }
        
    //     // Get all service features
    //     $serviceFeatures = DB::table('servicefeatures_statuses')
    //         ->whereNull('deleted_at')
    //         ->orderBy('id')
    //         ->get();
        
    //     // Return view with features data
    //     return view('salon_owner.dashboard.services', compact('serviceFeatures'));
    // }

    /**
     * Get all service features
     *
     * @return JsonResponse
     */
    // public function getFeatures(): JsonResponse
    // {
    //     try {
    //         $features = DB::table('servicefeatures_statuses')
    //             ->whereNull('deleted_at')
    //             ->orderBy('id')
    //             ->get();
            
    //         return response()->json([
    //             'success' => true,
    //             'data' => $features
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to fetch features',
    //             'error' => config('app.debug') ? $e->getMessage() : null
    //         ], 500);
    //     }
    // }

    /**
     * Parse features from servicefeatures field
     *
     * @param mixed $features
     * @return array
     */
    // private function parseFeatures($features): array
    // {
    //     // If features is stored as comma-separated IDs
    //     if (is_string($features) && strpos($features, ',') !== false) {
    //         $featureIds = explode(',', $features);
    //         $featureData = DB::table('servicefeatures_statuses')
    //             ->whereIn('id', $featureIds)
    //             ->pluck('display_name')
    //             ->toArray();
    //         return $featureData;
    //     }
        
    //     // If features is stored as JSON
    //     if (is_string($features) && $this->isJson($features)) {
    //         $featureIds = json_decode($features, true);
    //         $featureData = DB::table('servicefeatures_statuses')
    //             ->whereIn('id', $featureIds)
    //             ->pluck('display_name')
    //             ->toArray();
    //         return $featureData;
    //     }
        
    //     // If features is a number representing feature count
    //     if (is_numeric($features)) {
    //         // Return default features based on count
    //         $allFeatures = DB::table('servicefeatures_statuses')
    //             ->whereNull('deleted_at')
    //             ->orderBy('id')
    //             ->limit($features)
    //             ->pluck('display_name')
    //             ->toArray();
            
    //         return $allFeatures;
    //     }
        
    //     return [];
    // }

    /**
     * Format duration for display
     *
     * @param int $duration
     * @return string
     */
    // private function formatDuration(int $duration): string
    // {
    //     if ($duration >= 60) {
    //         $hours = floor($duration / 60);
    //         $minutes = $duration % 60;
            
    //         if ($minutes > 0) {
    //             return "{$hours}h {$minutes} minutes";
    //         }
    //         return "{$hours}h";
    //     }
        
    //     return "{$duration} minutes";
    // }

    /**
     * Check if string is JSON
     *
     * @param string $string
     * @return bool
     */
    private function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
