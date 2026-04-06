@extends('layouts.app')
@section('content')
    <style>
            .dashboard-wrapper {
                display: flex;
                height: 100vh;
                overflow: hidden;
            }


            .dashboard-main {
                flex: 1;
                overflow-y: auto;
                padding: 20px;
                background: #fff;
            }

            .dashboard-main h1,
            .dashboard-main p {
                margin: 0 0 12px;
            }

            .col-md-4,
            .col-md-8 {
                padding: 0;
            }

            .reports:not(.btn) {
                width: 90%;
                border-collapse: collapse;
            }
    </style>
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

@endsection