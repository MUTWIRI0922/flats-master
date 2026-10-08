@extends('layouts.app')
@section('title', 'Settings')
@section('content')
<style>
    .type-badge {
        --bs-bg-opacity: 0.1;
    }

    .stats-card {
        border-radius: 8px;
        --bs-bg-opacity: 0.1;
        padding: 3px;
    }

    .card-links {
        padding: 6px 12px;
        --bs-bg-opacity: 0.2;
        background-color: rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity));
        border-color: transparent;
        color: var(--bs-primary);
        font-size: 0.8rem;
    }

    .add-prop-card {
        --bs-bg-opacity: 0.7;
        color: var(--bs-primary);
    }

    .add-prop-card .card-body {
        margin: 30px;
        border: 2px dashed var(--bs-secondary);
        border-radius: 8px;
    }

    .card-img-top {
        height: 150px;
        object-fit: cover;
    }

    small {
        margin: 0;
    }

    .settings-notice {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #dce9ff;
        border-radius: 12px;
        background: #f5f8ff;
        color: #52647d;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    .settings-notice i {
        margin-top: 1px;
        color: #3157a4;
        font-size: 1rem;
    }

    .settings-section {
        margin-bottom: 18px;
        padding: 22px;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 6px 20px rgba(31, 41, 55, 0.035);
    }

    .settings-section-header {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 18px;
    }

    .settings-section-icon {
        display: flex;
        flex: 0 0 40px;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #eef4ff;
        color: #3157a4;
        font-size: 1.05rem;
    }

    .settings-section-header h2 {
        margin: 0 0 4px;
        color: #202b3c;
        font-size: 0.98rem;
        font-weight: 700;
    }

    .settings-section-header p {
        margin: 0;
        color: #667085;
        font-size: 0.8rem;
        line-height: 1.5;
    }

    .settings-section .form-label {
        margin-bottom: 6px;
        color: #475467;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .settings-section .form-control,
    .settings-section .form-select {
        min-height: 40px;
        border-color: #dfe5ed;
        border-radius: 8px;
        font-size: 0.84rem;
    }

    .settings-section .form-text {
        color: #7a8699;
        font-size: 0.73rem;
    }

    .settings-save-button {
        margin-top: 18px;
    }

    .settings-save-button:disabled {
        border-color: #d9dee7;
        background: #eef1f5;
        color: #7a8699;
        cursor: not-allowed;
        opacity: 1;
    }

    .settings-channel-option {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        height: 100%;
        padding: 14px;
        border: 1px solid #e5eaf1;
        border-radius: 11px;
        background: #fbfcfe;
    }

    .settings-channel-option .form-check-input {
        flex: 0 0 auto;
        margin-top: 3px;
    }

    .settings-channel-option label {
        color: #27364b;
        font-size: 0.83rem;
        font-weight: 600;
    }

    .settings-channel-option small {
        display: block;
        margin-top: 3px;
        color: #7a8699;
        font-size: 0.73rem;
        font-weight: 400;
        line-height: 1.4;
    }

    .settings-color-field {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .settings-color-field input[type="color"] {
        flex: 0 0 48px;
        width: 48px;
        height: 40px;
        padding: 4px;
        cursor: pointer;
    }

    @media (max-width: 576px) {
        .settings-section {
            padding: 18px;
        }
    }
</style>
<div class="main-page">
    @include('user.sidebar')
    <main class="main-content">

        <header class="topbar">
            <h1 class="page-title">Settings</h1>

            <div class="profile">
                <div>
                    <a href=""><i class="bi bi-bell fs-4"></i></a>
                </div>
                <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </header>
        <section class="content">
            <div class="container-fluid">
                <!-- page header -->
                <div class="page-header">
                    <div class="">
                        <h5 class="title">Your Settings</h5>
                        <p class="subtitle">Manage your account settings and preferences.</p>
                    </div>
                    <!-- <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPropertyModal"><i class="bi bi-plus"></i>Add Property</a>
                    </div> -->
                </div>

                <section class="settings-section" aria-labelledby="password-settings-heading">
                    <div class="settings-section-header">
                        <span class="settings-section-icon"><i class="bi bi-shield-lock" aria-hidden="true"></i></span>
                        <div>
                            <h2 id="password-settings-heading">Password & security</h2>
                            <p>Update your password to help keep your account secure.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="current_password">Current password</label>
                            <input class="form-control" type="password" id="current_password" autocomplete="current-password" placeholder="Enter current password">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="new_password">New password</label>
                            <input class="form-control" type="password" id="new_password" autocomplete="new-password" placeholder="Enter new password">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="confirm_password">Confirm new password</label>
                            <input class="form-control" type="password" id="confirm_password" autocomplete="new-password" placeholder="Re-enter new password">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm settings-save-button" disabled><i class="bi bi-lock"></i> Save password (coming soon)</button>
                </section>

                <section class="settings-section" aria-labelledby="notification-settings-heading">
                    <div class="settings-section-header">
                        <span class="settings-section-icon"><i class="bi bi-bell" aria-hidden="true"></i></span>
                        <div>
                            <h2 id="notification-settings-heading">Notification preferences</h2>
                            <p>Choose how you would like to receive account and property updates.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="settings-channel-option">
                                <input class="form-check-input" type="checkbox" id="notify_email">
                                <label for="notify_email">
                                    Email notifications
                                    <small>Receive updates at the email address on your account.</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="settings-channel-option">
                                <input class="form-check-input" type="checkbox" id="notify_whatsapp">
                                <label for="notify_whatsapp">
                                    WhatsApp notifications
                                    <small>Receive updates through WhatsApp on your preferred number.</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="whatsapp_number">WhatsApp number</label>
                            <input class="form-control" type="tel" id="whatsapp_number" placeholder="+254 7XX XXX XXX">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm settings-save-button" disabled>Save preferences (coming soon)</button>
                </section>

                <section class="settings-section" aria-labelledby="bulk-message-settings-heading">
                    <div class="settings-section-header">
                        <span class="settings-section-icon"><i class="bi bi-chat-square-text" aria-hidden="true"></i></span>
                        <div>
                            <h2 id="bulk-message-settings-heading">Bulk messaging credentials</h2>
                            <p>Connect an SMS provider to send announcements and bulk messages.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="message_provider">Messaging provider</label>
                            <select class="form-select" id="message_provider">
                                <option value="" selected disabled>Select a provider</option>
                                <option value="africastalking">Africa's Talking</option>
                                <option value="twilio">Twilio</option>
                                <option value="other">Other provider</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="message_sender_id">Sender ID</label>
                            <input class="form-control" type="text" id="message_sender_id" placeholder="Your approved sender name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="message_api_key">API key / username</label>
                            <input class="form-control" type="text" id="message_api_key" placeholder="Enter messaging API key">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="message_api_secret">API secret</label>
                            <input class="form-control" type="password" id="message_api_secret" autocomplete="new-password" placeholder="Enter messaging API secret">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm settings-save-button" disabled>Save credentials (coming soon)</button>
                </section>

                <section class="settings-section" aria-labelledby="mpesa-settings-heading">
                    <div class="settings-section-header">
                        <span class="settings-section-icon"><i class="bi bi-wallet2" aria-hidden="true"></i></span>
                        <div>
                            <h2 id="mpesa-settings-heading">M-Pesa payment gateway</h2>
                            <p>Configure your Daraja API credentials for accepting M-Pesa payments.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_environment">Environment</label>
                            <select class="form-select" id="mpesa_environment">
                                <option value="sandbox" selected>Sandbox</option>
                                <option value="production">Production</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_shortcode">Business shortcode</label>
                            <input class="form-control" type="text" id="mpesa_shortcode" placeholder="e.g. 174379">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_consumer_key">Consumer key</label>
                            <input class="form-control" type="password" id="mpesa_consumer_key" autocomplete="new-password" placeholder="Enter Daraja consumer key">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_consumer_secret">Consumer secret</label>
                            <input class="form-control" type="password" id="mpesa_consumer_secret" autocomplete="new-password" placeholder="Enter Daraja consumer secret">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_passkey">Lipa Na M-Pesa passkey</label>
                            <input class="form-control" type="password" id="mpesa_passkey" autocomplete="new-password" placeholder="Enter Lipa Na M-Pesa passkey">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mpesa_callback_url">Callback URL</label>
                            <input class="form-control" type="url" id="mpesa_callback_url" placeholder="https://example.com/api/mpesa/callback">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm settings-save-button" disabled>Save gateway settings (coming soon)</button>
                </section>

                <section class="settings-section" aria-labelledby="brand-settings-heading">
                    <div class="settings-section-header">
                        <span class="settings-section-icon"><i class="bi bi-palette" aria-hidden="true"></i></span>
                        <div>
                            <h2 id="brand-settings-heading">Brand colors</h2>
                            <p>Choose the colors used to represent your business across the platform.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="brand_primary_color">Primary brand color</label>
                            <div class="settings-color-field">
                                <input class="form-control form-control-color" type="color" id="brand_primary_color" value="#3157a4" aria-label="Choose primary brand color">
                                <input class="form-control" type="text" placeholder="#3157A4" aria-label="Primary brand color hex value">
                            </div>
                            <div class="form-text">Used for primary buttons and key highlights.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="brand_accent_color">Accent color</label>
                            <div class="settings-color-field">
                                <input class="form-control form-control-color" type="color" id="brand_accent_color" value="#25a18e" aria-label="Choose accent color">
                                <input class="form-control" type="text" placeholder="#25A18E" aria-label="Accent color hex value">
                            </div>
                            <div class="form-text">Used for secondary highlights and status accents.</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm settings-save-button" disabled>Save brand colors (coming soon)</button>
                </section>

            </div>

        </section>
    </main>
</div>
@endsection