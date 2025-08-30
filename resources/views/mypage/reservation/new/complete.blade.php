{{-- Booking complete page for reservation process @ Juri --}}
@extends('layouts.pet_owner')

@section('title', 'Booking Confirmed')

@section('header')
    @include('users.profile.header')
@endsection



@section('content')
    <style>
        body {
            background-color: #FEFCF1;
        }

        .complete-container {
            max-width: 760px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        @media (max-width: 768px) {
            .complete-container {
                width: 92vw;
                padding: 30px 0;
            }
        }

        .success-icon {
            text-align: center;
            margin-bottom: 24px;
        }

        .success-title {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.2;
            text-align: center;
            margin-bottom: 16px;
            color: #2D2D2D;
        }

        .success-message {
            text-align: center;
            color: #757575;
            margin-bottom: 32px;
        }

        .confirmation-box {
            border: 2px dashed #7FA778;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-bottom: 40px;
        }

        .confirmation-label {
            font-size: 14px;
            color: #757575;
            margin-bottom: 8px;
        }

        .confirmation-number {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            color: #3AA57A;
            letter-spacing: 2px;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .confirmation-note {
            font-size: 12px;
            color: #999;
        }

        .booking-details-card {
            background: white;
            box-shadow: 0 1px 0 #E8E2D4 inset, 0 2px 16px rgba(0,0,0,.04);
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .booking-details-card {
                padding: 24px;
            }
        }

        .details-heading {
            font-size: 20px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 24px;
        }

        .service-details {
            background: #F6F1E6;
            border-radius: 10px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .service-icon {
            font-size: 32px;
        }

        .service-name {
            font-size: 18px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 4px;
        }

        .service-duration {
            font-size: 14px;
            color: #757575;
            margin-bottom: 8px;
        }

        .service-price {
            background: #EADFCF;
            border-radius: 16px;
            padding: 4px 12px;
            font-size: 14px;
            font-weight: 600;
            color: #2D2D2D;
            display: inline-block;
        }

        .datetime-row {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .datetime-row {
                flex-direction: column;
                gap: 16px;
            }
        }

        .date-info, .time-info {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-label, .time-label {
            font-size: 16px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 2px;
        }

        .date-sublabel, .time-sublabel {
            font-size: 12px;
            color: #757575;
        }

        .pet-info, .salon-info {
            margin-bottom: 24px;
        }

        .info-heading {
            font-size: 16px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .info-label, .detail-label {
            font-size: 12px;
            color: #757575;
            margin-bottom: 4px;
        }

        .info-value, .detail-value {
            font-size: 14px;
            color: #2D2D2D;
            font-weight: 500;
        }

        .salon-name {
            font-size: 18px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 16px;
        }

        .salon-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .salon-details {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .reminders-card {
            background: #E8F1FF;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .reminders-heading {
            font-size: 18px;
            font-weight: 600;
            color: #1E3A8A;
            margin-bottom: 16px;
        }

        .reminders-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .reminders-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .reminders-list {
            margin: 0;
            padding-left: 20px;
        }

        .reminders-list li {
            color: #2D2D2D;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .btn-another {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 44px;
            padding: 0 32px;
            background: #C8A882;
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.2s;
        }

        .btn-another:hover {
            background: #B39770;
            color: white;
            text-decoration: none;
        }
    </style>

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

        <a href="/mypage/reservation" class="btn-another">
            Book Another Appointment →
        </a>
    </div>
@endsection