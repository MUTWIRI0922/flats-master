@extends('layouts.admin')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <ul class="nav nav-tabs nav-justified" id="subscriptionTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-subscriptions" type="button" role="tab" aria-controls="active-subscriptions" aria-selected="true">Active Subscriptions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired-subscriptions" type="button" role="tab" aria-controls="expired-subscriptions" aria-selected="false">Expired Subscriptions</button>
                </li>
            </ul>
            <div class="tab-content" id="subscriptionTabsContent">
                <div class="tab-pane fade show active" id="active-subscriptions" role="tabpanel" aria-labelledby="active-tab">
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
                            @forelse($subscriptions as $subscription)
                                @if($subscription->expiry_date >= now())
                                    <tr>
                                        <td>{{ $subscription->owner->name }}</td>
                                        <td>{{ $subscription->owner->email }}</td>
                                        <td>{{ $subscription->start_date }}</td>
                                        <td>{{ $subscription->expiry_date }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No subscriptions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $subscriptions->links('pagination::bootstrap-5') }}
                </div>
                <div class="tab-pane fade" id="expired-subscriptions" role="tabpanel" aria-labelledby="expired-tab">
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
                            @forelse($subscriptions as $subscription)
                                @if($subscription->expiry_date < now())
                                    <tr>
                                        <td>{{ $subscription->owner->name }}</td>
                                        <td>{{ $subscription->owner->email }}</td>
                                        <td>{{ $subscription->start_date }}</td>
                                        <td>{{ $subscription->expiry_date }}</td>
                                        <td><span class="badge bg-danger">Expired</span></td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No expired subscriptions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $subscriptions->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </main>
    </div>

@endsection