<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function selectSalon()
    {
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

    public function selectService(Request $request)
    {
        $services = [
            [
                'id' => 1,
                'name' => 'Full Grooming Package',
                'price' => 85,
                'duration' => '2h',
                'description' => 'Complete grooming service including bath, cut, nail trim, and ear cleaning',
                'includes' => [
                    'Shampoo & Conditioning',
                    'Hair Cut & Styling',
                    'Nail Trimming',
                    'Ear Cleaning',
                    'Teeth Brushing'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Basic Trim',
                'price' => 45,
                'duration' => '1h',
                'description' => 'Simple haircut and basic grooming maintenance',
                'includes' => [
                    'Hair Cut',
                    'Nail Trimming',
                    'Basic Brush Out'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Bath & Brush',
                'price' => 35,
                'duration' => '2h 30min',
                'description' => 'Refreshing bath with thorough brushing and drying',
                'includes' => [
                    'Shampoo & Conditioning',
                    'Thorough Brushing',
                    'Blow Dry'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Nail Trimming',
                'price' => 20,
                'duration' => '15-20 minutes',
                'description' => 'Quick and safe nail trimming service',
                'includes' => [
                    'Nail Trimming',
                    'Paw Inspection'
                ]
            ]
        ];

        return view('mypage.reservation.new.select-service', compact('services'));
    }

    public function selectPet(Request $request)
    {
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
                'size' => 'Medium (25-60 lbs)',
                'special_needs' => 'Gets anxious, needs gentle handling'
            ]
        ];

        return view('mypage.reservation.new.select-pet', compact('pets'));
    }

    public function selectSchedule(Request $request)
    {
        // Generate calendar days for current month
        $year = date('Y');
        $month = date('n');
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $firstDay);
        $startingDayOfWeek = date('w', $firstDay);
        
        // Adjust for Monday start (0 = Monday, 6 = Sunday)
        $startingDayOfWeek = ($startingDayOfWeek == 0) ? 6 : $startingDayOfWeek - 1;
        
        $calendar = [];
        $dayCounter = 1;
        
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

        // Available time slots
        $timeSlots = [
            '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
            '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM',
            '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM',
            '4:00 PM', '9:00 AM', '9:30 AM'
        ];

        $monthName = date('F', $firstDay);

        return view('mypage.reservation.new.select-schedule', compact('calendar', 'timeSlots', 'year', 'monthName'));
    }

    public function confirm(Request $request)
    {
        // For demo purposes, using static data
        // In a real app, you would fetch this from database based on IDs
        $bookingData = [
            'service' => [
                'name' => 'Basic Trim',
                'description' => 'Complete wash, cut, dry, and style service',
                'duration' => '1h',
                'price' => 45
            ],
            'appointment' => [
                'date' => 'Thursday, July 17, 2025',
                'time' => '11:00 AM'
            ]
        ];

        return view('mypage.reservation.new.confirm', compact('bookingData'));
    }

    public function complete(Request $request)
    {
        // Generate a confirmation number
        $confirmationNumber = 'TRM-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        
        // For demo purposes, using static data
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
}