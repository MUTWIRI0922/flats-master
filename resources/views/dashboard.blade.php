@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .row {
            margin-bottom: 20px;
        }

        .col-md-4 {
            padding-right: 0;
        }

        .col-md-8 {
            padding-left: 0;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <nav>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="">Dashboard</a></li>
                        <li class="list-group-item"><a href="">Profile</a></li>
                        <li class="list-group-item"><a href="">Orders</a></li>
                        <li class="list-group-item"><a href="">Settings</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8">
                <h1 class="mb-4">Welcome to Your Dashboard</h1>
                <p class="lead">Here you can manage your account and view your orders.</p>
            </div>
        </div>
    </div>

@endsection