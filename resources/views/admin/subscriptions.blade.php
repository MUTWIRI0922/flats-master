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
@endsection