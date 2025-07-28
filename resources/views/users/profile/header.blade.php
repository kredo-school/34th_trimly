<header class="header">
    <div class="logo">Trimly</div>
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
        gap: 8px;
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    .logo::before {
        content: '';
        width: 30px;
        height: 30px;
        background-color: #c8a882;
        border-radius: 50%;
    }

    .back-link {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: #333;
    }
</style>