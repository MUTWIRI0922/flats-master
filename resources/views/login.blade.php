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
                color: #fff;
            }

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
                bottom: -60px;
                right: -60px;
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

            .auth-shell {
                position: relative;
                z-index: 10;
                display: flex;
                width: min(1100px, 92vw);
                min-height: 620px;
                border-radius: 24px;
                background: rgba(17, 24, 39, 0.72);
                border: 1px solid rgba(0, 212, 255, 0.22);
                overflow: hidden;
                backdrop-filter: blur(12px);
                box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(18px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .welcome-panel {
                flex: 1.05;
                padding: 54px 44px;
                background: linear-gradient(135deg, rgba(12, 16, 30, 0.95), rgba(12, 46, 65, 0.82));
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 32px;
                font-weight: 700;
                letter-spacing: 0.04em;
                color: #e2f3ff;
            }

            .brand-mark {
                width: 48px;
                height: 48px;
                display: grid;
                place-items: center;
                border-radius: 14px;
                background: linear-gradient(135deg, #00d4ff, #0066cc);
                font-size: 1.5rem;
                box-shadow: 0 12px 30px rgba(0, 212, 255, 0.35);
            }

            .welcome-copy h1 {
                font-size: clamp(2.3rem, 2vw, 3.2rem);
                line-height: 1.1;
                margin-bottom: 18px;
                color: #f8fbff;
            }

            .welcome-copy p {
                max-width: 420px;
                font-size: 1rem;
                line-height: 1.7;
                color: rgba(203, 213, 224, 0.9);
            }

            .welcome-badges {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                margin-top: 28px;
            }

            .welcome-badges span {
                padding: 10px 14px;
                border-radius: 999px;
                background: rgba(0, 212, 255, 0.1);
                border: 1px solid rgba(0, 212, 255, 0.2);
                color: #9fe9ff;
                font-size: 0.82rem;
                font-weight: 600;
            }

            .form-panel {
                flex: 1;
                padding: 52px 42px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.6);
            }

            .login-card {
                width: min(100%, 430px);
            }

            .logo {
                text-align: center;
                margin-bottom: 26px;
            }

            .logo-icon {
                font-size: 2.7rem;
                margin-bottom: 10px;
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
                margin-bottom: 26px;
            }

            .heading h2 {
                font-size: 1.8rem;
                color: #ffffff;
                margin-bottom: 8px;
            }

            .heading p {
                font-size: 0.95rem;
                color: #a0aec0;
            }

            .form-group {
                margin-bottom: 18px;
            }

            label {
                display: block;
                color: #cbd5e0;
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 8px;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px 14px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 10px;
                color: #ffffff;
                font-size: 1rem;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                background: rgba(0, 212, 255, 0.04);
                border-color: #00d4ff;
                box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.12);
            }

            input[type="email"]::placeholder,
            input[type="password"]::placeholder {
                color: #718096;
            }

            .form-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 8px 0 24px;
                gap: 10px;
            }

            .checkbox-group {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            input[type="checkbox"] {
                width: 16px;
                height: 16px;
                cursor: pointer;
                accent-color: #00d4ff;
            }

            .checkbox-label {
                color: #cbd5e0;
                font-size: 0.88rem;
                margin: 0;
                cursor: pointer;
                text-transform: none;
                letter-spacing: normal;
            }

            .forgot-password {
                color: #00d4ff;
                text-decoration: none;
                font-size: 0.88rem;
                font-weight: 500;
            }

            .forgot-password:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            .btn-login {
                width: 100%;
                padding: 14px 16px;
                border: none;
                border-radius: 10px;
                background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
                color: #04111d;
                font-size: 0.96rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                box-shadow: 0 12px 24px rgba(0, 212, 255, 0.25);
            }

            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 28px rgba(0, 212, 255, 0.3);
            }

            .btn-login:active {
                transform: translateY(0);
            }

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

            .signup-section {
                text-align: center;
                margin-top: 22px;
                padding-top: 20px;
                border-top: 1px solid rgba(0, 212, 255, 0.12);
            }

            .signup-text {
                color: #a0aec0;
                font-size: 0.9rem;
            }

            .signup-link {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 600;
            }

            .signup-link:hover {
                color: #6fe7ff;
                text-decoration: underline;
            }

            @media (max-width: 900px) {
                .auth-shell {
                    flex-direction: column;
                    min-height: auto;
                }

                .welcome-panel,
                .form-panel {
                    width: 100%;
                    flex: none;
                }

                .welcome-panel {
                    padding-bottom: 32px;
                }
            }

            @media (max-width: 600px) {
                body {
                    overflow: auto;
                }

                .auth-shell {
                    width: min(92vw, 480px);
                    margin: 28px 0;
                }

                .welcome-panel,
                .form-panel {
                    padding: 30px 22px;
                }

                .form-options {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        </style>
    </head>
    <body>
        <div class="bg-element bg-element-1"></div>
        <div class="bg-element bg-element-2"></div>

        <div class="auth-shell">
            <aside class="welcome-panel">
                <div class="brand">
                    <div class="brand-mark">🏠</div>
                    <span>Flat Master</span>
                </div>

                <div class="welcome-copy">
                    <h1>Welcome back to a smarter way to manage your property.</h1>
                    <p>Track leases, payments, maintenance requests, and tenant activity from one secure dashboard built for modern property management.</p>
                </div>

                <div class="welcome-badges">
                    <span>Secure access</span>
                    <span>Simple billing</span>
                    <span>Tenant insights</span>
                </div>
            </aside>

            <main class="form-panel">
                <div class="login-card">
                    <div class="logo">
                        <div class="logo-icon">🏠</div>
                        <div class="logo-text">Flat Master</div>
                    </div>

                    <div class="heading">
                        <h2>Welcome Back</h2>
                        <p>Sign in to your account to continue</p>
                    </div>

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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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

                        <div class="form-options">
                            <div class="checkbox-group">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember" class="checkbox-label">Remember me</label>
                            </div>

                            <a href="" class="forgot-password">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn-login">Sign In</button>
                    </form>

                    <div class="signup-section">
                        <p class="signup-text">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="signup-link">Create one now</a>
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
