{{-- Confirm booking page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Confirm Booking')

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
                <div class="step-number">✓</div>
            </div>
            <div class="step-label">Schedule</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">5</div>
            </div>
            <div class="step-label">Confirm</div>
        </div>
    </div>

    <main class="main-content">
        <div class="card">
            <h1 class="card-title confirm-title"><i class="fa-solid fa-check me-2" style="color: #b08968;"></i>Confirm Your Booking</h1>
            
            <div class="confirm-content">
                <div class="summary-section">
                    <h2 class="section-heading">Booking Summary</h2>
                    
                    <div class="service-summary">
                        <h3 class="service-name">{{ $bookingData['service']['name'] }}</h3>
                        <p class="service-description">{{ $bookingData['service']['description'] }}</p>
                        <div class="service-duration">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 4V8L10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            {{ $bookingData['service']['duration'] }}
                        </div>
                    </div>
                    
                    <div class="appointment-box">
                        <h3 class="appointment-heading">Appointment Time</h3>
                        <div class="appointment-details">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="4" width="14" height="14" rx="2" stroke="#666" stroke-width="1.5"/>
                                <path d="M3 8H17" stroke="#666" stroke-width="1.5"/>
                                <path d="M7 2V4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M13 2V4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            {{ $bookingData['appointment']['date'] }} at {{ $bookingData['appointment']['time'] }}
                        </div>
                    </div>
                </div>

                <div class="payment-section">
                    <h2 class="section-heading">Payment Information</h2>
                    
                    <div class="payment-total">
                        <div class="total-row">
                            <span class="total-label">Total</span>
                            <span class="total-amount">${{ $bookingData['service']['price'] }}</span>
                        </div>
                        <p class="payment-note">Final price may vary based on pet size and specific grooming requirements.</p>
                    </div>
                    
                    <div class="payment-method">
                        <h3 class="payment-heading">Payment Method</h3>
                        <p class="payment-text">Pay securely at the salon after service completion.</p>
                    </div>
                </div>
            </div>

            <div class="important-info">
                <h2 class="info-heading">Important Information</h2>
                <ul class="info-list">
                    <li>Please arrive 10 minutes before your appointment time</li>
                    <li>Bring your pet's vaccination records if this is your first visit</li>
                    <li>Cancellations must be made at least 24 hours in advance</li>
                    <li>Our groomers will contact you if any concerns arise during service</li>
                </ul>
            </div>

            <div class="terms-agreement">
                <label class="checkbox-container">
                    <input type="checkbox" id="termsCheckbox">
                    <span class="checkbox-text">I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="privacy-link">Privacy Policy</a></span>
                </label>
            </div>

            <div class="actions">
                <a href="{{ route('reservation.select-schedule', request()->only(['salon_id', 'service_id', 'pet_id'])) }}" class="btn btn-back">← Back</a>
                <button class="btn btn-confirm" id="confirmBtn" disabled>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 10L8 13L15 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Confirm Booking
                </button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const termsCheckbox = document.getElementById('termsCheckbox');
            const confirmBtn = document.getElementById('confirmBtn');

            termsCheckbox.addEventListener('change', function() {
                confirmBtn.disabled = !this.checked;
            });

            confirmBtn.addEventListener('click', function() {
                if (!confirmBtn.disabled) {
                    // Submit form to complete booking
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/mypage/reservation/new/complete';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    // Add booking data to form
                    const salonId = document.createElement('input');
                    salonId.type = 'hidden';
                    salonId.name = 'salon_id';
                    salonId.value = '{{ $bookingData["salon_id"] }}';
                    form.appendChild(salonId);
                    
                    const serviceId = document.createElement('input');
                    serviceId.type = 'hidden';
                    serviceId.name = 'service_id';
                    serviceId.value = '{{ $bookingData["service_id"] }}';
                    form.appendChild(serviceId);
                    
                    const petId = document.createElement('input');
                    petId.type = 'hidden';
                    petId.name = 'pet_id';
                    petId.value = '{{ $bookingData["pet_id"] }}';
                    form.appendChild(petId);
                    
                    const date = document.createElement('input');
                    date.type = 'hidden';
                    date.name = 'date';
                    date.value = '{{ $bookingData["date"] }}';
                    form.appendChild(date);
                    
                    const time = document.createElement('input');
                    time.type = 'hidden';
                    time.name = 'time';
                    time.value = '{{ $bookingData["time"] }}';
                    form.appendChild(time);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
@endsection