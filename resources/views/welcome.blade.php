<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Estate Home Solutions</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Cpath d='M60 20L20 55V100H40V75H80V100H100V55L60 20Z' fill='%23FFB800'/%3E%3Crect x='50' y='60' width='20' height='20' fill='white'/%3E%3C/svg%3E">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-container {
            text-align: center;
            color: white;
            max-width: 600px;
            padding: 20px;
        }
        .logo-box {
            width: 150px;
            height: 150px;
            margin: 0 auto 30px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .logo-box svg {
            width: 120px;
            height: 120px;
        }
        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .subtitle {
            font-size: 1.5rem;
            color: #ffc107;
            margin-bottom: 30px;
            font-weight: 300;
            letter-spacing: 2px;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            line-height: 1.6;
            opacity: 0.95;
        }
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        .btn-custom {
            padding: 12px 40px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
            border: 2px solid white;
        }
        .btn-primary-custom {
            background: white;
            color: #1e3c72;
        }
        .btn-primary-custom:hover {
            background: #ffc107;
            border-color: #ffc107;
            color: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .btn-secondary-custom {
            background: transparent;
            color: white;
        }
        .btn-secondary-custom:hover {
            background: white;
            color: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="logo-box">
            <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M60 20L20 55V100H40V75H80V100H100V55L60 20Z" fill="#FFB800" stroke="#FFB800" stroke-width="2" stroke-linejoin="round"/>
                <rect x="50" y="60" width="20" height="20" fill="white"/>
            </svg>
        </div>

        <h1>Real Estate</h1>
        <div class="subtitle">Home Solutions</div>

        <p>Welcome to your professional real estate management system. Manage properties, buyers, agents, and sales all in one place.</p>

        <div class="btn-group">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-custom btn-primary-custom">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-custom btn-primary-custom">Log In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-custom btn-secondary-custom">Register</a>
                @endif
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
