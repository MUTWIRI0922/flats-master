@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="settings">
                <h5>Settings</h5>
                <div class="card p-3 mb-4">
                    <p>Notification Preferences</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="emailNotifications" checked>
                        <label class="form-check-label" for="emailNotifications">
                            Email Notifications 
                        </label>
                    </div>
                </div>

            </section>
        </main>
    </div>


@endsection