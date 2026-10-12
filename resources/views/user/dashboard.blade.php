@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <style>

        .card small{
            font-size: 0.6rem;
            margin:0;
        }
        .metric-badge {
            --bs-bg-opacity: 0.1;
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
                    <div class="page-header">
                        <div>
                            <h5 class="title">Welcome to Your Dashboard, {{ Auth::user()->name }}!</h5>
                            <p class="subtitle">Here you see what's happening in your properties.</p>
                        </div>
                        <div class="page-controls">
                            <a href="" class="btn btn-primary btn-sm">View Profile</a>
                            <a href="" class="btn btn-light btn-outline-primary btn-sm">View Reports</a>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <i class="bi bi-people text-primary fs-4"></i>
                                    <span class="badge rounded-pill metric-badge {{ $tenantspercentageChange === null || $tenantspercentageChange >= 0 ? 'bg-success text-success' : 'bg-danger text-danger' }}">
                                        {{ $tenantspercentageChange === null ? 'New' : (($tenantspercentageChange > 0 ? '+' : '') . number_format($tenantspercentageChange, 1) . '%') }}
                                    </span>
                                </div>
                                <h5 class="mb-0">{{$tenantscount}}</h5>
                                <h6 class="mb-2"><small>Tenants Housed This Month</small></h6>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <i class="bi bi-cash-coin text-primary fs-4 "></i>
                                    <span class="badge bg-danger rounded-pill metric-badge text-danger">5%</span>
                                </div>
                                <h5 class="mb-0">{{$totalmonthlyrevenue}}</h5>
                                <h6 class="mb-2 text-muted"><small>Monthly Rent Collection</small></h6>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                                    <span class="badge bg-danger rounded-pill metric-badge text-danger">3%</span>
                                </div>
                                <h5 class="mb-0">KShs 12,500</h5>
                                <h6 class="mb-2 text-muted"><small>Rent Arrears</small></h6>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <i class="bi bi-buildings text-primary fs-4 "></i>
                                    <span class="badge bg-danger rounded-pill metric-badge text-danger">7%</span>
                                </div>
                                <h5 class="mb-0">{{$listedproperties}}</h5>
                                <h6 class="mb-2 text-muted"><small>Properties</small></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-7 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <div>
                                    <h5 class="mb-0">Rent Collection Overview</h5>
                                    <small class="text-muted">Since January 2026</small>
                                </div>

                                <div class="rent-chart">
                                    <canvas id="rentCollectionChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-4">
                            <div class="card bg-white p-3 shadow-sm h-100">
                                <h5 class="mb-0">Maintenance Tickets</h5>
                                <ul class="list-group list-group-flush mt-3">
                                    @forelse($activeTickets as $ticket)
                                    <li class="list-group-item d-flex align-items-center justify-content-between mb-2">
                                        <div class="">
                                            <p class="mb-0 mt-0">{{$activeTickets->title}}</p>
                                            <small>{{$activeTickets->lease->unit->property->name}}, {{$activeTickets->lease->unit->unit_number}}</small>
                                        </div>

                                        <span class="badge bg-primary">Open</span>
                                    </li>
                                    @empty
                                    <li class="list-group-item text-center">No pending tickets.</li>
                                    @endforelse
                                </ul>
                            </div>
                    </div>
                    <div class="mb-4">
                        <div class="card bg-white p-3 shadow-sm h-100">
                            <h5>Recent Payments</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th>Tenant</th>
                                            <th>Property</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentPayments as $payment)
                                        <tr>
                                            <td>{{ $payment->lease->tenant->first_name }} {{ $payment->lease->tenant->last_name }}</td>
                                            <td>{{ $payment->lease->property->address }}</td>
                                            <td>KShs {{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No recent payments found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

@endsection