<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Flat Master') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&family=inter:300,400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 50%, #0f1629 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }

            /* Animated background elements */
            .bg-element {
                position: absolute;
                border-radius: 50%;
                opacity: 0.1;
                animation: float 6s ease-in-out infinite;
            }

            .bg-element-1 {
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, #00d4ff, #0099ff);
                top: -100px;
                left: -100px;
                animation-delay: 0s;
            }

            .bg-element-2 {
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, #0099ff, #0066cc);
                bottom: -50px;
                right: -50px;
                animation-delay: 2s;
            }

            .bg-element-3 {
                width: 250px;
                height: 250px;
                background: radial-gradient(circle, #00d4ff, #0099ff);
                top: 50%;
                right: 10%;
                animation-delay: 4s;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(30px);
                }
            }

            /* Main container */
            .container {
                position: relative;
                z-index: 10;
                max-width: 800px;
                width: 90%;
                text-align: center;
                animation: fadeInScale 1s ease-out;
            }

            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            /* Loading Animation */
            .loading-spinner {
                width: 80px;
                height: 80px;
                margin: 0 auto 40px;
                position: relative;
            }

            .spinner-circle {
                width: 100%;
                height: 100%;
                position: relative;
            }

            .spinner-ring {
                position: absolute;
                width: 100%;
                height: 100%;
                border: 4px solid transparent;
                border-top-color: #00d4ff;
                border-right-color: #0099ff;
                border-radius: 50%;
                animation: spin 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            }

            .spinner-ring:nth-child(2) {
                width: 70%;
                height: 70%;
                top: 15%;
                left: 15%;
                border-top-color: #0099ff;
                border-right-color: #0066cc;
                animation: spin 2s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite reverse;
            }

            .spinner-ring:nth-child(3) {
                width: 40%;
                height: 40%;
                top: 30%;
                left: 30%;
                border-top-color: #00d4ff;
                animation: spin 2.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

            /* Text Styles */
            .title {
                font-size: 3.5rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 20px;
                letter-spacing: -1px;
                background: linear-gradient(135deg, #ffffff 0%, #00d4ff 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .subtitle {
                font-size: 1.25rem;
                color: #a0aec0;
                margin-bottom: 50px;
                line-height: 1.6;
                font-weight: 300;
            }

            .description {
                font-size: 1rem;
                color: #cbd5e0;
                margin-bottom: 40px;
                line-height: 1.8;
            }

            .loading-text {
                font-size: 0.95rem;
                color: #00d4ff;
                font-weight: 500;
                letter-spacing: 2px;
                animation: fadeInOut 2s ease-in-out infinite;
            }

            @keyframes fadeInOut {
                0%, 100% {
                    opacity: 0.5;
                }
                50% {
                    opacity: 1;
                }
            }

            /* Button Styles */
            .button-group {
                display: flex;
                gap: 20px;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 50px;
            }

            .btn {
                padding: 14px 32px;
                font-size: 1rem;
                font-weight: 600;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .btn-primary {
                background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
                color: #0a0e27;
                box-shadow: 0 8px 24px rgba(0, 212, 255, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
            }

            .btn-secondary {
                background: transparent;
                color: #00d4ff;
                border: 2px solid #00d4ff;
                box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
            }

            .btn-secondary:hover {
                background: #00d4ff;
                color: #0a0e27;
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 212, 255, 0.3);
            }

            .btn:active {
                transform: translateY(-1px);
            }

            /* Features Grid */
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
                margin-top: 60px;
                padding-top: 40px;
                border-top: 1px solid rgba(0, 212, 255, 0.2);
            }

            .feature {
                padding: 20px;
                background: rgba(0, 212, 255, 0.05);
                border-radius: 12px;
                border: 1px solid rgba(0, 212, 255, 0.1);
                transition: all 0.3s ease;
            }

            .feature:hover {
                background: rgba(0, 212, 255, 0.1);
                border-color: rgba(0, 212, 255, 0.3);
                transform: translateY(-5px);
            }

            .feature-icon {
                font-size: 2rem;
                margin-bottom: 10px;
            }

            .feature-name {
                color: #00d4ff;
                font-size: 0.9rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .title {
                    font-size: 2.5rem;
                }

                .subtitle {
                    font-size: 1.1rem;
                }

                .button-group {
                    flex-direction: column;
                    gap: 15px;
                }

                .btn {
                    width: 100%;
                }

                .features {
                    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                }
            }
        </style>
    </head>
    <body>
        <!-- Animated Background Elements -->
        <div class="bg-element bg-element-1"></div>
        <div class="bg-element bg-element-2"></div>
        <div class="bg-element bg-element-3"></div>

        <!-- Main Content -->
        <div class="container">
            <!-- Loading Animation -->
            <!-- <div class="loading-spinner">
                <div class="spinner-circle">
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                </div>
            </div> -->

            <!-- Welcome Section -->
            <h1 class="title">Welcome to Flat Master</h1>
            <p class="subtitle">Professional Property Management System</p>
            <p class="description">Streamline your property management workflow with our comprehensive platform designed for modern landlords and property managers.</p>

            <p class="loading-text">⚡ GET STARTED NOW⚡</p>

            <!-- CTA Buttons -->
            <div class="button-group">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Create Account</a>
                @endguest
            </div>

            <!-- Features Grid -->
            <div class="features">
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-building"></i></div>
                    <div class="feature-name">Properties</div>
                </div>
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-key-fill"></i></div>
                    <div class="feature-name">Leases</div>
                </div>
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-cash-coin"></i></div>
                    <div class="feature-name">Payments</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">🔧</div>
                    <div class="feature-name">Maintenance</div>
                </div>
            </div>
        </div>
    </body>
</html>
