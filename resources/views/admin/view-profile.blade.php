@extends('layouts.admin')
@section('title', 'View Profile')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="view-profile">
                <h5>View Profile</h5>
                <br>
                    <p><strong>Name:</strong><br></p>
                    <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                    <p><strong>Email:</strong><br> {{ $user->email }}</p>
                    <p><strong>Phone:</strong><br> {{ $user->phone }}</p>
                    <p><strong>Role:</strong><br> {{ $user->roles->first()?->name ?? 'No Role' }}</p>
                    <p><strong>Joined Date:</strong><br> {{ $user->created_at->format('Y-m-d') }}</p>
                <div>
                    <a href="{{ route('admin.profileedit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
                </div>
            </section>
        </main>

    </div>