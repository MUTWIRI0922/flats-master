@extends('layouts.app')
@section('title', 'My Properties')
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
                        <h5 class="title">My uploaded properties</h5>
                        <p class="subtitle">Here are your uploaded properties, with their details.</p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPropertyModal"><i class="bi bi-plus"></i>Add Property</a>
                    </div>
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
                <div>
                    <div class="property-cards">
                        <div class="row">

                            @forelse($properties as $property)
                            <div class="col-md-4 mb-4">
                                <div class="card bg-white h-100 shadow-sm">
                                    <img src="{{ asset('images/property-placeholder.jpg') }}" class="card-img-top" alt="Property Image">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <p class="mb-0 mt-0">{{$property->name}}</p>
                                                <small class="text-muted">{{$property->location}}</small>
                                            </div>

                                            <span class="badge bg-primary text-primary type-badge rounded-pill">{{$property->type}} </span>
                                        </div>
                                        <div class=" row d-flex align-items-center justify-content-between gap-2 mb-2">
                                            <div class="col stats-card bg-secondary d-flex flex-column align-items-center text-center">

                                                <h5 class="mb-0 mt-0">{{$property->units->count()}}</h5>
                                                <small>Total units</small>

                                            </div>
                                            <div class="col stats-card bg-primary d-flex flex-column align-items-center text-center">
                                                
                                                <h5 class="mb-0 mt-0">{{$property->units->where('status', 'occupied')->count()}}</h5>
                                                <small>Occupied Units</small>
                                                
                                            </div>
                                            <div class="col stats-card bg-secondary d-flex flex-column align-items-center text-center">

                                                <h5 class="mb-0 mt-0">{{$property->units->where('status', 'available')->count()}}</h5>
                                                <small>Vacant Units</small>

                                            </div>
                                        </div>
                                        @php
                                            $occupiedUnits = $property->units->where('status', 'occupied')->count();
                                            $totalUnits = $property->units->count();
                                            $occupancyRate = $totalUnits > 0 ? ($occupiedUnits / $totalUnits) * 100 : 0;
                                        @endphp
                                        <div class="occupancy-rate">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <p class="mb-0 mt-0">Occupancy Rate</p>
                                                <small class="text-muted">{{ $occupancyRate }}%</small>
                                            </div>
                                            <div class="progress mb-3" style="height: 6px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $occupancyRate }}%;" aria-valuenow="{{ $occupancyRate }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class=" row d-flex align-items-center justify-content-between mb-2 gap-2">

                                            <a href="{{ route('user.property.tenants', $property->id) }}" class="col btn btn-primary card-links">view tenants</a>
                                            <a href="{{ route('user.property.units', $property->id) }}" class="col btn btn-light  ">view units</a>
                                            <a href="" class="col btn btn-primary card-links" data-bs-toggle="modal" data-bs-target="#editPropertyModal">Edit Property</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p class="col-md-4">No Properties</p>
                            @endforelse
                            <div class="col-md-4 mb-4">
                                <div class="card add-prop-card h-100">
                                    <div class="card-body h-100">
                                        <a href="" class="d-flex flex-column align-items-center justify-content-center h-100 text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#addPropertyModal">
                                            <i class="bi bi-plus fs-1 mb-2"></i>
                                            <p class="mb-0">Add New Property</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @include('user.properties.add')
                @if($properties->isNotEmpty())
                    @include('user.properties.edit')
                @endif
            </div>

        </section>
    </main>
</div>
@endsection