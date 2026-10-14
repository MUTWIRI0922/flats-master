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
                        <h5 class="title">All tenants</h5>
                        <p class="subtitle">Tenants currently under your management.</p>
                    </div>
                    <div class="page-controls">
                        <a href="{{route('tenants.create', ['owner_id' => Auth::id()])}}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i>Add Tenant</a>
                    </div>
                </div>
                @if (session('success'))
                <div class="alert alert-success error-message">
                    {{ session('success') }}
                </div>
                @endif         

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                                    <th scope="col">Actions</th>
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
                                        <td>
                                            <a href="{{ route('user.tenant.edit', $tenant->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('user.tenant.show', $tenant->id) }}" class="btn btn-sm btn-info">View</a>
                                            <!-- <form action="{{ route('user.tenant.destroy', $tenant->id) }}" method="POST" style="display: inline;">
                                                @csrf   
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm
                                                ('Are you sure you want to delete this tenant?')">Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No tenants found yet.</td>
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