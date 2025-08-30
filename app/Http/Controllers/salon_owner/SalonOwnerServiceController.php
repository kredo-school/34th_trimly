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
     * Get salon owner's service list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Get authenticated salon owner
            $salonOwner = Auth::guard('salon-owner')->user();
            
            if (!$salonOwner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Get salon owned by the salon owner
            $salon = Salon::where('owner_id', $salonOwner->id)->first();
            
            if (!$salon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Salon not found'
                ], 404);
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
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $salonOwner = Auth::guard('salon-owner')->user();
            $salon = Salon::where('owner_id', $salonOwner->id)->first();

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
                    'formatted_duration' => $service->formatted_duration,
                    'price' => $service->price,
                    'formatted_price' => $service->formatted_price,
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
            'servicefeatures' => 'required|integer|min:0'
        ]);

        try {
            $salonOwner = Auth::guard('salon-owner')->user();
            $salon = Salon::where('owner_id', $salonOwner->id)->first();

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
                    'formatted_duration' => $service->formatted_duration,
                    'price' => $service->price,
                    'formatted_price' => $service->formatted_price,
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
            'servicefeatures' => 'sometimes|integer|min:0'
        ]);

        try {
            $salonOwner = Auth::guard('salon-owner')->user();
            $salon = Salon::where('owner_id', $salonOwner->id)->first();

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
                    'formatted_duration' => $service->formatted_duration,
                    'price' => $service->price,
                    'formatted_price' => $service->formatted_price,
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
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $salonOwner = Auth::guard('salon-owner')->user();
            $salon = Salon::where('owner_id', $salonOwner->id)->first();

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
     * @return JsonResponse
     */
    public function categories(): JsonResponse
    {
        try {
            $salonOwner = Auth::guard('salon-owner')->user();
            $salon = Salon::where('owner_id', $salonOwner->id)->first();

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
     * Parse features from servicefeatures field
     *
     * @param mixed $features
     * @return array
     */
    private function parseFeatures($features): array
    {
        // If features is stored as JSON
        if (is_string($features) && $this->isJson($features)) {
            return json_decode($features, true);
        }
        
        // If features is a number representing feature count
        if (is_numeric($features)) {
            // Return default features based on count
            $allFeatures = [
                'Bath & Shampoo',
                'Nail Trim',
                'Ear Cleaning',
                'Hair Cut & Styling',
                'Brushing & De-matting',
                'Professional Drying',
                'Perfuming & Deodorizing',
                'Paw Pad Trim',
                'Sanitary Trim',
                'Coat Conditioning',
                'De-shedding Treatment',
                'Flea & Tick Treatment',
                'Teeth Cleaning',
                'Aromatherapy'
            ];
            
            return array_slice($allFeatures, 0, $features);
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