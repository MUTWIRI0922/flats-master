
@extends('layouts.admin')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="roles-section" class="content-section">
                <h5 class="text-center">Roles</h5>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">Permissions</a>
                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>    
                                <td colspan="2">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a href="{{ route('admin.createrole') }}" class="btn btn-sm btn-primary">Create Role</a>
            </section>
        </main>

    </div>
@endsection