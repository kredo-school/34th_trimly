{{-- Select schedule page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Choose Date & Time')

@section('header')
    @include('users.profile.header')
@endsection

@section('content')
    {{-- Step bar for the reservation process @ Juri --}}
    <div class="steps">
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Salon</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Service</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Pet</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">4</div>
            </div>
            <div class="step-label">Schedule</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">5</div>
            </div>
            <div class="step-label">Confirm</div>
        </div>
    </div>

    <main class="main-content">
        <div class="card">
            <h1 class="card-title schedule-title"><i class="fas fa-calendar-alt me-2" style="color: #b08968;"></i>Choose Date&Time</h1>
            
            <div class="schedule-container">
                <div class="date-section">
                    <h2 class="section-title">Select Date</h2>
                    <div class="calendar-header">
                        <span class="month-year">{{ $monthName }} {{ $year }}</span>
                        <div class="month-nav">
                            <button class="nav-btn prev">&lt;</button>
                            <button class="nav-btn next">&gt;</button>
                        </div>
                    </div>
                    
                    <div class="calendar-days">
                        <div class="day-header">Mon</div>
                        <div class="day-header">Tue</div>
                        <div class="day-header">Wed</div>
                        <div class="day-header">Thu</div>
                        <div class="day-header">Fri</div>
                        <div class="day-header">Sat</div>
                        <div class="day-header">Sun</div>
                    </div>
                    
                    <div class="calendar-grid">
                        @foreach($calendar as $dayInfo)
                            @if($dayInfo === null)
                                <div class="day-cell empty"></div>
                            @else
                                <div class="day-cell{{ $dayInfo['isToday'] ? ' today' : '' }}{{ !$dayInfo['isAvailable'] ? ' unavailable' : '' }}{{ $dayInfo['isPast'] ? ' past' : '' }}" 
                                     data-day="{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($dayInfo['day'], 2, '0', STR_PAD_LEFT) }}"
                                     data-available="{{ $dayInfo['isAvailable'] ? 'true' : 'false' }}">
                                    <div class="day-number">{{ $dayInfo['day'] }}</div>
                                    @if($dayInfo['isToday'])
                                        <div class="day-label">Today</div>
                                    @elseif(!$dayInfo['isAvailable'])
                                        <div class="day-label">Closed</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="time-section">
                    <h2 class="section-title">Select Time</h2>
                    <div class="time-slots">
                        @foreach($timeSlots as $time)
                            <button class="time-slot" data-time="{{ $time }}">{{ $time }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('reservation.select-pet', request()->only(['salon_id', 'service_id'])) }}" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dayCells = document.querySelectorAll('.day-cell:not(.empty)');
            const timeSlots = document.querySelectorAll('.time-slot');
            const continueBtn = document.getElementById('continueBtn');
            const prevBtn = document.querySelector('.nav-btn.prev');
            const nextBtn = document.querySelector('.nav-btn.next');
            let selectedDate = null;
            let selectedTime = null;

            // Month navigation
            prevBtn.addEventListener('click', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentMonth = {{ $month }};
                const currentYear = {{ $year }};
                let newMonth = currentMonth - 1;
                let newYear = currentYear;
                
                if (newMonth < 1) {
                    newMonth = 12;
                    newYear = currentYear - 1;
                }
                
                urlParams.set('month', newMonth);
                urlParams.set('year', newYear);
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            nextBtn.addEventListener('click', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentMonth = {{ $month }};
                const currentYear = {{ $year }};
                let newMonth = currentMonth + 1;
                let newYear = currentYear;
                
                if (newMonth > 12) {
                    newMonth = 1;
                    newYear = currentYear + 1;
                }
                
                urlParams.set('month', newMonth);
                urlParams.set('year', newYear);
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            dayCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    // Check if the day is available for booking
                    if (this.dataset.available === 'false' || this.classList.contains('unavailable') || this.classList.contains('past')) {
                        return; // Don't allow selection of unavailable days
                    }
                    
                    dayCells.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedDate = this.dataset.day;
                    checkSelection();
                });
            });

            timeSlots.forEach(slot => {
                slot.addEventListener('click', function() {
                    timeSlots.forEach(s => s.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedTime = this.dataset.time;
                    checkSelection();
                });
            });

            function checkSelection() {
                if (selectedDate && selectedTime) {
                    continueBtn.disabled = false;
                }
            }

            continueBtn.addEventListener('click', function() {
                if (selectedDate && selectedTime) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const salonId = urlParams.get('salon_id');
                    const serviceId = urlParams.get('service_id');
                    const petId = urlParams.get('pet_id');
                    window.location.href = `/mypage/reservation/new/confirm?salon_id=${salonId}&service_id=${serviceId}&pet_id=${petId}&date=${selectedDate}&time=${selectedTime}`;
                }
            });
        });
    </script>
@endsection