@extends('layouts.app')
@section('title', 'Profile')
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

    .profile-overview {
        overflow: hidden;
        border: 1px solid #e8edf3;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(31, 41, 55, 0.05);
    }

    .profile-banner {
        min-height: 116px;
        background: linear-gradient(120deg, #e8f1ff 0%, #f4f0ff 55%, #f9fbff 100%);
    }

    .profile-overview-body {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        padding: 0 28px 24px;
    }

    .profile-identity {
        display: flex;
        align-items: flex-end;
        gap: 18px;
        min-width: 0;
        margin-top: -42px;
    }

    .profile-avatar {
        display: flex;
        flex: 0 0 92px;
        align-items: center;
        justify-content: center;
        width: 92px;
        height: 92px;
        overflow: hidden;
        border: 5px solid #fff;
        border-radius: 50%;
        background: #3157a4;
        color: #fff;
        font-size: 1.65rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(31, 41, 55, 0.12);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-identity-copy {
        min-width: 0;
        padding-bottom: 5px;
    }

    .profile-identity-copy h2 {
        margin: 0 0 5px;
        color: #182230;
        font-size: 1.35rem;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .profile-identity-copy p {
        margin: 0;
        color: #667085;
        font-size: 0.9rem;
        overflow-wrap: anywhere;
    }

    .profile-account-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 5px;
        padding: 7px 11px;
        border-radius: 999px;
        background: #eef4ff;
        color: #3157a4;
        font-size: 0.78rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .profile-details-card {
        height: 100%;
        padding: 22px;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        background: #fff;
    }

    .profile-details-card h3 {
        margin: 0 0 18px;
        color: #182230;
        font-size: 0.98rem;
        font-weight: 700;
    }

    .profile-detail {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 14px 0;
        border-top: 1px solid #eef1f5;
    }

    .profile-detail:first-of-type {
        padding-top: 0;
        border-top: 0;
    }

    .profile-detail-icon {
        display: flex;
        flex: 0 0 36px;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f2f5fa;
        color: #52647d;
        font-size: 1rem;
    }

    .profile-detail-label {
        display: block;
        margin-bottom: 3px;
        color: #667085;
        font-size: 0.76rem;
    }

    .profile-detail-value {
        display: block;
        color: #202b3c;
        font-size: 0.9rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .profile-account-note {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        height: 100%;
        padding: 20px;
        border: 1px solid #dce9ff;
        border-radius: 14px;
        background: #f5f8ff;
        color: #3157a4;
    }

    .profile-account-note i {
        margin-top: 2px;
        font-size: 1.15rem;
    }

    .profile-account-note strong {
        display: block;
        margin-bottom: 5px;
        color: #243f77;
        font-size: 0.88rem;
    }

    .profile-account-note p {
        margin: 0;
        color: #5f6f8d;
        font-size: 0.8rem;
        line-height: 1.5;
    }

    @media (max-width: 576px) {
        .profile-overview-body {
            align-items: flex-start;
            flex-direction: column;
            gap: 16px;
            padding: 0 18px 20px;
        }

        .profile-identity {
            align-items: center;
            gap: 12px;
            margin-top: -34px;
        }

        .profile-avatar {
            flex-basis: 76px;
            width: 76px;
            height: 76px;
            font-size: 1.35rem;
        }

        .profile-identity-copy h2 {
            font-size: 1.12rem;
        }
    }
</style>
<div class="main-page">
    @include('user.sidebar')
    <main class="main-content">

        <header class="topbar">
            <h1 class="page-title"></h1>

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
                        <h5 class="title">Your Profile</h5>
                        <p class="subtitle">Manage your profile information and preferences.</p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPropertyModal"><i class="bi bi-pencil"></i> Edit Profile</a>
                    </div>
                </div>
<!-- user profile details -->
                <div class="profile-overview mb-4">
                    <div class="profile-banner"></div>
                    <div class="profile-overview-body">
                        <div class="profile-identity">
                            <div class="profile-avatar" aria-label=" profile picture">
                                @if ($user->profile_photo_url ?? false)
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $profileName }}">
                                    <i class="bi bi-camera"></i>
                                @else
                                    {{ $profileInitials ?? 'UN' }}
                                @endif
                            </div>
                            <div class="profile-identity-copy">
                                <h2>{{ $profileName ?? 'User Name' }}</h2>
                                <p>{{ $user->email ?? 'Email not specified' }}</p>
                            </div>
                        </div>
                        <span class="profile-account-type">
                            <i class="bi bi-person-badge" aria-hidden="true"></i>
                            {{ $accountType ?? 'Account type not specified' }}
                        </span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-8">
                        <section class="profile-details-card" aria-labelledby="profile-details-heading">
                            <h3 id="profile-details-heading">Personal information</h3>
                            <div class="profile-detail">
                                <span class="profile-detail-icon"><i class="bi bi-person" aria-hidden="true"></i></span>
                                <div>
                                    <span class="profile-detail-label">Full name</span>
                                    <span class="profile-detail-value">{{ $profileName ?? 'User Name' }}</span>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <span class="profile-detail-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                                <div>
                                    <span class="profile-detail-label">Email address</span>
                                    <span class="profile-detail-value">{{ $user->email ?? 'Email not specified' }}</span>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <span class="profile-detail-icon"><i class="bi bi-telephone" aria-hidden="true"></i></span>
                                <div>
                                    <span class="profile-detail-label">Phone number</span>
                                    <span class="profile-detail-value">{{ $user->phone ?? 'Not provided' }}</span>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <span class="profile-detail-icon"><i class="bi bi-calendar3" aria-hidden="true"></i></span>
                                <div>
                                    <span class="profile-detail-label">Member since</span>
                                    <span class="profile-detail-value">today</span>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-4">
                        <aside class="profile-account-note">
                            <i class="bi bi-shield-check" aria-hidden="true"></i>
                            <div>
                                <strong>Account details</strong>
                                <p>This is the personal information associated with your account.</p>
                            </div>
                        </aside>
                    </div>
                </div>

            </div>

        </section>
    </main>
</div>
@endsection