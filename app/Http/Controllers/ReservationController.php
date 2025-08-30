<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Models\ServiceItem;
use App\Models\Pet;
use App\Models\SalonCode;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function selectSalon()
    {
        // Get current logged in pet owner
        $petOwner = Auth::guard('petowner')->user();
        
        // If not logged in, use demo data
        if (!$petOwner) {
            $salons = [
                [
                    'id' => 1,
                    'name' => 'Puppy Palace Downtown',
                    'code' => 'PPD2824',
                    'registered_date' => '10/01/2024'
                ],
                [
                    'id' => 2,
                    'name' => 'Furry Friends Salon',
                    'code' => 'FFS2823',
                    'registered_date' => '05/12/2023'
                ]
            ];
            return view('mypage.reservation.new.select-salon', compact('salons'));
        }
        
        // Get all salons registered by this pet owner through salon_codes
        $salonCodes = SalonCode::where('petowner_id', $petOwner->id)->get();
        
        $salons = [];
        foreach ($salonCodes as $salonCode) {
            $salon = Salon::where('salon_code', $salonCode->salon_code)->first();
            if ($salon) {
                $salons[] = [
                    'id' => $salon->id,
                    'name' => $salon->salonname,
                    'code' => $salon->salon_code,
                    'registered_date' => $salonCode->created_at->format('m/d/Y')
                ];
            }
        }

        return view('mypage.reservation.new.select-salon', compact('salons'));
    }

    public function selectService(Request $request)
    {
        $salonId = $request->input('salon_id');
        
        // Get salon code from salon
        $salon = Salon::find($salonId);
        if (!$salon) {
            return redirect()->route('mypage.reservation.new.select-salon')
                ->with('error', 'Please select a valid salon.');
        }
        
        // Get all services for this salon
        $serviceItems = ServiceItem::where('salon_code', $salon->salon_code)->get();
        
        $services = [];
        foreach ($serviceItems as $item) {
            // Format duration for display
            $hours = floor($item->duration / 60);
            $minutes = $item->duration % 60;
            $durationStr = '';
            if ($hours > 0) {
                $durationStr .= $hours . 'h';
            }
            if ($minutes > 0) {
                if ($hours > 0) $durationStr .= ' ';
                $durationStr .= $minutes . 'min';
            }
            
            // Parse description to get included features
            $includes = [];
            if (!empty($item->description)) {
                // Simple parsing - split by comma or newline
                $includes = array_map('trim', preg_split('/[,\n]/', $item->description));
                $includes = array_filter($includes); // Remove empty items
                $includes = array_slice($includes, 0, 5); // Limit to 5 items
            }
            
            $services[] = [
                'id' => $item->id,
                'name' => $item->servicename,
                'price' => $item->price,
                'duration' => $durationStr,
                'description' => $item->description,
                'includes' => $includes
            ];
        }

        return view('mypage.reservation.new.select-service', compact('services'));
    }

    public function selectPet(Request $request)
    {
        // Get current logged in pet owner
        $petOwner = Auth::guard('petowner')->user();
        
        // If not logged in, use demo data
        if (!$petOwner) {
            $pets = [
                [
                    'id' => 1,
                    'name' => 'Bella',
                    'breed' => 'Golden Retriever',
                    'age' => 'Adult (3-7 years)',
                    'size' => 'Large (60-100 lbs)',
                    'special_needs' => 'Sensitive skin, needs hypoallergenic shampoo'
                ],
                [
                    'id' => 2,
                    'name' => 'Max',
                    'breed' => 'French Bulldog',
                    'age' => 'Young (1-3 years)',
                    'size' => 'Medium (20-60 lbs)',
                    'special_needs' => 'None'
                ]
            ];
            return view('mypage.reservation.new.select-pet', compact('pets'));
        }
        
        // Get all pets belonging to this pet owner
        $userPets = Pet::where('pet_owner_id', $petOwner->id)->get();
        
        $pets = [];
        foreach ($userPets as $pet) {
            // Format age display
            $ageDisplay = '';
            if ($pet->age < 1) {
                $ageDisplay = 'Puppy (< 1 year)';
            } elseif ($pet->age >= 1 && $pet->age < 3) {
                $ageDisplay = 'Young (1-3 years)';
            } elseif ($pet->age >= 3 && $pet->age < 7) {
                $ageDisplay = 'Adult (3-7 years)';
            } else {
                $ageDisplay = 'Senior (7+ years)';
            }
            
            // Format weight/size display
            $sizeDisplay = '';
            if ($pet->weight < 20) {
                $sizeDisplay = 'Small (< 20 lbs)';
            } elseif ($pet->weight >= 20 && $pet->weight < 60) {
                $sizeDisplay = 'Medium (20-60 lbs)';
            } elseif ($pet->weight >= 60 && $pet->weight < 100) {
                $sizeDisplay = 'Large (60-100 lbs)';
            } else {
                $sizeDisplay = 'Extra Large (100+ lbs)';
            }
            
            $pets[] = [
                'id' => $pet->id,
                'name' => $pet->name,
                'breed' => $pet->breed ?? 'Mixed breed',
                'age' => $ageDisplay,
                'size' => $sizeDisplay,
                'special_needs' => $pet->notes ?? 'None'
            ];
        }

        return view('mypage.reservation.new.select-pet', compact('pets'));
    }

    public function selectSchedule(Request $request)
    {
        // Get month and year from request or use current
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('n'));
        
        // Validate month and year
        $month = max(1, min(12, intval($month)));
        $year = max(2020, min(2030, intval($year)));
        
        $salonId = $request->input('salon_id');
        $serviceId = $request->input('service_id');
        
        // Get salon for open hours
        $salon = Salon::find($salonId);
        if (!$salon) {
            return redirect()->route('mypage.reservation.new.select-salon')
                ->with('error', 'Please select a valid salon.');
        }
        
        // Generate calendar
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $firstDay);
        $startingDayOfWeek = date('w', $firstDay);
        
        // Adjust for Monday start (0 = Monday, 6 = Sunday)
        $startingDayOfWeek = ($startingDayOfWeek == 0) ? 6 : $startingDayOfWeek - 1;
        
        $calendar = [];
        
        // Add empty cells for days before month starts
        for ($i = 0; $i < $startingDayOfWeek; $i++) {
            $calendar[] = null;
        }
        
        // Add days of the month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $calendar[] = [
                'day' => $day,
                'dayOfWeek' => date('D', mktime(0, 0, 0, $month, $day, $year)),
                'isToday' => ($day == date('j') && $month == date('n') && $year == date('Y'))
            ];
        }

        // Generate time slots based on salon open hours
        $timeSlots = [];
        $openTime = strtotime($salon->open_time ?? '09:00:00');
        $closeTime = strtotime($salon->close_time ?? '18:00:00');
        
        // Generate 30-minute interval slots
        for ($time = $openTime; $time < $closeTime; $time += 1800) { // 1800 seconds = 30 minutes
            $timeSlots[] = date('g:i A', $time);
        }
        
        // If no slots generated, use default
        if (empty($timeSlots)) {
            $timeSlots = [
                '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
                '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM',
                '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM',
                '4:00 PM', '4:30 PM', '5:00 PM', '5:30 PM'
            ];
        }

        $monthName = date('F', $firstDay);
        
        // If AJAX request, return partial view
        if ($request->ajax()) {
            return response()->json([
                'calendar' => $calendar,
                'monthName' => $monthName,
                'year' => $year,
                'month' => $month
            ]);
        }

        return view('mypage.reservation.new.select-schedule', compact('calendar', 'timeSlots', 'year', 'monthName', 'month'));
    }

    public function confirm(Request $request)
    {
        $salonId = $request->input('salon_id');
        $serviceId = $request->input('service_id');
        $petId = $request->input('pet_id');
        $date = $request->input('date');
        $time = $request->input('time');
        
        // Fetch actual data from database
        $salon = Salon::find($salonId);
        $service = ServiceItem::find($serviceId);
        $pet = Pet::find($petId);
        
        if (!$salon || !$service || !$pet) {
            return redirect()->route('mypage.reservation.new.select-salon')
                ->with('error', 'Invalid selection. Please start over.');
        }
        
        // Format duration
        $hours = floor($service->duration / 60);
        $minutes = $service->duration % 60;
        $durationStr = '';
        if ($hours > 0) {
            $durationStr .= $hours . 'h';
        }
        if ($minutes > 0) {
            if ($hours > 0) $durationStr .= ' ';
            $durationStr .= $minutes . 'min';
        }
        
        // Format date
        $appointmentDate = Carbon::parse($date)->format('l, F j, Y');
        
        $bookingData = [
            'salon_id' => $salonId,
            'service_id' => $serviceId,
            'pet_id' => $petId,
            'date' => $date,
            'time' => $time,
            'service' => [
                'name' => $service->servicename,
                'description' => $service->description,
                'duration' => $durationStr,
                'price' => $service->price
            ],
            'appointment' => [
                'date' => $appointmentDate,
                'time' => $time
            ],
            'pet' => [
                'name' => $pet->name
            ],
            'salon' => [
                'name' => $salon->salonname
            ]
        ];

        return view('mypage.reservation.new.confirm', compact('bookingData'));
    }

    public function complete(Request $request)
    {
        $petOwner = Auth::guard('petowner')->user();
        
        // If not logged in, use demo data
        if (!$petOwner) {
            $confirmationNumber = 'TRM-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $bookingDetails = [
                'confirmation_number' => $confirmationNumber,
                'service' => [
                    'name' => 'Full Grooming',
                    'duration' => '2 hours',
                    'price' => 85.00
                ],
                'appointment' => [
                    'date' => 'January 25, 2025',
                    'time' => '10:00 AM'
                ],
                'pet' => [
                    'name' => 'Buddy',
                    'breed' => 'Golden Retriever',
                    'size' => 'Large'
                ],
                'salon' => [
                    'name' => 'Puppy Palace Downtown',
                    'address' => '123 Main St, Downtown',
                    'phone' => '(555) 123-4567'
                ],
                'user_email' => 'sarah@example.com'
            ];
            return view('mypage.reservation.new.complete', compact('bookingDetails'));
        }
        
        // Create appointment
        $appointment = new Appointment();
        $appointment->salon_id = $request->input('salon_id');
        $appointment->pet_id = $request->input('pet_id');
        $appointment->service_item_id = $request->input('service_id');
        $appointment->appointment_date = Carbon::parse($request->input('date') . ' ' . $request->input('time'));
        $appointment->status = 1; // Pending status
        $appointment->notes = '';
        $appointment->save();
        
        // Generate confirmation number
        $confirmationNumber = 'TRM-' . date('Y') . '-' . str_pad($appointment->id, 6, '0', STR_PAD_LEFT);
        
        // Get data for display
        $salon = Salon::find($request->input('salon_id'));
        $service = ServiceItem::find($request->input('service_id'));
        $pet = Pet::find($request->input('pet_id'));
        
        // Format duration
        $hours = floor($service->duration / 60);
        $minutes = $service->duration % 60;
        $durationStr = '';
        if ($hours > 0) {
            $durationStr .= $hours . ' hour' . ($hours > 1 ? 's' : '');
        }
        if ($minutes > 0) {
            if ($hours > 0) $durationStr .= ' ';
            $durationStr .= $minutes . ' minutes';
        }
        
        $bookingDetails = [
            'confirmation_number' => $confirmationNumber,
            'service' => [
                'name' => $service->servicename,
                'duration' => $durationStr,
                'price' => $service->price
            ],
            'appointment' => [
                'date' => Carbon::parse($request->input('date'))->format('F j, Y'),
                'time' => $request->input('time')
            ],
            'pet' => [
                'name' => $pet->name,
                'breed' => $pet->breed ?? 'Mixed breed',
                'size' => $this->getPetSize($pet->weight)
            ],
            'salon' => [
                'name' => $salon->salonname,
                'address' => $salon->state ?? 'Address not available',
                'phone' => $salon->phone ?? '(555) 000-0000'
            ],
            'user_email' => $petOwner->email_address
        ];

        return view('mypage.reservation.new.complete', compact('bookingDetails'));
    }
    
    private function getPetSize($weight)
    {
        if ($weight < 20) {
            return 'Small';
        } elseif ($weight < 60) {
            return 'Medium';
        } elseif ($weight < 100) {
            return 'Large';
        } else {
            return 'Extra Large';
        }
    }
}