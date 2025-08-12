<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimly Admin - Calendar</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #fffbf0;
            color: #333;
        }
        
        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: white;
        }
        
        .admin-title h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .admin-title p {
            font-size: 14px;
            color: #666;
        }
        
        .header-buttons {
            display: flex;
            gap: 12px;
        }
        
        .header-btn {
            padding: 8px 16px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .header-btn:hover {
            background: #f5f5f5;
        }
        
        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }
        
        /* Calendar Card */
        .calendar-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .calendar-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
        }
        
        /* Calendar Navigation */
        .calendar-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
            position: relative;
        }
        
        .month-year {
            font-size: 18px;
            font-weight: 600;
        }
        
        .nav-arrow {
            position: absolute;
            width: 30px;
            height: 30px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            color: #666;
        }
        
        .nav-arrow:hover {
            background: #f5f5f5;
        }
        
        .nav-arrow.prev {
            left: 0;
        }
        
        .nav-arrow.next {
            right: 0;
        }
        
        /* Calendar Grid */
        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            margin-bottom: 8px;
        }
        
        .weekday {
            text-align: center;
            font-size: 13px;
            color: #666;
            font-weight: 500;
            padding: 8px 0;
        }
        
        .days-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }
        
        .day {
            aspect-ratio: 1;
            min-height: 100px;
            background: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }
        
        .day:hover:not(.other-month) {
            border-color: #b08968;
            background: #fefefe;
        }
        
        .day.other-month {
            opacity: 0.4;
            cursor: default;
        }
        
        .day.has-appointments {
            background: #b08968;
            color: white;
            border-color: #b08968;
        }
        
        .day-number {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .day.has-appointments .day-number {
            color: white;
        }
        
        .appointments-preview {
            font-size: 10px;
            line-height: 1.3;
        }
        
        .appointment-line {
            background: rgba(255,255,255,0.25);
            padding: 1px 3px;
            border-radius: 2px;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .more-count {
            text-align: center;
            font-size: 10px;
            margin-top: 2px;
        }
        
        /* Schedule Section */
        .schedule-header {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }
        
        .btn:hover {
            opacity: 0.85;
        }
        
        .btn-primary {
            background: #b08968;
            color: white;
        }
        
        .btn-outline-danger {
            background: white;
            color: #dc3545;
            border: 1px solid #dc3545;
        }
        
        /* Appointment Items */
        .appointment-item {
            background: #e8dcd0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }
        
        .appointment-item.cancelled {
            background: #e5e5e5;
            opacity: 0.7;
        }
        
        .appointment-avatar {
            width: 40px;
            height: 40px;
            background: #9e9e9e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }
        
        .appointment-content {
            flex: 1;
        }
        
        .customer-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
        }
        
        .service-details {
            font-size: 13px;
            color: #666;
            margin-bottom: 2px;
        }
        
        .time-details {
            font-size: 12px;
            color: #999;
        }
        
        .status-label {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 8px;
        }
        
        .status-confirmed {
            background: #4caf50;
            color: white;
        }
        
        .status-cancelled {
            background: #f44336;
            color: white;
        }
        
        .options-btn {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Calendar Section -->
        <div class="calendar-card">
            <h2 class="calendar-title">Calendar View</h2>
            
            <div class="calendar-nav">
                <button class="nav-arrow prev">←</button>
                <span class="month-year">July 2025</span>
                <button class="nav-arrow next">→</button>
            </div>
            
            <div class="weekdays">
                <div class="weekday">Sun</div>
                <div class="weekday">Mon</div>
                <div class="weekday">Tue</div>
                <div class="weekday">Wed</div>
                <div class="weekday">Thu</div>
                <div class="weekday">Fri</div>
                <div class="weekday">Sat</div>
            </div>
            
            <div class="days-grid">
                <!-- Previous month -->
                <div class="day other-month">
                    <div class="day-number">29</div>
                </div>
                <div class="day other-month">
                    <div class="day-number">30</div>
                </div>
                
                <!-- July 2025 -->
                @for ($i = 1; $i <= 31; $i++)
                    @if ($i == 25)
                        <div class="day has-appointments">
                            <div class="day-number">{{ $i }}</div>
                            <div class="appointments-preview">
                                <div class="appointment-line">09:00 Sarah J.</div>
                                <div class="appointment-line">11:30 Mike T.</div>
                                <div class="more-count">1 more...</div>
                            </div>
                        </div>
                    @elseif ($i == 26)
                        <div class="day has-appointments">
                            <div class="day-number">{{ $i }}</div>
                            <div class="appointments-preview">
                                <div class="appointment-line">10:00 John D.</div>
                                <div class="appointment-line">03:00 Lisa M.</div>
                            </div>
                        </div>
                    @elseif ($i == 27)
                        <div class="day has-appointments">
                            <div class="day-number">{{ $i }}</div>
                            <div class="appointments-preview">
                                <div class="appointment-line">09:30 Alex P.</div>
                            </div>
                        </div>
                    @else
                        <div class="day">
                            <div class="day-number">{{ $i }}</div>
                        </div>
                    @endif
                @endfor
                
                <!-- Next month -->
                <div class="day other-month">
                    <div class="day-number">1</div>
                </div>
                <div class="day other-month">
                    <div class="day-number">2</div>
                </div>
            </div>
        </div>
        
        <!-- Schedule Section -->
        <div class="schedule-section">
            <h3 class="schedule-header">Schedule for Friday, July 25, 2025</h3>
            
            <div class="action-buttons">
                <button class="btn btn-primary">
                    ✏️ Edit Appointment
                </button>
                <button class="btn btn-outline-danger">
                    🗑 Cancel Appointment
                </button>
            </div>
            
            <!-- Appointments -->
            <div class="appointment-item">
                <div class="appointment-avatar">✂️</div>
                <div class="appointment-content">
                    <div class="customer-name">
                        Sarah Johnson
                        <span class="status-label status-confirmed">CONFIRMED</span>
                    </div>
                    <div class="service-details">Full Grooming • Buddy</div>
                    <div class="time-details">09:00 AM • Golden Retriever</div>
                </div>
                <button class="options-btn">⋮</button>
            </div>
            
            <div class="appointment-item">
                <div class="appointment-avatar">✂️</div>
                <div class="appointment-content">
                    <div class="customer-name">
                        Mike Thompson
                        <span class="status-label status-confirmed">CONFIRMED</span>
                    </div>
                    <div class="service-details">Trim & Style • Luna</div>
                    <div class="time-details">11:30 AM • Poodle</div>
                </div>
                <button class="options-btn">⋮</button>
            </div>
            
            <div class="appointment-item cancelled">
                <div class="appointment-avatar">✂️</div>
                <div class="appointment-content">
                    <div class="customer-name">
                        Emma Davis
                        <span class="status-label status-cancelled">CANCELLED</span>
                    </div>
                    <div class="service-details">Breed Cut • Max</div>
                    <div class="time-details">02:00 PM • German Shepherd</div>
                </div>
                <button class="options-btn">⋮</button>
            </div>
        </div>
    </div>
    
    <script>
        // Calendar day selection
        document.querySelectorAll('.day:not(.other-month)').forEach(day => {
            day.addEventListener('click', function() {
                // Update selected date display
                const dayNum = this.querySelector('.day-number').textContent;
                document.querySelector('.schedule-header').textContent = 
                    `Schedule for July ${dayNum}, 2025`;
            });
        });
    </script>
</body>
</html>