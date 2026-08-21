@extends('layouts.admin')
@section('title','')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <div class="row cards">
                <div class="col-3 col-md-3">
                    <div class="card p-3">
                        <p>Agents</p>
                        <p>10</p>
                    </div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="card p-3">
                        <p>Tenants</p>
                        <p>100</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="mostactiveusers">
                <h5>Most Active Users</h5>
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mabati</td>
                            <td>Agent</td>
                        </tr>       
                    </tbody>

                </table>
            </div>

            <div class="mostinactiveusers">
                <h5>Most Inactive Users</h5>
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mabati</td>
                            <td>Agent</td>
                        </tr>       
                    </tbody>
                </table>
            </div>
            <div class="row trends">
                <canvas>
                    <h5>User Growth</h5>
                    <canvas id="userGrowthChart" height="100"></canvas>        
                </canvas>
                <canvas>
                    <h5>Usage rate</h5>
                    <canvas id="useagerateChart" height="100"></canvas>        
                </canvas>

            </div>
        </main>
    </div>
@endsection