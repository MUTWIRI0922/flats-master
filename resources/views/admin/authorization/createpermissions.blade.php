@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="create-permission-section" class="content-section">
                <h5 class="text-center">Create Permission</h5>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('admin.storepermission') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Permission Name</label> 
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div><br>
                    <button type="submit" class="btn btn-sm btn-primary">Create Permission</button>
                </form>
            </section>
        </main>
    </div>
@endsection