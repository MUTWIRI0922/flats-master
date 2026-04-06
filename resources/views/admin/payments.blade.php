@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
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
        </main>
    </div>

@endsection