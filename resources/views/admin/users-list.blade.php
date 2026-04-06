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
                .dropdown-submenu {
                    display: none;
                    list-style: none;
                    padding-left: 20px;
                }
                .dropdown-submenu.open {
                    display: block;
                }
                .dropdown-toggle {
                    cursor: pointer;
                    position: relative;
                }
                .dropdown-toggle::after {
                    content: '';
                    position: absolute;
                    right: 10px;
                    transition: transform 0.2s;
                }
                .dropdown-toggle.open::after {
                    transform: rotate(180deg);
                }
    </style>



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

@endsection