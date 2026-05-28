@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="settings">
                <h5>Settings</h5>
                <section id="notification-preferences">
                    <div class="card p-3 mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Notification Preferences <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Manage your notification preferences"></i></p>
                            </div>
                            <div>
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#notificationPreferencesCollapse" aria-expanded="false" aria-controls="notificationPreferencesCollapse">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="notificationPreferencesCollapse">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="emailNotifications" checked>
                                <label class="form-check-label" for="emailNotifications">
                                    Email Notifications 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="smsNotifications">
                                <label class="form-check-label" for="smsNotifications">
                                    SMS Notifications
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="pushNotifications" checked>
                                <label class="form-check-label" for="pushNotifications">
                                    Push Notifications
                                </label>
                            </div>
                            <button class="btn btn-primary mt-3">Save Preferences</button>
                            
                        </div>
                    </div>
                </section>
                <section id="Payment-Settings">
                    <div class="card p-3 mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Payment Settings <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Manage your payment settings"></i></p>
                            </div>
                            <div>
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#paymentSettingsCollapse" aria-expanded="false" aria-controls="paymentSettingsCollapse">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body collapse" id="paymentSettingsCollapse">
                            <form method="POST" action="">
                                @csrf
                                <h5>Main Daraja API Credentials</h5>
                                <div class="form-group mt-3">
                                    <label for="shortcode">Shortcode</label>
                                    <input type="text" class="form-control" id="shortcode" name="shortcode" >
                                </div>
                                <div class="form-group mt-3">
                                    <label for="callbackUrl">Callback URL</label>
                                    <input type="text" class="form-control" id="callbackUrl" name="callbackUrl" >
                                </div>
                                <div class="form-group mt-3">
                                    <label for="consumerKey">Consumer Key</label>
                                    <input type="text" class="form-control" id="consumerKey" name="consumerKey" >
                                </div>
                                <div class="form-group mt-3">
                                    <label for="consumerSecret">Consumer Secret</label>
                                    <input type="text" class="form-control" id="consumerSecret" name="consumerSecret" >
                                </div>
                                <div class="form-group mt-3">
                                    <label for="passkey">Passkey</label>
                                    <input type="text" class="form-control" id="passkey" name="passkey" >
                                </div>
                                <div class="">
                                    <label for="environment">Environment</label>
                                    <select class="form-control" id="environment" name="environment">
                                        <option value="sandbox">Sandbox</option>
                                        <option value="production">Production</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </div>


@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle notification preferences collapse
        const notificationCollapse = document.getElementById('notificationPreferencesCollapse');
        const notificationButton = notificationCollapse.previousElementSibling.querySelector('button');
        
        notificationCollapse.addEventListener('show.bs.collapse', function() {
            notificationButton.querySelector('i').classList.remove('bi-chevron-down');
            notificationButton.querySelector('i').classList.add('bi-chevron-up');
        });
        
        notificationCollapse.addEventListener('hide.bs.collapse', function() {
            notificationButton.querySelector('i').classList.remove('bi-chevron-up');
            notificationButton.querySelector('i').classList.add('bi-chevron-down');
        });

        // Handle payment settings collapse
        const paymentCollapse = document.getElementById('paymentSettingsCollapse');
        const paymentButton = paymentCollapse.previousElementSibling.querySelector('button');
        
        paymentCollapse.addEventListener('show.bs.collapse', function() {
            paymentButton.querySelector('i').classList.remove('bi-chevron-down');
            paymentButton.querySelector('i').classList.add('bi-chevron-up');
        });
        
        paymentCollapse.addEventListener('hide.bs.collapse', function() {
            paymentButton.querySelector('i').classList.remove('bi-chevron-up');
            paymentButton.querySelector('i').classList.add('bi-chevron-down');
        });
    });
</script>
