@extends('layouts.app')
@section('title', 'Units')
@section('content')
<div class="main-page">
    @include('user.sidebar')
    <main class="main-content">

        <header class="topbar">
            <h1 class="page-title"></h1>

            <div class="profile">
                <div>
                    <a href=""><i class="bi bi-bell fs-4"></i></a>
                </div>
                <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </header>
        <section class="content">
            <div class="container-fluid">
                <!-- page header -->
                <div class="page-header">
                    <div>
                        <h5 class="title">Units list for Property 1</h5>
                        <p class="subtitle"></p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i>Add Tenant</a>
                    </div>
                </div>


                <!-- search section -->
                <div class="search-bar d-flex flex-nowrap gap-2 mb-4">
                    <input type="text" class="form-control flex-grow-1 bg-white" placeholder="Search tenants by name or ID...">
                    <select name="property" id="" class="form-control w-25 flex-shrink-0 bg-white">
                        <option value="">All Properties</option>
                        <option value="1">Property 1</option>
                        <option value="2">Property 2</option>
                    </select>
                </div>
                <!-- tenants table -->
                <div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Property/unit</th>
                                    <th scope="col">Lease start</th>
                                    <th scope="col">Rent status</th>

                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="" class="btn btn-sm btn-primary">View</a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection