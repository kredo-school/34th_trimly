<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceItem;
use App\Models\Salon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SalonOwnerServiceController extends Controller
{
    /**
     * Get current salon from session
     */
    private function getCurrentSalon(Request $request)
    {
        $salonOwnerId = $request->session()->get('salon_owner_id');
        
        if (!$salonOwnerId) {
            return null;
        }
        
        return Salon::find($salonOwnerId);
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

            // Get service list with pagination
            $services = ServiceItem::where('salon_code', $salon->salon_code)
                ->when($request->search, function ($query, $search) {
                    return $query->search($search);
                })
                ->when($request->category, function ($query, $category) {
                    return $query->byCategory($category);
                })
                ->orderBy($request->sort_by ?? 'created_at', $request->sort_order ?? 'desc')
                ->paginate($request->per_page ?? 10);

            // Format response data
            $services->getCollection()->transform(function ($service) {
                // Parse features (assuming comma-separated or JSON)
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
                'data' => $services
            ], 200);

        } catch (\Exception $e) {
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
                    'created_at' => $service->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $service->updated_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Exception $e) {
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
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'servicename' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'duration' => 'required|integer|min:15',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'servicefeatures' => 'required|string'  // Changed to string for comma-separated values
        ]);

        try {
            $salon = $this->getCurrentSalon($request);
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $serviceData = array_merge($validated, [
                'salon_code' => $salon->salon_code
            ]);

            $service = ServiceItem::create($serviceData);

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
                    'created_at' => $service->created_at->format('Y-m-d H:i:s'),
                ]
            ], 201);

        } catch (\Exception $e) {
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
            'servicefeatures' => 'sometimes|string'  // Changed to string
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

            $service->update($validated);

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
                    'updated_at' => $service->updated_at->format('Y-m-d H:i:s'),
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Delete a service
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
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete service',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
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
                ->distinct()
                ->pluck('category')
                ->filter()
                ->values();

            return response()->json([
                'success' => true,
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
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
    public function showServicesPage(Request $request)
    {
        // Check if logged in
        if (!$request->session()->has('salon_owner_id')) {
            return redirect()->route('salonowner.login');
        }
        
        // Get all service features
        $serviceFeatures = DB::table('servicefeatures_statuses')
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->get();
        
        // Return view with features data
        return view('salon_owner.dashboard.services', compact('serviceFeatures'));
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
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch features',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Parse features from servicefeatures field
     *
     * @param mixed $features
     * @return array
     */
    private function parseFeatures($features): array
    {
        // If features is stored as comma-separated IDs
        if (is_string($features) && strpos($features, ',') !== false) {
            $featureIds = explode(',', $features);
            $featureData = DB::table('servicefeatures_statuses')
                ->whereIn('id', $featureIds)
                ->pluck('display_name')
                ->toArray();
            return $featureData;
        }
        
        // If features is stored as JSON
        if (is_string($features) && $this->isJson($features)) {
            $featureIds = json_decode($features, true);
            $featureData = DB::table('servicefeatures_statuses')
                ->whereIn('id', $featureIds)
                ->pluck('display_name')
                ->toArray();
            return $featureData;
        }
        
        // If features is a number representing feature count
        if (is_numeric($features)) {
            // Return default features based on count
            $allFeatures = DB::table('servicefeatures_statuses')
                ->whereNull('deleted_at')
                ->orderBy('id')
                ->limit($features)
                ->pluck('display_name')
                ->toArray();
            
            return $allFeatures;
        }
        
        return [];
    }

    /**
     * Format duration for display
     *
     * @param int $duration
     * @return string
     */
    private function formatDuration(int $duration): string
    {
        if ($duration >= 60) {
            $hours = floor($duration / 60);
            $minutes = $duration % 60;
            
            if ($minutes > 0) {
                return "{$hours}h {$minutes} minutes";
            }
            return "{$hours}h";
        }
        
        return "{$duration} minutes";
    }

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
