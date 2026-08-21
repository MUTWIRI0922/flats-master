<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create Account - {{ config('app.name', 'Flat Master') }}</title>

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
                overflow-y: auto;
                overflow-x: hidden;
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
                min-height: 640px;
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
                font-size: clamp(2.15rem, 2vw, 3.2rem);
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
                padding: 34px 34px 26px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(15, 23, 42, 0.6);
            }

            .register-card {
                width: min(100%, 470px);
            }

            .logo {
                text-align: center;
                margin-bottom: 20px;
            }

            .logo-icon {
                font-size: 2.5rem;
                margin-bottom: 8px;
            }

            .logo-text {
                font-size: 1.4rem;
                font-weight: 700;
                background: linear-gradient(135deg, #ffffff 0%, #00d4ff 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .heading {
                text-align: center;
                margin-bottom: 24px;
            }

            .heading h2 {
                font-size: 1.7rem;
                color: #ffffff;
                margin-bottom: 8px;
            }

            .heading p {
                font-size: 0.9rem;
                color: #a0aec0;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }

            .form-row .form-group {
                margin-bottom: 14px;
            }

            label {
                display: block;
                color: #cbd5e0;
                font-size: 0.76rem;
                font-weight: 600;
                margin-bottom: 7px;
                text-transform: uppercase;
                letter-spacing: 0.06em;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 11px 12px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 9px;
                color: #ffffff;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                background: rgba(0, 212, 255, 0.04);
                border-color: #00d4ff;
                box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.12);
            }

            input[type="text"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder {
                color: #718096;
            }

            .error-message {
                background: rgba(245, 101, 101, 0.1);
                border: 1px solid rgba(245, 101, 101, 0.3);
                color: #ff6b6b;
                padding: 12px 16px;
                border-radius: 8px;
                font-size: 0.85rem;
                margin-bottom: 16px;
                animation: shake 0.3s ease;
            }

            .field-error {
                border-color: #ff6b6b !important;
                background: rgba(255, 107, 107, 0.05) !important;
            }

            .error-text {
                color: #ff6b6b;
                font-size: 0.74rem;
                margin-top: 5px;
                display: block;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }

            .password-requirements {
                background: rgba(0, 212, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.12);
                border-radius: 8px;
                padding: 12px 14px;
                margin: 8px 0 14px;
            }

            .requirements-title {
                color: #00d4ff;
                font-size: 0.72rem;
                font-weight: 700;
                text-transform: uppercase;
                margin-bottom: 8px;
                letter-spacing: 0.05em;
            }

            .requirement-item {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #cbd5e0;
                font-size: 0.78rem;
                margin-bottom: 5px;
            }

            .requirement-item:last-child {
                margin-bottom: 0;
            }

            .check-icon {
                width: 15px;
                height: 15px;
                border-radius: 50%;
                background: rgba(0, 212, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.6rem;
                flex-shrink: 0;
            }

            .check-icon.active {
                background: #00d4ff;
                color: #0a0e27;
            }

            .checkbox-group {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin: 10px 0 18px;
            }

            input[type="checkbox"] {
                width: 16px;
                height: 16px;
                cursor: pointer;
                accent-color: #00d4ff;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .checkbox-text {
                color: #a0aec0;
                font-size: 0.8rem;
                line-height: 1.5;
            }

            .checkbox-text a {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 500;
            }

            .checkbox-text a:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            .btn-register {
                width: 100%;
                padding: 13px 14px;
                border: none;
                border-radius: 10px;
                background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%);
                color: #04111d;
                font-size: 0.9rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                box-shadow: 0 12px 24px rgba(0, 212, 255, 0.25);
            }

            .btn-register:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 28px rgba(0, 212, 255, 0.3);
            }

            .btn-register:active {
                transform: translateY(0);
            }

            .signin-section {
                text-align: center;
                margin-top: 18px;
                padding-top: 18px;
                border-top: 1px solid rgba(0, 212, 255, 0.12);
            }

            .signin-text {
                color: #a0aec0;
                font-size: 0.88rem;
            }

            .signin-link {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 600;
            }

            .signin-link:hover {
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
                    padding-bottom: 28px;
                }
            }

            @media (max-width: 600px) {
                body {
                    overflow: auto;
                }

                .auth-shell {
                    width: min(92vw, 460px);
                    margin: 28px 0;
                }

                .welcome-panel,
                .form-panel {
                    padding: 30px 20px;
                }

                .form-row {
                    grid-template-columns: 1fr;
                    gap: 0;
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
                    <h1>Get started with a better property management experience.</h1>
                    <p>Create your account to organize tenants, track payments, manage leases, and keep every maintenance request in one place.</p>
                </div>

                <div class="welcome-badges">
                    <span>Fast setup</span>
                    <span>Secure access</span>
                    <span>Smart controls</span>
                </div>
            </aside>

            <main class="form-panel">
                <div class="register-card">
                    <div class="logo">
                        <div class="logo-icon">🏠</div>
                        <div class="logo-text">Flat Master</div>
                    </div>

                    <div class="heading">
                        <h2>Create Account</h2>
                        <p>Join us and manage your properties with ease</p>
                    </div>

                    @if ($errors->any())
                        <div class="error-message">
                            Please fix the errors below
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="First Name"
                                    required
                                    autofocus
                                    class="@error('first_name') field-error @enderror"
                                >
                                @error('first_name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Last Name"
                                    required
                                    class="@error('last_name') field-error @enderror"
                                >
                                @error('last_name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                                class="@error('email') field-error @enderror"
                            >
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number (Optional)</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+254-700-000-000"
                                class="@error('phone') field-error @enderror"
                            >
                            @error('phone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                class="@error('password') field-error @enderror"
                            >
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="password-requirements d-none d-md-none">
                            <div class="requirements-title">Password must include:</div>
                            <div class="requirement-item">
                                <div class="check-icon" id="length-check">✓</div>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="requirement-item">
                                <div class="check-icon" id="uppercase-check">✓</div>
                                <span>At least one uppercase letter</span>
                            </div>
                            <div class="requirement-item">
                                <div class="check-icon" id="lowercase-check">✓</div>
                                <span>At least one lowercase letter</span>
                            </div>
                            <div class="requirement-item">
                                <div class="check-icon" id="number-check">✓</div>
                                <span>At least one number</span>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required
                                class="@error('password_confirmation') field-error @enderror"
                            >
                            @error('password_confirmation')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="checkbox-group">
                            <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                required
                                class="@error('terms') field-error @enderror"
                            >
                            <label for="terms" class="checkbox-text">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        @error('terms')
                            <span class="error-text" style="display: block; margin-bottom: 15px;">{{ $message }}</span>
                        @enderror

                        <button type="submit" class="btn-register">Create Account</button>
                    </form>

                    <div class="signin-section">
                        <p class="signin-text">
                            Already have an account?
                            <a href="{{ route('login') }}" class="signin-link">Sign in here</a>
                        </p>
                    </div>
                </div>
            </main>
        </div>

        <script>
            const passwordInput = document.getElementById('password');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;

                    const lengthCheck = document.getElementById('length-check');
                    if (password.length >= 8) {
                        lengthCheck.classList.add('active');
                    } else {
                        lengthCheck.classList.remove('active');
                    }

                    const uppercaseCheck = document.getElementById('uppercase-check');
                    if (/[A-Z]/.test(password)) {
                        uppercaseCheck.classList.add('active');
                    } else {
                        uppercaseCheck.classList.remove('active');
                    }

                    const lowercaseCheck = document.getElementById('lowercase-check');
                    if (/[a-z]/.test(password)) {
                        lowercaseCheck.classList.add('active');
                    } else {
                        lowercaseCheck.classList.remove('active');
                    }

                    const numberCheck = document.getElementById('number-check');
                    if (/[0-9]/.test(password)) {
                        numberCheck.classList.add('active');
                    } else {
                        numberCheck.classList.remove('active');
                    }
                });
            }
        </script>
    </body>
</html>
