@extends('layouts.navigation')

@section('title', 'Calendar')

@push('styles')
      
    
    <style>
        body {
            background-color: #FBF8F3;
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
            overflow: hidden;
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
            font-size: 15px;
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
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .action-menu.show {
            display: block;
            opacity: 1;
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
        <div class="calendar-wrapper">
            <div class="calendar-header">
                <h2 class="calendar-title">Calendar View</h2>
                <div class="calendar-nav">
                    <button class="nav-btn" onclick="previousMonth()">‹</button>
                    <span class="current-month" id="currentMonth">July 2025</span>
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
                    $daysInMonth = 31;
                    $firstDayOfWeek = 2; // Tuesday
                    $totalCells = 35;
                    $dayCounter = 1;
                @endphp

                @for ($i = 0; $i < $totalCells; $i++)
                    @if ($i < $firstDayOfWeek - 1)
                        <div class="calendar-day empty"></div>
                    @elseif ($dayCounter <= $daysInMonth)
                        <div class="calendar-day">
                            <div class="day-number {{ $dayCounter == 25 ? 'active' : '' }}">{{ $dayCounter }}</div>
                            
                            @if ($dayCounter == 25)
                                <div class="appointment">09:00 Sarah J.</div>
                                <div class="appointment">11:30 Mike T.</div>
                                <div class="appointment more">1 more...</div>
                            @elseif ($dayCounter == 26)
                                <div class="appointment">10:00 John D.</div>
                                <div class="appointment">03:00 Lisa M.</div>
                            @elseif ($dayCounter == 27)
                                <div class="appointment">09:30 Alex P.</div>
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
            <h3 class="schedule-header">Schedule for Friday, July 25, 2025</h3>
            
            <div class="appointment-list">
                <div class="appointment-card">
                    <div class="appointment-avatar">S</div>
                    <div class="appointment-details">
                        <div class="client-info">
                            <span class="client-name">Sarah Johnson</span>
                            <span class="service-type">Full Grooming • Buddy</span>
                        </div>
                        <div class="appointment-meta">09:00 AM • Golden Retriever</div>
                    </div>
                    <span class="appointment-status status-confirmed">confirmed</span>
                    <div class="appointment-actions">
                        <button class="action-btn" onclick="toggleMenu(event, 'menu1')">⋯</button>
                        <div class="action-menu" id="menu1">
                            <button class="action-menu-item">
                                <i class="fas fa-edit"></i>
                                Edit Appointment
                            </button>
                            <button class="action-menu-item cancel">
                                <i class="fas fa-trash"></i>
                                Cancel Appointment
                            </button>
                        </div>
                    </div>
                </div>

                <div class="appointment-card">
                    <div class="appointment-avatar">M</div>
                    <div class="appointment-details">
                        <div class="client-info">
                            <span class="client-name">Mike Thompson</span>
                            <span class="service-type">Trim & Style • Luna</span>
                        </div>
                        <div class="appointment-meta">11:30 AM • Poodle</div>
                    </div>
                    <span class="appointment-status status-confirmed">confirmed</span>
                    <div class="appointment-actions">
                        <button class="action-btn" onclick="toggleMenu(event, 'menu2')">⋯</button>
                        <div class="action-menu" id="menu2">
                            <button class="action-menu-item">
                                <i class="fas fa-edit"></i>
                                Edit Appointment
                            </button>
                            <button class="action-menu-item cancel">
                                <i class="fas fa-trash"></i>
                                Cancel Appointment
                            </button>
                        </div>
                    </div>
                </div>

                <div class="appointment-card">
                    <div class="appointment-avatar">E</div>
                    <div class="appointment-details">
                        <div class="client-info">
                            <span class="client-name">Emma Davis</span>
                            <span class="service-type">Breed Cut • Max</span>
                        </div>
                        <div class="appointment-meta">02:00 PM • German Shepherd</div>
                    </div>
                    <span class="appointment-status status-cancelled">cancelled</span>
                    <div class="appointment-actions">
                        <button class="action-btn" onclick="toggleMenu(event, 'menu3')">⋯</button>
                        <div class="action-menu" id="menu3">
                            <button class="action-menu-item">
                                <i class="fas fa-edit"></i>
                                Edit Appointment
                            </button>
                            <button class="action-menu-item cancel">
                                <i class="fas fa-trash"></i>
                                Cancel Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentDate = new Date(2025, 6, 1); // July 2025

        function updateCalendarHeader() {
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                          'July', 'August', 'September', 'October', 'November', 'December'];
            const month = months[currentDate.getMonth()];
            const year = currentDate.getFullYear();
            document.getElementById('currentMonth').textContent = `${month} ${year}`;
        }

        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendarHeader();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendarHeader();
        }

        updateCalendarHeader();

        function toggleMenu(event, menuId) {
            event.stopPropagation();
            event.preventDefault();
            
            // Close all other menus
            document.querySelectorAll('.action-menu').forEach(menu => {
                if (menu.id !== menuId) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle current menu
            const menu = document.getElementById(menuId);
            if (menu) {
                menu.classList.toggle('show');
                console.log('Menu toggled:', menuId, menu.classList.contains('show'));
            } else {
                console.error('Menu not found:', menuId);
            }
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            console.log('Document clicked, closing menus');
            document.querySelectorAll('.action-menu').forEach(menu => {
                if (menu.classList.contains('show')) {
                    console.log('Closing menu:', menu.id);
                    menu.classList.remove('show');
                }
            });
        });

        // Prevent menu from closing when clicking inside it
        document.querySelectorAll('.action-menu').forEach(menu => {
            menu.addEventListener('click', function(event) {
                console.log('Menu clicked, preventing close:', menu.id);
                event.stopPropagation();
            });
        });

        // Initialize after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Calendar initialized, menus available:', document.querySelectorAll('.action-menu').length);
        });
    </script>
@endpush