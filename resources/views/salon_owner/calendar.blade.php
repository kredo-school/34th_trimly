@extends('layouts.navigation')

@section('title', 'Calendar')

@push('styles')
      
    
    <style>
        /* Page-scoped overrides: keep changes local to this view */
        body.body-layout {
            background-color: #FEFCF1 !important; /* override nav CSS forcing white */
            background: #FEFCF1 !important;
        }
        .main-content {
            background-color: transparent !important; /* allow page background to show */
            background: transparent !important;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .calendar-wrapper {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background-color: white;
        }

        .calendar-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #999;
            cursor: pointer;
            padding: 5px 10px;
        }

        .nav-btn:hover {
            color: #333;
        }

        .current-month {
            font-size: 15px;
            font-weight: 500;
            color: #333;
            min-width: 100px;
            text-align: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #E8E8E8;
            border: 1px solid #E8E8E8;
        }

        .day-header {
            background-color: #FAFAFA;
            padding: 12px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            color: #666;
        }

        .calendar-day {
            background-color: white;
            min-height: 100px;
            padding: 8px;
            position: relative;
        }

        .calendar-day.empty {
            background-color: #FAFAFA;
        }

        .day-number {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .day-number.active {
            color: #4A90E2;
            font-weight: 600;
        }

        .appointment {
            background-color: #C8B8A1;
            color: white;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 11px;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }

        .appointment:hover {
            background-color: #B5A58E;
        }

        .appointment.more {
            background-color: #E3F2FD;
            color: #4A90E2;
        }

        .schedule-wrapper {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: visible;
        }

        .schedule-header {
            font-size: 17px;
            font-weight: 600;
            color: #333;
            padding: 25px 30px;
            border-bottom: 1px solid #E8E8E8;
        }

        .appointment-list {
            padding: 0;
        }

        .appointment-card {
            display: flex;
            align-items: center;
            padding: 20px 30px;
            background-color: white;
            border-bottom: 1px solid #F0F0F0;
            transition: background-color 0.2s;
            cursor: pointer;
            overflow: visible;
        }

        .appointment-card:hover {
            background-color: #FAFAFA;
        }

        .appointment-card:last-child {
            border-bottom: none;
        }

        .appointment-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: #D4C5B9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .appointment-details {
            flex: 1;
        }

        .client-info {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 4px;
        }

        .client-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .service-type {
            font-size: 13px;
            color: #666;
        }

        .appointment-meta {
            font-size: 12px;
            color: #999;
        }

        .appointment-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            margin-right: 10px;
        }

        .status-confirmed {
            background-color: #C8B8A1;
            color: white;
        }

        .status-cancelled {
            background-color: #FF6B6B;
            color: white;
        }
        .status-completed {
            background-color: #e6f8ee; /* light green */
            color: #2e7d32;
        }
        .status-pending {
            background-color: #fff3cd; /* light amber */
            color: #856404;
        }

        .action-btn {
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            position: relative;
        }

        .action-btn:hover {
            color: #666;
        }

        .action-menu {
            position: absolute;
            top: 35px;
            right: -10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
            min-width: 250px;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
        }

        .action-menu.show {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Drop-up style for menus near bottom */
        .action-menu.drop-up {
            top: auto;
            bottom: 35px;
            transform: translateY(10px);
        }
        
        .action-menu.drop-up.show {
            transform: translateY(0);
        }

        .action-menu-item {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: #555;
            text-decoration: none;
            transition: background-color 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 15px;
            font-weight: 500;
        }

        .action-menu-item:hover {
            background-color: #f8f8f8;
        }

        .action-menu-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
            color: #999;
        }

        .action-menu-item.cancel {
            color: #ef9a9a;
        }
        
        .action-menu-item.cancel i {
            color: #ef9a9a;
        }

        .appointment-actions {
            position: relative;
            z-index: 10;
        }
        
        .appointment-card {
            position: relative;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
            }

            .calendar-wrapper,
            .schedule-wrapper {
                border-radius: 8px;
                padding: 20px;
            }

            .calendar-day {
                min-height: 70px;
                padding: 5px;
            }

            .appointment {
                font-size: 10px;
                padding: 2px 4px;
            }

            .appointment-card {
                padding: 15px 20px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container">
        @if(session('success'))
            <div style="background-color: #4CAF50; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background-color: #f44336; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif
        <div class="calendar-wrapper">
            <div class="calendar-header">
                <h2 class="calendar-title">Calendar View</h2>
                <div class="calendar-nav">
                    <button class="nav-btn" onclick="previousMonth()">‹</button>
                    <span class="current-month" id="currentMonth">{{ $monthName }} {{ $year }}</span>
                    <button class="nav-btn" onclick="nextMonth()">›</button>
                </div>
            </div>

            <div class="calendar-grid">
                <div class="day-header">Sun</div>
                <div class="day-header">Mon</div>
                <div class="day-header">Tue</div>
                <div class="day-header">Wed</div>
                <div class="day-header">Thu</div>
                <div class="day-header">Fri</div>
                <div class="day-header">Sat</div>

                @php
                    $dayCounter = 1;
                @endphp

                @for ($i = 0; $i < $totalCells; $i++)
                    @if ($i < $firstDayOfWeek)
                        <div class="calendar-day empty"></div>
                    @elseif ($dayCounter <= $daysInMonth)
                        @php
                            $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $dayCounter);
                            $isToday = $currentDate == date('Y-m-d');
                            $isSelected = $currentDate == $selectedDate;
                            $hasAppointments = isset($appointmentsByDate[$currentDate]);
                        @endphp
                        <div class="calendar-day" onclick="selectDate('{{ $currentDate }}')">
                            <div class="day-number {{ $isToday ? 'active' : '' }} {{ $isSelected ? 'selected' : '' }}">{{ $dayCounter }}</div>
                            
                            @if ($hasAppointments)
                                @php
                                    $dayAppointments = $appointmentsByDate[$currentDate];
                                    $displayCount = min(2, count($dayAppointments));
                                @endphp
                                @for ($j = 0; $j < $displayCount; $j++)
                                    @php
                                        $appointment = $dayAppointments[$j];
                                        $time = Carbon\Carbon::parse($appointment->appointment_time_start)->format('h:i A');
                                        $petOwner = $appointment->pet->owner ?? null;
                                        $ownerName = $petOwner ? substr($petOwner->firstname, 0, 1) . '. ' . substr($petOwner->lastname, 0, 1) . '.' : 'Unknown';
                                    @endphp
                                    <div class="appointment">{{ $time }} {{ $ownerName }}</div>
                                @endfor
                                @if (count($dayAppointments) > 2)
                                    <div class="appointment more">{{ count($dayAppointments) - 2 }} more...</div>
                                @endif
                            @endif
                        </div>
                        @php $dayCounter++; @endphp
                    @else
                        <div class="calendar-day empty"></div>
                    @endif
                @endfor
            </div>
        </div>

        <div class="schedule-wrapper">
            <h3 class="schedule-header">Schedule for {{ $selectedDateFormatted ?: 'Select a date' }}</h3>
            
            <div class="appointment-list">
                @forelse ($selectedAppointments as $index => $appointment)
                    @php
                        $petOwner = $appointment->pet->owner ?? null;
                        $ownerFullName = $petOwner ? $petOwner->firstname . ' ' . $petOwner->lastname : 'Unknown';
                        $ownerInitial = $petOwner ? strtoupper(substr($petOwner->firstname, 0, 1)) : '?';
                        $serviceName = $appointment->serviceItem->servicename ?? 'Service';
                        $petName = $appointment->pet->name ?? 'Pet';
                        $petBreed = $appointment->pet->breed ?? 'Unknown breed';
                        $appointmentTime = Carbon\Carbon::parse($appointment->appointment_time_start)->format('h:i A');
                        $statusClass = $appointment->status == 1
                            ? 'status-confirmed'
                            : ($appointment->status == 2
                                ? 'status-cancelled'
                                : ($appointment->status == 3 ? 'status-completed' : 'status-pending'));
                        $statusText = $appointment->status == 1
                            ? 'confirmed'
                            : ($appointment->status == 2
                                ? 'cancelled'
                                : ($appointment->status == 3 ? 'completed' : 'pending'));
                    @endphp
                    <div class="appointment-card">
                        <div class="appointment-avatar">{{ $ownerInitial }}</div>
                        <div class="appointment-details">
                            <div class="client-info">
                                <span class="client-name">{{ $ownerFullName }}</span>
                                {{-- <span class="service-type">{{ $serviceName }} • {{ $petName }}</span> --}}
                            </div>
                            <div class="service-type">{{ $serviceName }} • {{ $petName }}</div>
                            <div class="appointment-meta">{{ $appointmentTime }} • {{ $petBreed }}</div>
                        </div>
                        <span class="appointment-status {{ $statusClass }}">{{ $statusText }}</span>
                        <div class="appointment-actions">
                            <button type="button" class="action-btn" onclick="toggleActionMenu(event, 'menu{{ $appointment->id }}')">⋯</button>
                            <div class="action-menu" id="menu{{ $appointment->id }}">
                                <button class="action-menu-item">
                                    <i class="fas fa-edit"></i>
                                    Edit Appointment
                                </button>
                                @if($appointment->status != 2)
                                <form action="{{ route('salon-owner.appointments.cancel', $appointment->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="action-menu-item cancel" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        <i class="fas fa-trash"></i>
                                        Cancel Appointment
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding: 40px; text-align: center; color: #999;">
                        <p>No appointments scheduled for this date.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentMonth = {{ $month }};
        let currentYear = {{ $year }};

        function previousMonth() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            window.location.href = `/salon-owner/calendar?month=${currentMonth}&year=${currentYear}`;
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            window.location.href = `/salon-owner/calendar?month=${currentMonth}&year=${currentYear}`;
        }

        function selectDate(date) {
            window.location.href = `/salon-owner/calendar?month=${currentMonth}&year=${currentYear}&date=${date}`;
        }

        // Use a unique name to avoid clashing with global toggleMenu() in dashboard.js
        function toggleActionMenu(event, menuId) {
            event.stopPropagation();
            event.preventDefault();
            
            console.log('Toggle menu called for:', menuId);
            
            // Close all other menus first
            document.querySelectorAll('.action-menu').forEach(menu => {
                if (menu.id !== menuId) {
                    menu.classList.remove('show', 'drop-up');
                    menu.style.visibility = 'hidden';
                    menu.style.opacity = '0';
                }
            });
            
            // Toggle current menu
            const menu = document.getElementById(menuId);
            if (menu) {
                const isCurrentlyShown = menu.classList.contains('show');
                
                if (isCurrentlyShown) {
                    // Hide menu
                    menu.classList.remove('show', 'drop-up');
                    menu.style.visibility = 'hidden';
                    menu.style.opacity = '0';
                } else {
                    // Show menu and check position
                    menu.classList.add('show');
                    menu.style.visibility = 'visible';
                    menu.style.opacity = '1';
                    menu.classList.remove('drop-up');
                    
                    // Check if menu would go off bottom of container or viewport
                    const wrapperEl = menu.closest('.schedule-wrapper') || document.querySelector('.schedule-wrapper');
                    const boundaryBottom = wrapperEl ? wrapperEl.getBoundingClientRect().bottom : window.innerHeight;
                    const menuRect = menu.getBoundingClientRect();
                    
                    // If menu extends beyond boundary, show it upward
                    if (menuRect.bottom > boundaryBottom - 8) {
                        menu.classList.add('drop-up');
                        console.log('Menu positioned upward for:', menuId);
                    }
                }
                
                console.log('Menu toggled:', menuId, !isCurrentlyShown);
            } else {
                console.error('Menu not found:', menuId);
            }
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            // Check if click is not on action button or menu
            if (!event.target.closest('.action-btn') && !event.target.closest('.action-menu')) {
                console.log('Document clicked, closing menus');
                document.querySelectorAll('.action-menu').forEach(menu => {
                    if (menu.classList.contains('show')) {
                        console.log('Closing menu:', menu.id);
                        menu.classList.remove('show', 'drop-up');
                        menu.style.visibility = 'hidden';
                        menu.style.opacity = '0';
                    }
                });
            }
        });

        // Initialize after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Calendar initialized, menus available:', document.querySelectorAll('.action-menu').length);
            
            // Prevent menu from closing when clicking inside it
            document.querySelectorAll('.action-menu').forEach(menu => {
                menu.addEventListener('click', function(event) {
                    console.log('Menu clicked, preventing close:', menu.id);
                    event.stopPropagation();
                });
            });
        });
    </script>
@endpush
