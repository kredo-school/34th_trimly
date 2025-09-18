<?php
// Juri - 2025-08-30 - Created CalendarController to fetch appointments from DB and display in calendar view

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\ServiceItem;
use App\Models\Pet;
use App\Models\User;
use App\Models\Salon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // Require salon owner session
        if (!$request->session()->has('salon_owner_id')) {
            return redirect()->route('salonowner.login');
        }

        // Get month and year from request or use current
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('n'));
        
        // Validate month and year
        $month = max(1, min(12, intval($month)));
        $year = max(2020, min(2030, intval($year)));
        
        // Use logged-in salon owner's salon_code from session
        $salonCode = $request->session()->get('salon_code');
        if (!$salonCode) {
            // Fallback: redirect to login if salon_code missing
            return redirect()->route('salonowner.login');
        }
        
        // Get first and last day of the month
        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        
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
        
        // Get appointments for this month
        $appointments = Appointment::where('salon_code', $salonCode)
            ->whereBetween('appointment_date', [$firstDay->toDateString(), $lastDay->toDateString()])
            ->with(['pet', 'pet.owner', 'serviceItem'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time_start')
            ->get();
        
        // Group appointments by date
        $appointmentsByDate = [];
        foreach ($appointments as $appointment) {
            $date = Carbon::parse($appointment->appointment_date)->format('Y-m-d');
            if (!isset($appointmentsByDate[$date])) {
                $appointmentsByDate[$date] = [];
            }
            $appointmentsByDate[$date][] = $appointment;
        }
        
        // Generate calendar
        $daysInMonth = $firstDay->daysInMonth;
        $firstDayOfWeek = $firstDay->dayOfWeek; // 0 = Sunday, 6 = Saturday
        
        // Create calendar array
        $calendar = [];
        $totalCells = ceil(($daysInMonth + $firstDayOfWeek) / 7) * 7;
        
        // Current month name
        $monthName = $firstDay->format('F');
        
        // Get selected date (default to today if in current month)
        $selectedDate = $request->input('date');
        if (!$selectedDate) {
            $today = Carbon::today();
            if ($today->month == $month && $today->year == $year) {
                $selectedDate = $today->format('Y-m-d');
            } else {
                // Select first day with appointments
                foreach ($appointmentsByDate as $date => $apps) {
                    $selectedDate = $date;
                    break;
                }
            }
        }
        
        // Get appointments for selected date
        $selectedAppointments = [];
        if ($selectedDate && isset($appointmentsByDate[$selectedDate])) {
            $selectedAppointments = $appointmentsByDate[$selectedDate];
        }
        
        // Format selected date for display
        $selectedDateFormatted = '';
        if ($selectedDate) {
            $selectedDateFormatted = Carbon::parse($selectedDate)->format('l, F j, Y');
        }
        
        return view('salon_owner.calendar', compact(
            'year',
            'month',
            'monthName',
            'daysInMonth',
            'firstDayOfWeek',
            'totalCells',
            'appointmentsByDate',
            'selectedDate',
            'selectedAppointments',
            'selectedDateFormatted'
        ));
    }
    
    public function cancelAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Update status to cancelled (2)
        $appointment->status = 2;
        $appointment->save();
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Appointment cancelled successfully');
    }
    
    public function updateAppointment(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'service_item_id' => 'required|exists:service_items,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time_start' => 'required',
            'status' => 'required|in:0,1,2,3',
        ]);
        
        $appointment = Appointment::findOrFail($id);
        
        // Get salon to check business hours and days
        $salon = Salon::with('openDays')->where('salon_code', $appointment->salon_code)->first();
        if (!$salon) {
            return redirect()->back()->with('error', 'Salon not found.');
        }
        
        // Check if selected date is an open day
        $selectedDate = Carbon::parse($request->input('appointment_date'));
        $dayName = $selectedDate->format('l'); // Get day name (e.g., 'Monday')
        $openDays = $salon->openDays->pluck('day_of_week')->toArray();
        
        // Convert both to lowercase for comparison
        $dayNameLower = strtolower($dayName);
        $openDaysLower = array_map('strtolower', $openDays);
        
        if (!empty($openDaysLower) && !in_array($dayNameLower, $openDaysLower)) {
            return redirect()->back()->with('error', 'The salon is closed on ' . $dayName . '. Please select a different date.');
        }
        
        // Check if selected time is within business hours
        $selectedTime = $request->input('appointment_time_start');
        $openTime = substr($salon->open_time ?? '09:00:00', 0, 5);
        $closeTime = substr($salon->close_time ?? '18:00:00', 0, 5);
        
        if ($selectedTime < $openTime || $selectedTime > $closeTime) {
            return redirect()->back()->with('error', 'Please select a time between ' . $openTime . ' and ' . $closeTime);
        }
        
        // Get service to calculate end time
        $service = ServiceItem::find($request->input('service_item_id'));
        if (!$service) {
            return redirect()->back()->with('error', 'Invalid service selected.');
        }
        
        // Calculate end time based on service duration
        $startTime = Carbon::parse($request->input('appointment_date') . ' ' . $request->input('appointment_time_start'));
        $endTime = $startTime->copy()->addMinutes($service->duration);
        
        // Update appointment
        $appointment->service_item_id = $request->input('service_item_id');
        $appointment->appointment_date = $request->input('appointment_date');
        $appointment->appointment_time_start = $startTime->format('H:i:s');
        $appointment->appointment_time_end = $endTime->format('H:i:s');
        $appointment->status = $request->input('status');
        
        // Update notes if provided
        if ($request->has('notes')) {
            $appointment->notes = $request->input('notes');
        }
        
        $appointment->save();
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Appointment updated successfully');
    }
    
    public function getServices(Request $request)
    {
        // Require salon owner session
        if (!$request->session()->has('salon_owner_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Get salon code from session
        $salonCode = $request->session()->get('salon_code');
        if (!$salonCode) {
            return response()->json(['error' => 'Salon code not found'], 404);
        }
        
        // Get all services for this salon
        $services = ServiceItem::where('salon_code', $salonCode)->get();
        
        // Get salon business hours and open days
        $salon = Salon::with('openDays')->where('salon_code', $salonCode)->first();
        
        $businessInfo = [
            'services' => $services,
            'open_time' => $salon->open_time ?? '09:00:00',
            'close_time' => $salon->close_time ?? '18:00:00',
            'open_days' => $salon->openDays->pluck('day_of_week')->toArray()
        ];
        
        return response()->json($businessInfo);
    }
}
