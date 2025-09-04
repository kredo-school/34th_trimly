    <header class="bg-white shadow-sm mb-2 custom-app-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
                <p class="fw-bold text-muted mb-0 fs-5">Trimly</p>
            </div>
            <div class="text-end">
                <p class="text-muted mb-0 me-2 fs-6">Pet Owner Registration</p>
            </div>
        </div>
    </header>

    <style>
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 80px;
            width: auto;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
        }
    </style>
