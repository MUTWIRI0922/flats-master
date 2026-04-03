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
                padding: 0px 20px;
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
                z-index: 10001;
                width: 60%;

                padding: 40px 20px;
                margin: auto;
            }

            .register-card {
                background: rgba(26, 31, 58, 0.7);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 16px;
                padding: 50px 40px;
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
                margin-bottom: 25px;
            }

            .logo-icon {
                font-size: 2.5rem;
                margin-bottom: 12px;
            }

            .logo-text {
                font-size: 1.3rem;
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
                margin-bottom: 18px;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .form-row .form-group {
                margin-bottom: 0;
            }

            label {
                display: block;
                color: #cbd5e0;
                font-size: 0.85rem;
                font-weight: 500;
                margin-bottom: 8px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px 16px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.2);
                border-radius: 8px;
                color: #ffffff;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                background: rgba(0, 212, 255, 0.05);
                border-color: #00d4ff;
                box-shadow: 0 0 12px rgba(0, 212, 255, 0.2);
            }

            input[type="text"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder {
                color: #718096;
            }

            /* Error Messages */
            .error-message {
                background: rgba(245, 101, 101, 0.1);
                border: 1px solid rgba(245, 101, 101, 0.3);
                color: #ff6b6b;
                padding: 12px 16px;
                border-radius: 8px;
                font-size: 0.85rem;
                margin-bottom: 20px;
                animation: shake 0.3s ease;
            }

            .field-error {
                border-color: #ff6b6b !important;
                background: rgba(255, 107, 107, 0.05) !important;
            }

            .error-text {
                color: #ff6b6b;
                font-size: 0.8rem;
                margin-top: 5px;
                display: block;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }

            /* Password Requirements */
            .password-requirements {
                background: rgba(0, 212, 255, 0.05);
                border: 1px solid rgba(0, 212, 255, 0.1);
                border-radius: 8px;
                padding: 15px;
                margin-top: 15px;
                margin-bottom: 20px;
            }

            .requirements-title {
                color: #00d4ff;
                font-size: 0.8rem;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 10px;
                letter-spacing: 0.5px;
            }

            .requirement-item {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #cbd5e0;
                font-size: 0.85rem;
                margin-bottom: 6px;
            }

            .requirement-item:last-child {
                margin-bottom: 0;
            }

            .check-icon {
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: rgba(0, 212, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem;
                flex-shrink: 0;
            }

            .check-icon.active {
                background: #00d4ff;
                color: #0a0e27;
            }

            /* Checkbox */
            .checkbox-group {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-bottom: 25px;
            }

            input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #00d4ff;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .checkbox-text {
                color: #a0aec0;
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .checkbox-text a {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .checkbox-text a:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            /* Button */
            .btn-register {
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

            .btn-register:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
            }

            .btn-register:active {
                transform: translateY(-1px);
            }

            .btn-register:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                transform: none;
            }

            /* Sign In Link */
            .signin-section {
                text-align: center;
                margin-top: 25px;
                padding-top: 25px;
                border-top: 1px solid rgba(0, 212, 255, 0.1);
            }

            .signin-text {
                color: #a0aec0;
                font-size: 0.9rem;
            }

            .signin-link {
                color: #00d4ff;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .signin-link:hover {
                color: #00f4ff;
                text-decoration: underline;
            }

            /* Responsive */
            @media (max-width: 600px) {
                .container {
                    padding: 20px;
                }

                .register-card {
                    padding: 35px 25px;
                }

                .heading h2 {
                    font-size: 1.3rem;
                }

                .form-row {
                    grid-template-columns: 1fr;
                    gap: 0;
                }

                .form-row .form-group {
                    margin-bottom: 18px;
                }

                .checkbox-text {
                    font-size: 0.8rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Animated background elements -->
        <div class="bg-element bg-element-1"></div>
        <div class="bg-element bg-element-2"></div>

        <!-- Main Container -->
        <div class="container ">
            <div class="register-card">
                <!-- Logo -->
                <div class="logo">
                    <div class="logo-icon">🏠</div>
                    <div class="logo-text">Flat Master</div>
                </div>

                <!-- Heading -->
                <div class="heading">
                    <h2>Create Account</h2>
                    <p>Join us and manage your properties with ease</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-message">
                        Please fix the errors below
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name Row -->
                    <div class="form-row">
                        <!-- First Name -->
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

                        <!-- Last Name -->
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
                            class="@error('email') field-error @enderror"
                        >
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Input (Optional) -->
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

                    <!-- Password Input -->
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

                    <!-- Password Requirements -->
                    <div class="password-requirements">
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
                    </div>

                    <!-- Confirm Password -->
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

                    <!-- Terms Checkbox -->
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

                    <!-- Register Button -->
                    <button type="submit" class="btn-register">Create Account</button>
                </form>

                <!-- Sign In Link -->
                <div class="signin-section">
                    <p class="signin-text">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="signin-link">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Password Validation Script -->
        <script>
            const passwordInput = document.getElementById('password');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;

                    // Check length
                    const lengthCheck = document.getElementById('length-check');
                    if (password.length >= 8) {
                        lengthCheck.classList.add('active');
                    } else {
                        lengthCheck.classList.remove('active');
                    }

                    // Check uppercase
                    const uppercaseCheck = document.getElementById('uppercase-check');
                    if (/[A-Z]/.test(password)) {
                        uppercaseCheck.classList.add('active');
                    } else {
                        uppercaseCheck.classList.remove('active');
                    }

                    // Check lowercase
                    const lowercaseCheck = document.getElementById('lowercase-check');
                    if (/[a-z]/.test(password)) {
                        lowercaseCheck.classList.add('active');
                    } else {
                        lowercaseCheck.classList.remove('active');
                    }

                    // Check number
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
