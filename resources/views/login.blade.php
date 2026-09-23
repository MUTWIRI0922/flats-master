@extends('layouts.app')
@section('title', 'Login')
@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    @keyframes float {

        0%,
        100% {
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
        width: 100%;
        min-height: 100vh;
        border-radius: 0;
        overflow: hidden;
        backdrop-filter: blur(12px);
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

        padding: 54px 44px;
        background: #0066FF;

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
        border-radius: 10px;
        background: rgba(0, 212, 255, 0.1);
        border: 1px solid rgba(0, 212, 255, 0.2);
        color: #f5f9fa;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .form-panel {
        width: 100%;
        padding: 52px 42px;
        align-items: center;
        justify-content: center;
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
        background-clip: text;
    }

    .heading {
        text-align: center;
        margin-bottom: 26px;
    }

    .heading h2 {
        font-size: 1.8rem;
        margin-bottom: 8px;
    }

    .heading p {
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label,
    .checkbox-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #0a0a0a;
        letter-spacing: 0.06em;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 14px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid #353838;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        background: rgba(202, 208, 209, 0.04);
        border-color: #353838;
        box-shadow: 0 0 0 3px rgba(131, 132, 133, 0.12);
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
        accent-color: #0066FF;
    }

    .checkbox-label {

        margin: 0;
        cursor: pointer;
        text-transform: none;
        letter-spacing: normal;
    }

    .forgot-password {
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 14px 16px;
        border: none;
        border-radius: 10px;
        font-size: 0.96rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;

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

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }

    .signup-section {
        text-align: center;
        margin-top: 22px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 212, 255, 0.12);
    }

    .signup-text {
        color: #36383a;
        font-size: 0.9rem;
    }

    .signup-link {
        text-decoration: none;
        font-weight: 600;
    }

    .signup-link:hover {
        text-decoration: underline;
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

<div class="auth-shell row">
    <aside class="welcome-panel col-md-5 d-md-flex d-none ">
        <div class="brand">
            <!-- <div class="brand-mark"></div> -->
            <span>Flat Master</span>
        </div>

        <div class="welcome-copy">
            <h1>Manage your property smarter</h1>
            <p>Track leases, payments, maintenance requests, and tenant activity from one secure dashboard built for modern property management.</p>
        </div>

        <div class="welcome-badges">
            <span>Secure access</span>
            <span>Simple billing</span>
            <span>Tenant insights</span>
        </div>
    </aside>

    <div class="col-md-6 d-md-flex ">
        <main class="form-panel align-items-center justify-content-center">
            <div class="login-card">
                <div class="logo">
                    <h3 class="logo-text text-primary">Welcome back</h3>
                </div>

                <div class="heading">
                    <p class="text-muted">Sign in to your account to continue</p>
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
                            autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required>
                    </div>

                    <div class="form-options">
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember" class="checkbox-label">Remember me</label>
                        </div>

                        <a href="" class="forgot-password">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-login btn-primary">Sign In</button>
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

</div>
@endsection