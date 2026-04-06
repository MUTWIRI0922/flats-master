@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="users-list">
                <h5>Users List</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>

            </section>
        </main>

    </div>

@endsection