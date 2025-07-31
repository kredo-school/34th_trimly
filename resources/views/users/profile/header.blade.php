<header class="header">
    <div class="logo">
        <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
        <span class="logo-text">Trimly</span>
    </div>
    <a href="/mypage" class="back-link">
        ← Back to My page
    </a>
</header>

<style>
    .header {
        background-color: white;
        padding: 16px 20px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 40px;
        width: auto;
    }

    .logo-text {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #333;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        padding: 8px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #fefcf1;
        transition: all 0.2s;
    }

    .back-link:hover {
        background-color: #f5f5f5;
        border-color: #d0d0d0;
    }
</style>