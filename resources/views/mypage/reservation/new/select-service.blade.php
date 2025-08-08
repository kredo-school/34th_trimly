{{-- Select service page for reservation process @ Juri --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimly - Choose Service</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-styles.css') }}">
    <style>
        /* ページ固有の微調整のみ */
        .service-card.selected {
            border: 2px solid var(--color-primary);
            background-color: rgba(176, 137, 104, 0.03);
        }
        
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('users.profile.header')

    {{-- Step bar for the reservation process @ Juri --}}
    <div class="container mt-4">
        <div class="booking-progress">
            <div class="booking-step completed">
                <div class="booking-step-circle">✓</div>
                <div class="booking-step-label">Salon</div>
            </div>
            <div class="booking-step active">
                <div class="booking-step-circle">2</div>
                <div class="booking-step-label">Service</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-circle">3</div>
                <div class="booking-step-label">Pet</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-circle">4</div>
                <div class="booking-step-label">Schedule</div>
            </div>
            <div class="booking-step">
                <div class="booking-step-circle">5</div>
                <div class="booking-step-label">Confirm</div>
            </div>
        </div>
    </div>

    <main class="container section">
        <div class="card">
            <div class="card-body">
                <h3 class="page-title">✂️ Choose Your Service</h3>

                <div class="services-grid">
                    @foreach($services as $service)
                    <div class="service-card" data-service-id="{{ $service['id'] }}">
                        <div class="service-header">
                            <h3 class="service-title">{{ $service['name'] }}</h3>
                            <div class="service-price">${{ $service['price'] }}</div>
                        </div>
                        <p class="text-secondary">{{ $service['description'] }}</p>
                        <div class="service-duration">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 4V8L10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            {{ $service['duration'] }}
                        </div>
                        <div>
                            <p class="text-secondary mb-2">Includes:</p>
                            <div class="service-features">
                                @foreach($service['includes'] as $include)
                                <span class="service-feature">✓ {{ $include }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-5">
                    <a href="/mypage/reservation/new" class="btn btn-outline">
                        ← Back
                    </a>
                    <button class="btn btn-primary" id="continueBtn" disabled>
                        Continue →
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceCards = document.querySelectorAll('.service-card');
            const continueBtn = document.getElementById('continueBtn');
            let selectedServiceId = null;

            serviceCards.forEach(card => {
                card.addEventListener('click', function() {
                    serviceCards.forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedServiceId = this.dataset.serviceId;
                    continueBtn.disabled = false;
                });
            });

            continueBtn.addEventListener('click', function() {
                if (selectedServiceId) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const salonId = urlParams.get('salon_id');
                    window.location.href = `/mypage/reservation/new/pet?salon_id=${salonId}&service_id=${selectedServiceId}`;
                }
            });
        });
    </script>
</body>
</html>