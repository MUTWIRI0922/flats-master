@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
            background: #f7f8fa;
        }


        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: #4117ff;
            border-bottom: 1px solid #e9ecef;
        }

        .page-title {
            font-size: 1.125rem;
            margin: 0;
            color: #111827;
            font-weight: 700;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
        }

        .profile-name {
            font-weight: 600;
            color: #111827;
        }

        .content {
            padding: 24px;
            flex: 1;
            background: transparent;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .dashboard { flex-direction: column; }
            .main-content { min-height: auto; }
            .topbar { padding: 0 12px; }
        }
    </style>

    <div class="dashboard">
        @include('user.sidebar')

        <main class="main-content">
            <header class="topbar">
                <h1 class="page-title text-white">Dashboard</h1>

                <div class="profile">
                    <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                    <div class="profile-name text-white">{{ Auth::user()->name ?? 'User' }}</div>
                </div>
            </header>

            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col">
                            <h2>Welcome to Your Dashboard</h2>
                            <p class="lead">Here you can manage your account and view your orders.</p>
                        </div>
                    </div>
                    <!-- Add dashboard widgets here -->
                </div>
            </section>
        </main>
    </div>

@endsection