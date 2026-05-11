@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="permissions-section" class="content-section">
                <h5 class="text-center">Permissions</h5>
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
                <ul class="">
                    @foreach($permissions as $permission)
                        <li class="">{{ $permission->name }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.createpermission') }}" class="btn btn-sm btn-primary">Create Permission</a>
            </section>
        </main>

    </div>
@endsection