@extends('layouts.admin')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="roles-section" class="content-section">
                <h5 class="text-center">Role Details</h5>
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
                <p><strong>Role:</strong> {{ $role->name }}</p>
                <strong>Permissions:</strong>

                    @if($permissions->isEmpty())
                        <span>No permissions assigned.</span>
                    @else
                        <ul>
                            @foreach($permissions as $permission)
                                <li>{{ $permission }}</li>
                            @endforeach
                        </ul>
                    @endif
                
                <a href="{{ route('admin.editrole', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.deleterole', $role->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                </form>

                <a href="{{ route('admin.viewroles') }}" class="btn btn-sm btn-secondary">Back to Roles</a>
            </section>
        </main>

    </div>