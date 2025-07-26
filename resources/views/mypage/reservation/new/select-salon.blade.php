<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimly - choose salon</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            background-color: #fefcf1;
            color: #333;
        }


        .steps {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background-color: #b08968;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .step-line {
            width: 60px;
            height: 2px;
            background-color: #e0d4c1;
        }

        .step-label {
            font-size: 14px;
            color: #666;
            position: absolute;
            bottom: -25px;
            white-space: nowrap;
            left: 50%;
            transform: translateX(-50%);
        }

        .step-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .step.inactive .step-number {
            background-color: #e0d4c1;
            color: #999;
        }

        .main-content {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title::before {
            content: '📋';
            font-size: 24px;
        }

        .card-subtitle {
            color: #666;
            margin-bottom: 30px;
        }

        .salon-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 40px;
        }

        .salon-item {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .salon-item:hover {
            border-color: #c8a882;
            background-color: #faf8f5;
        }

        .salon-item.selected {
            border-color: #c8a882;
            background-color: #f5f0e8;
        }

        .salon-icon {
            width: 40px;
            height: 40px;
            background-color: #f0e8dc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .salon-details {
            flex: 1;
        }

        .salon-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .salon-info {
            font-size: 14px;
            color: #666;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .btn {
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back {
            background-color: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-back:hover {
            background-color: #f5f5f5;
        }

        .btn-continue {
            background-color: #c8a882;
            color: white;
            margin-left: auto;
        }

        .btn-continue:hover {
            background-color: #b39770;
        }

        .btn-continue:disabled {
            background-color: #e0d4c1;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    @include('users.profile.header')

    <div class="steps">
        <div class="step-wrapper">
            <div class="step">
                <div class="step-number">1</div>
            </div>
            <div class="step-label">Salon</div>
        </div>
        <div class="step-line"></div>
        <div class="step-wrapper">
            <div class="step inactive">
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
            <h1 class="card-title">Select Your Salon</h1>
            <p class="card-subtitle">Choose from your registered salons</p>
            
            <div class="salon-list">
                @foreach($salons as $salon)
                <div class="salon-item" data-salon-id="{{ $salon['id'] }}">
                    <div class="salon-icon">🏢</div>
                    <div class="salon-details">
                        <div class="salon-name">{{ $salon['name'] }}</div>
                        <div class="salon-info">Code: {{ $salon['code'] }}</div>
                        <div class="salon-info">Registered: {{ $salon['registered_date'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="/mypage" class="btn btn-back">← Back</a>
                <button class="btn btn-continue" id="continueBtn" disabled>Continue →</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salonItems = document.querySelectorAll('.salon-item');
            const continueBtn = document.getElementById('continueBtn');
            let selectedSalonId = null;

            salonItems.forEach(item => {
                item.addEventListener('click', function() {
                    salonItems.forEach(si => si.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedSalonId = this.dataset.salonId;
                    continueBtn.disabled = false;
                });
            });

            continueBtn.addEventListener('click', function() {
                if (selectedSalonId) {
                    window.location.href = `/mypage/reservation/new/service?salon_id=${selectedSalonId}`;
                }
            });
        });
    </script>
</body>
</html>