@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <p>Welcome to the Admin Dashboard</p>
            <section id="dashboard-content">
                <div class="cards row">
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Total Users</h5>
                            <p class="display-4">{{ $userscount }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Active Subscriptions</h5>
                            <p class="display-4">{{ $activesubscriptionscount ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Expired Subscriptions</h5>
                            <p class="display-4">{{ $expiredsubscriptionscount ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Total Revenue</h5>
                            <p class="display-4">{{ $totalrevenue ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Listed Properties</h5>
                            <p class="display-4">{{ $listedpropertiescount ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="reports">
                    <h5>Recent User Signups</h5>
                    <div class="card p-3 mb-4">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Signup Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentsignups as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No recent signups.</td>
                                        </tr>
                                    @endforelse

                            </tbody>

                        </table>
                        <a href="" class="btn btn-primary w-auto">View all users</a>
                    </div>
                    <h5>Expired subscriptions</h5>
                    <div class="card p-3 mb-4">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expiredsubscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->user->name }}</td>
                                        <td>{{ $subscription->user->email }}</td>
                                        <td>{{ $subscription->expires_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No expired subscriptions.</td>
                                        </tr>
                                    @endforelse
                            </tbody>
                        </table>
                        <a href="" class="btn btn-primary w-auto">View all expired subscriptions</a>
                    </div>

                </div>
                <div class="brief-charts row">
                    <div class=" col-md-5 card p-3 mb-4 mx-4">
                        <h5>Subscription Trends</h5>
                        <canvas id="subscriptionChart" height="100"></canvas>
                    </div>
                    <div class="col-md-5 card p-3 mb-4 mx-4">
                        <h5>User Growth</h5>
                        <canvas id="userGrowthChart" height="100"></canvas>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
            item.addEventListener('click', function() {
                const submenu = this.querySelector('.dropdown-submenu');
                if (!submenu) return;

                if (this.classList.contains('open')) {
                    // Close this submenu
                    submenu.classList.remove('open');
                    this.classList.remove('open');
                } else {
                    // Close all others first
                    document.querySelectorAll('.dropdown-submenu').forEach(sub => sub.classList.remove('open'));
                    document.querySelectorAll('.dropdown-toggle').forEach(tog => tog.classList.remove('open'));

                    // Open this one
                    submenu.classList.add('open');
                    this.classList.add('open');
                }
            });
        });
    </script>

@endsection