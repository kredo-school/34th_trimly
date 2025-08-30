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
        // Get month and year from request or use current
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('n'));
        
        // Validate month and year
        $month = max(1, min(12, intval($month)));
        $year = max(2020, min(2030, intval($year)));
        
        // For now, using hardcoded salon_code. In production, get from authenticated salon owner
        $salonCode = 'TEST_SALON_001';
        
        // Get first and last day of the month
        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        
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
}