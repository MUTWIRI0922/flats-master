@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="password-reset">
                <h5>Password Reset</h5>
                <div class="card p-3 mb-4">
                    <form action="">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" >
                        </div>  
                        <div class="form-group mt-3">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" >
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" >
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
@endsection