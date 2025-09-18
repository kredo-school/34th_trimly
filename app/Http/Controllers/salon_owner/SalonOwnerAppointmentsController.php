<?php

namespace App\Http\Controllers\salon_owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\ServiceItem;
use Carbon\Carbon;

class SalonOwnerAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        // Check salon owner session
        if (!$request->session()->has('salon_owner_id')) {
            return redirect()->route('salonowner.login');
        }

        $salonCode = $request->session()->get('salon_code');
        if (!$salonCode) {
            return redirect()->route('salonowner.login');
        }

        // Auto-complete past appointments for this salon
        $today = Carbon::today()->toDateString();
        $nowTime = Carbon::now()->format('H:i:s');
        
        Appointment::where('salon_code', $salonCode)
            ->whereNotIn('status', [2, 3]) // exclude cancelled(2) and completed(3)
            ->where(function($q) use ($today, $nowTime) {
                $q->whereDate('appointment_date', '<', $today)
                  ->orWhere(function($q) use ($today, $nowTime) {
                      $q->whereDate('appointment_date', $today)
                        ->where('appointment_time_end', '<=', $nowTime);
                  });
            })
            ->update(['status' => 3]);

        // Get filter parameters
        $status = $request->input('status', '');
        $search = $request->input('search', '');
        $date = $request->input('date', Carbon::today()->toDateString());

        // Base query
        $query = Appointment::where('salon_code', $salonCode)
            ->whereDate('appointment_date', $date)
            ->with(['pet.owner', 'serviceItem']);

        // Apply status filter
        if ($status !== '') {
            switch ($status) {
                case 'confirmed':
                    $query->where('status', 1);
                    break;
                case 'cancelled':
                    $query->where('status', 2);
                    break;
                case 'completed':
                    $query->where('status', 3);
                    break;
            }
        }

        // Apply search filter
        if ($search !== '') {
            $query->where(function($q) use ($search) {
                $q->whereHas('pet.owner', function($q) use ($search) {
                    // Search by firstname or lastname
                    $q->where('firstname', 'like', '%' . $search . '%')
                      ->orWhere('lastname', 'like', '%' . $search . '%');
                })
                ->orWhereHas('pet', function($q) use ($search) {
                    // Search by pet name
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('serviceItem', function($q) use ($search) {
                    // Search by service name
                    $q->where('servicename', 'like', '%' . $search . '%');
                });
            });
        }

        // Order by appointment time
        $appointments = $query->orderBy('appointment_time_start')->get();

        // Format display date
        $carbonDate = Carbon::parse($date);
        $today = Carbon::today();

        if ($carbonDate->isSameDay($today)) {
            $displayDate = "Today's Appointments";
        } else {
            $displayDate = $carbonDate->format('l, F j, Y');
        }

        // Get all pets that have appointments at this salon (for edit modal)
        $pets = Pet::whereHas('appointments', function($q) use ($salonCode) {
            $q->where('salon_code', $salonCode);
        })->with('owner')->orderBy('name')->get();

        // Get all services for this salon (for edit modal)
        $services = ServiceItem::where('salon_code', $salonCode)
            ->orderBy('servicename')
            ->get();

        return view('salon_owner.dashboard.appointments', 
            compact('appointments', 'displayDate', 'status', 'search', 'date', 'pets', 'services'));
    }

    public function cancel(Request $request, $id)
    {
        if (!$request->session()->has('salon_owner_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $salonCode = $request->session()->get('salon_code');
        
        $appointment = Appointment::where('salon_code', $salonCode)
            ->where('id', $id)
            ->firstOrFail();
        
        // Update status to cancelled (2)
        $appointment->status = 2;
        $appointment->save();
        
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        // Check salon owner session
        if (!$request->session()->has('salon_owner_id')) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return redirect()->route('salonowner.login');
        }

        $salonCode = $request->session()->get('salon_code');
        
        // Find the appointment
        $appointment = Appointment::where('salon_code', $salonCode)
            ->where('id', $id)
            ->firstOrFail();
        
        // Validate the request
        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time_start' => 'required|date_format:H:i',
            'status' => 'required|in:1,2,3',
            'pet_id' => 'required|exists:pets,id',
            'service_item_id' => 'required|exists:service_items,id'
        ]);
        
        // Get service duration to calculate end time
        $service = ServiceItem::find($validated['service_item_id']);
        $duration = $service->duration ?? 30; // Default 30 minutes if no duration specified
        
        // Calculate end time based on start time and service duration
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['appointment_date'] . ' ' . $validated['appointment_time_start']);
        $endTime = $startTime->copy()->addMinutes($duration);
        
        // Add end time to validated data
        $validated['appointment_time_end'] = $endTime->format('H:i:s');
        $validated['appointment_time_start'] = $startTime->format('H:i:s');
        
        // Update the appointment
        $appointment->update($validated);
        
        // Return JSON response for AJAX requests
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully'
            ]);
        }
        
        // Otherwise redirect
        return redirect()->route('salon_owner.appointments')
            ->with('success', 'Appointment updated successfully');
    }
}