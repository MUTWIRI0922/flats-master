@extends('layouts.admin')
@section('title','')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <div class="row cards">
                <div class="col-3 col-md-3">
                    <div class="card p-3">
                        <p>Total Subscriptions</p>
                        <p>10</p>
                    </div>                    
                </div>
                <div class="col-3 col-md-3">
                    <div class="card p-3">
                        <p>Expired Subscriptions</p>
                        <p>5</p>
                    </div>                    
                </div>

            </div>
            <br>
            <h5>Recent Subscriptions</h5>
            <div class="recentsubscriptions">
                <table class="table table-responsive table-striped">
                    <thead>
                        <th>User</th>
                        <th>package</th>
                        <th>Expiry</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mabati</td>
                            <td>Monthly</td>
                            <td>31, Oct 2026</td>
                        </tr>                        
                    </tbody>

                </table>
            </div>
            <h5>Expired Subscriptions</h5>
            <div class="mostinactiveusers">
                <table class="table table-responsive table-striped">
                    <thead>
                        <th>User</th>
                        <th>package</th>
                        <th>Expiry</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mabati</td>
                            <td>Monthly</td>
                            <td>31, Oct 2026</td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
            <h5>Trends</h5>
            <div class="row trends">
                <canvas>
                    <h5>Subscription rate</h5>
                    <canvas id="SubscriptionGrowthChart" height="100"></canvas>        
                </canvas>
                <canvas>
                    <h5>Drop rate</h5>
                    <canvas id="SubscriptionDropChart" height="100"></canvas>        
                </canvas>

            </div>
        </main>
    </div>
@endsection