<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sign In - {{ config('app.name', 'Flat Master') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />

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
                opacity: 0.08;
                animation: float 6s ease-in-out infinite;
            }

            .bg-element-1 {
                width: 350px;
                height: 350px;
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
                width: 100%;

                padding: Auto;
                margin-left: 25%;
                margin-right: auto;

                
            }

            .login-card {
                background: rgba(26, 31, 58, 0.7);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 16px;
                padding: 50px 40px;
                width: 50%;
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .logo {
                text-align: center;
                margin-bottom: 30px;
            }

            .logo-icon {
                font-size: 3rem;
                margin-bottom: 15px;
            }

            .logo-text {
                font-size: 1.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #ffffff 0%, #00d4ff 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .heading {
                text-align: center;
                margin-bottom: 35px;
            }

            .heading h2 {
                font-size: 1.5rem;
                color: #ffffff;
                margin-bottom: 8px;
            }

            .heading p {
                font-size: 0.9rem;
                color: #a0aec0;
            }

            /* Form Group */
            .form-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
                color: #cbd5e0;
                font-size: 0.9rem;
                font-weight: 500;
                margin-bottom: 8px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px 16px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 8px;
                color: #ffffff;
                font-size: 1rem;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                background: rgba(0, 212, 255, 0.05);
                border-color: #00d4ff;
                box-shadow: 0 0 12px rgba(0, 212, 255, 0.2);
            }

            input[type="email"]::placeholder,
            input[type="password"]::placeholder {
                color: #718096;
            }

            /* Options Row */
            .form-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .checkbox-group {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #00d4ff;
            }

            .checkbox-label {
                color: #cbd5e0;
                font-size: 0.9rem;
                margin: 0;
                cursor: pointer;
                text-transform: none;
                letter-spacing: normal;
            }

            .forgot-password {
                color: #00d4ff;
                text-decoration: none;
                font-size: 0.9rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .forgot-password:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            /* Button */
            .btn-login {
                width: 100%;
                padding: 14px;
                background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
                color: #0a0e27;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                text-transform: uppercase;
                letter-spacing: 1px;
                box-shadow: 0 8px 24px rgba(0, 212, 255, 0.3);
            }

            .btn-login:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
            }

            .btn-login:active {
                transform: translateY(-1px);
            }

            .btn-login:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                transform: none;
            }

            /* Error Messages */
            .error-message {
                background: rgba(245, 101, 101, 0.1);
                border: 1px solid rgba(245, 101, 101, 0.3);
                color: #ff6b6b;
                padding: 12px 16px;
                border-radius: 8px;
                font-size: 0.9rem;
                margin-bottom: 20px;
                animation: shake 0.3s ease;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }

            /* Sign up link */
            .signup-section {
                text-align: center;
                margin-top: 25px;
                padding-top: 25px;
                border-top: 1px solid rgba(0, 212, 255, 0.1);
            }

            .signup-text {
                color: #a0aec0;
                font-size: 0.9rem;
            }

            .signup-link {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .signup-link:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            /* Divider */
            .divider {
                display: flex;
                align-items: center;
                margin: 25px 0;
                color: #718096;
                font-size: 0.85rem;
            }

            .divider::before,
            .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(0, 212, 255, 0.1);
            }

            .divider::before {
                margin-right: 15px;
            }

            .divider::after {
                margin-left: 15px;
            }

            /* Responsive */
            @media (max-width: 600px) {
                .container {
                    padding: 20px;
                }

                .login-card {
                    padding: 35px 25px;
                }

                .heading h2 {
                    font-size: 1.3rem;
                }

                .form-options {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .forgot-password {
                    align-self: flex-end;
                }
            }
        </style>
    </head>
    <body>
        <!-- Animated background elements -->
        <div class="bg-element bg-element-1"></div>
        <div class="bg-element bg-element-2"></div>

        <!-- Main Container -->
        <div class="container">
            <div class="login-card">
                <!-- Logo -->
                <div class="logo">
                    <div class="logo-icon">🏠</div>
                    <div class="logo-text">Flat Master</div>
                </div>

                <!-- Heading -->
                <div class="heading">
                    <h2>Welcome Back</h2>
                    <p>Sign in to your account to continue</p>
                </div>

                <!-- Error Messages -->
                 @if (session('success'))
                    <div class="alert alert-success error-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger error-message">
                        {{ session('error') }}
                    </div>
                @endif


                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required 
                            autofocus
                        >
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••"
                            required 
                        >
                    </div>

                    <!-- Form Options -->
                    <div class="form-options">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember" class="checkbox-label">Remember me</label>
                        </div>
                       
                        <a href="" class="forgot-password">Forgot password?</a>
                     
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit" class="btn-login">Sign In</button>
                </form>

                <!-- Sign Up Link -->
                <div class="signup-section">
                    <p class="signup-text">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="signup-link">Create one now</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
