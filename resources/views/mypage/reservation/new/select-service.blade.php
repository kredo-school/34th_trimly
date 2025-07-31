{{-- Select service page for reservation process @ Juri --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimly - Choose Service</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
</head>
<body>
    @include('users.profile.header')

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
                <div class="step-number">2</div>
            </div>
            <div class="step-label">Service</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
                <div class="step-number">3</div>
            </div>
            <div class="step-label">Pet</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
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
            <h1 class="card-title service-title">Choose Your Service</h1>
            
            <div class="service-grid">
                @foreach($services as $service)
                <div class="service-item" data-service-id="{{ $service['id'] }}">
                    <div class="service-header">
                        <h3 class="service-name">{{ $service['name'] }}</h3>
                        <span class="service-price">${{ $service['price'] }}</span>
                    </div>
                    <p class="service-description">{{ $service['description'] }}</p>
                    <div class="service-duration">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="#666" stroke-width="1.5"/>
                            <path d="M8 4V8L10 10" stroke="#666" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        {{ $service['duration'] }}
                    </div>
                    <div class="service-includes">
                        <p class="includes-label">Includes:</p>
                        <ul class="includes-list">
                            @foreach($service['includes'] as $include)
                            <li>{{ $include }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="/mypage/reservation/new" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceItems = document.querySelectorAll('.service-item');
            const continueBtn = document.getElementById('continueBtn');
            let selectedServiceId = null;

            serviceItems.forEach(item => {
                item.addEventListener('click', function() {
                    serviceItems.forEach(si => si.classList.remove('selected'));
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