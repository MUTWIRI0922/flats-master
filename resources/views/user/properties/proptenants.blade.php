@extends('layouts.app')
@section('title', 'Flats Master - My Tenants')
@section('content')
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
                    <div>
                        <h5 class="title">Tenants at {{ $property->name }}</h5>
                        <p class="subtitle">Tenants currently associated with this property's units.</p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i>Add Tenant</a>
                    </div>
                </div>


                <!-- tenants table -->
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Lease start</th>
                                    <th scope="col">Rent status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tenants as $tenant)
                                    @php($lease = $tenant->leases->first())
                                    <tr>
                                        <td>{{ $tenant->first_name }} {{ $tenant->last_name }}</td>
                                        <td>{{ $tenant->phone }}</td>
                                        <td>{{ $lease?->unit?->unit_number ?? '—' }}</td>
                                        <td>{{ $lease?->start_date ?? '—' }}</td>
                                        <td>{{ $lease?->status ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No tenants found for this property.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection