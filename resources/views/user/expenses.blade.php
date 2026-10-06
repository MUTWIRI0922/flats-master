@extends('layouts.app')
@section('title', 'Expenses History')
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

                    <div class="page-header ">
                        <div class="">
                            <h5 class="title">Expenses & bills records</h5>
                            <p class="subtitle">Details of expenses and bills paid to vendors</p>
                        </div>
                        <div class="page-controls">
                            <a href="" class="btn btn-outline-primary btn-sm">Search by Vendor</a>
                            <a href="" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i>Record Expense</a>
                            <!-- <a href="" class="btn btn-secondary btn-sm">Auto Payment</a> -->
                        </div>                        
                    </div>

   
                <!-- filters by date -->
                <p class="mb-0 text-primary"><i class="bi bi-funnel"></i> Filter expenses by date</p>
                <div class="date-filters mb-4">
                    <div class="date-filters__field">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" placeholder="dd/mm/yyyy" class="form-control bg-white">
                    </div>
                    <div class="date-filters__field">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" placeholder="dd/mm/yyyy" class="form-control bg-white">
                    </div>
                    <div class="date-filters__action">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
                <!-- Expense records from latest -->
                 <div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Vendor</th>
                                    <th scope="col">Property/unit</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment method</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- Pagination links --}}
                    </div>
                 </div>
            </div>
        </section>
    </main>
</div>
@endsection