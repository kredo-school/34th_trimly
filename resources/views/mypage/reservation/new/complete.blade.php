{{-- Booking complete page for reservation process @ Juri --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimly - Booking Confirmed</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
</head>
<body>
    <div class="complete-header">
        <div class="logo">
            <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
            <span class="logo-text">Trimly</span>
        </div>
        <a href="/mypage" class="back-to-mypage">
            ← Back to My page
        </a>
    </div>

    <main class="complete-container">
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
    </main>

    <style>
        /* Override body background for complete page */
        body {
            background-color: #fefcf1;
        }
    </style>
</body>
</html>