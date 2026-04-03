@extends('layouts.app')
@section('title', 'Dashboard')
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

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <p>Welcome to the Admin Dashboard</p>
            <section id="dashboard-content">
                <div class="cards row">
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Total Users</h5>
                            <p class="display-4">150</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Active Subscriptions</h5>
                            <p class="display-4">120</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Expired Subscriptions</h5>
                            <p class="display-4">30</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card p-3 mb-4">
                            <h5>Total Revenue</h5>
                            <p class="display-4">80</p>
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
                                <tr>
                                    <td>John Doe</td>
                                    <td>john.doe@example.com</td>
                                    <td>2023-10-01</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>jane.smith@example.com</td>
                                    <td>2023-10-02</td>
                                </tr>
                                <tr>
                                    <td>Bob Johnson</td>
                                    <td>bob.johnson@example.com</td>
                                    <td>2023-10-03</td>
                                </tr>
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
                                <tr>
                                    <td>John Doe</td>
                                    <td>john.doe@example.com</td>
                                    <td>2023-10-01</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>jane.smith@example.com</td>
                                    <td>2023-10-02</td>
                                </tr>
                                <tr>
                                    <td>Bob Johnson</td>
                                    <td>bob.johnson@example.com</td>
                                    <td>2023-10-03</td>
                                </tr>
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
            <section id="Users">
                <h5>Users(agents)</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Signup Date</th>
                            <th>Properties</th>
                            <th>Tenants</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>2023-10-01</td>
                            <td>5</td>
                            <td>3</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">View</a>
                                <a href="" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </section>
            <section id="active-subscriptions">
                <h5>Active Subscriptions</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>2023-10-01</td>
                            <td>2024-10-01</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    </tbody>
                </table>

            </section>
            <section id="expired-subscriptions">
                <h5>Expired Subscriptions</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>2023-10-01</td>
                            <td>2024-10-01</td>
                            <td><span class="badge bg-danger">Expired</span></td>
                        </tr>
                    </tbody>
                </table>

            </section>
            <section id="Properties">
                <h5>Properties</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Agent</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cozy Apartment</td>
                            <td>John Doe</td>
                            <td>Nairobi, Kenya</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    </tbody>
            </section>
            <section id="Roles">
                <h5>Roles</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin</td>
                            <td>All permissions</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">View</a>
                                <a href="" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>   
                        <tr>
                            <td>Agent</td>
                            <td>Manage properties, view tenants</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">View</a>
                                <a href="" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Tenant</td>
                            <td>View properties, manage own profile</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">View</a>
                                <a href="" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    </tbody>
            </section>
            <section id="profile">
                <h5>Profile</h5>
                <div class="card p-3 mb-4">
                    <h5>John Doe</h5>
                    <p>Email: john.doe@example.com</p>  
                    <p>Role: Admin</p>
                    <a href="" class="btn btn-primary">Edit Profile</a>
                </div>
            </section>
            <section id="payments">
                <h5>Payments</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>$500.00</td>
                            <td>2023-10-01</td>
                            <td>TXN-001</td>
                            <td><a href="" class="btn btn-sm btn-primary">View Receipt</a></td>
                        </tr>
                    </tbody>
                </table>

            </section>
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