@extends('layouts.admin')
@section('content')
<div class="dashboard-wrapper">
    @include('admin.sidebar')

    <main class="dashboard-main">
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
    </main>

</div>

@endsection