<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register header</title>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/Trimly Logo.png') }}" alt="Trimly Logo">
            <span class="logo-text">Trimly</span>
        </div>
        <div class="col-6 text-end">
            <p class="text-muted mb-0 me-2 fs-6">Pet Owner Registration</p>
        </div>
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

    </style>
</body>

</html>
