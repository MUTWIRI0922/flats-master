@extends('layouts.app')
@section('title', 'Flats Master - My Units')
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
                        <h5 class="title">Units at {{ $property->name }}</h5>
                        <p class="subtitle">List of units available for this property.</p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUnitModal"><i class="bi bi-plus"></i>Add Unit</a>
                        <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#excelUploadModal"><i class="bi bi-plus"></i>Excel Upload</a>                        
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

                <!-- units table -->
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Unit Number</th>
                                    <th scope="col">Rent</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $unit)
                                    <tr>
                                        <td>{{$unit->unit_number}}</td>
                                        <td>{{$unit->rent_amount}}</td>
                                        <td>{{$unit->unit_class}}</td>
                                        <td>{{$unit->status}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No units found for this property.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $units->links() }}
                    </div>
                    
                </div>
            </div>
        </section>
        @include('user.properties.addunit')
        @include('user.properties.excelupload')
    </main>
</div>
@endsection