{{-- Booking complete page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Booking Confirmed')

@push('styles')
    <style>
        /* Hide default navigation */
        body > nav,
        body > .navbar,
        body > header,
        body > .header,
        .main-nav,
        .main-header {
            display: none !important;
        }
        
        /* Override body background */
        body {
            background-color: #fefcf1 !important;
            padding-top: 0 !important;
        }
        
        /* Custom header for complete page */
        .complete-page-header {
            background-color: white;
            padding: 16px 40px;
            border-bottom: 1px solid #e0e0e0;
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 64px;
        }
        
        .complete-page-header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .complete-page-header .logo img {
            height: 32px;
            width: auto;
        }
        
        .complete-page-header .logo-text {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #333;
        }
        
        .back-to-mypage {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: white;
            transition: all 0.2s;
        }
        
        .back-to-mypage:hover {
            background-color: #f5f5f5;
            border-color: #d0d0d0;
            text-decoration: none;
            color: #666;
        }
        
        /* Main container adjustments */
        .complete-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 124px 20px 60px;
            text-align: center;
        }
        
        /* Success icon styles */
        .success-icon {
            margin-bottom: 24px;
        }
        
        .success-title {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 12px;
        }
        
        .success-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.5;
        }
        
        /* Confirmation box */
        .confirmation-box {
            background-color: #f0e8dc;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 40px;
        }
        
        .confirmation-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .confirmation-number {
            font-size: 24px;
            font-weight: 700;
            color: #c8a882;
            margin-bottom: 8px;
        }
        
        .confirmation-note {
            font-size: 13px;
            color: #666;
        }
        
        /* Booking details card */
        .booking-details-card {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            text-align: left;
        }
        
        .details-heading {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 24px;
        }
        
        .service-details {
            display: flex;
            gap: 16px;
            padding: 20px;
            background-color: #faf8f5;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        
        .service-icon {
            font-size: 32px;
            line-height: 1;
        }
        
        .service-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0 0 4px 0;
        }
        
        .service-duration {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .service-price {
            display: inline-block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            background-color: #e0d4c1;
            padding: 4px 12px;
            border-radius: 20px;
        }
        
        .datetime-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .date-info,
        .time-info {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        
        .date-label,
        .time-label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }
        
        .date-sublabel,
        .time-sublabel {
            font-size: 12px;
            color: #666;
        }
        
        .pet-info,
        .salon-info {
            margin-bottom: 24px;
        }
        
        .info-heading {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        
        .info-label,
        .detail-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }
        
        .info-value,
        .detail-value {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }
        
        .salon-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }
        
        .salon-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        
        /* Reminders card */
        .reminders-card {
            background-color: #e3f2fd;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }
        
        .reminders-heading {
            font-size: 18px;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 16px;
        }
        
        .reminders-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        
        .reminders-list {
            list-style: none;
            padding: 0;
        }
        
        .reminders-list li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 8px;
            font-size: 13px;
            color: #1e3a8a;
            line-height: 1.5;
        }
        
        .reminders-list li::before {
            content: '•';
            position: absolute;
            left: 8px;
            color: #1e3a8a;
        }
        
        .btn-another {
            display: inline-block;
            padding: 14px 32px;
            background-color: #c8a882;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-another:hover {
            background-color: #b39770;
            text-decoration: none;
            color: white;
        }
        
        /* Remove default container styles */
        .container {
            max-width: none !important;
            padding: 0 !important;
        }
        
        .row {
            margin: 0 !important;
        }
        
        .col-12,
        .col-md-10,
        .col-lg-8 {
            padding: 0 !important;
            max-width: none !important;
            flex: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="complete-page-header">
        <div class="logo">
            <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
            <span class="logo-text">Trimly</span>
        </div>
        <a href="/mypage" class="back-to-mypage">
            ← Back to My page
        </a>
    </div>

    <div class="complete-container">
        <div class="success-icon">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="40" fill="#7fa778"/>
                <path d="M25 40L34 49L55 28" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1 class="success-title">Booking Confirmed!</h1>
        <p class="success-message">Your appointment has been successfully booked. We've sent a confirmation email to {{ $bookingDetails['user_email'] }}</p>

        <div class="confirmation-box">
            <p class="confirmation-label">Confirmation Number</p>
            <p class="confirmation-number">{{ $bookingDetails['confirmation_number'] }}</p>
            <p class="confirmation-note">Save this number for your records</p>
        </div>

        <div class="booking-details-card">
            <h2 class="details-heading">Appointment Details</h2>
            
            <div class="service-details">
                <div class="service-icon">✂️</div>
                <div>
                    <h3 class="service-name">{{ $bookingDetails['service']['name'] }}</h3>
                    <p class="service-duration">Duration: {{ $bookingDetails['service']['duration'] }}</p>
                    <span class="service-price">${{ number_format($bookingDetails['service']['price'], 2) }}</span>
                </div>
            </div>

            <div class="datetime-row">
                <div class="date-info">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="14" height="14" rx="2" stroke="#666" stroke-width="1.5"/>
                        <path d="M3 8H17" stroke="#666" stroke-width="1.5"/>
                        <path d="M7 2V4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M13 2V4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <p class="date-label">{{ $bookingDetails['appointment']['date'] }}</p>
                        <p class="date-sublabel">Date</p>
                    </div>
                </div>
                <div class="time-info">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="8" stroke="#666" stroke-width="1.5"/>
                        <path d="M10 5V10L13 13" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <p class="time-label">{{ $bookingDetails['appointment']['time'] }}</p>
                        <p class="time-sublabel">Time</p>
                    </div>
                </div>
            </div>

            <div class="pet-info">
                <h3 class="info-heading">Pet Information</h3>
                <div class="info-grid">
                    <div>
                        <p class="info-label">Name</p>
                        <p class="info-value">{{ $bookingDetails['pet']['name'] }}</p>
                    </div>
                    <div>
                        <p class="info-label">Breed</p>
                        <p class="info-value">{{ $bookingDetails['pet']['breed'] }}</p>
                    </div>
                    <div>
                        <p class="info-label">Size</p>
                        <p class="info-value">{{ $bookingDetails['pet']['size'] }}</p>
                    </div>
                </div>
            </div>

            <div class="salon-info">
                <h3 class="info-heading">Salon Information</h3>
                <p class="salon-name">{{ $bookingDetails['salon']['name'] }}</p>
                <div class="salon-details">
                    <div>
                        <p class="detail-label">Address</p>
                        <p class="detail-value">{{ $bookingDetails['salon']['address'] }}</p>
                    </div>
                    <div>
                        <p class="detail-label">Phone</p>
                        <p class="detail-value">{{ $bookingDetails['salon']['phone'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="reminders-card">
            <h2 class="reminders-heading">Important Reminders</h2>
            <div class="reminders-grid">
                <ul class="reminders-list">
                    <li>Please arrive 10 minutes before your appointment</li>
                    <li>Bring vaccination records if this is your first visit</li>
                    <li>Ensure your pet is clean and brushed if possible</li>
                </ul>
                <ul class="reminders-list">
                    <li>Cancellations must be made 24 hours in advance</li>
                    <li>Payment is due at the time of service</li>
                    <li>Contact the salon with any special requests</li>
                </ul>
            </div>
        </div>

        <a href="/mypage" class="btn-another">
            Book Another Appointment →
        </a>
    </div>
@endsection