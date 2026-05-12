@extends('layouts.admin')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="roles-section" class="content-section">
                <h5 class="text-center">Edit Role</h5>
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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.updaterole', $role->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="checkbox">
                            @foreach($permissions as $permission)

                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                    <br>


                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form> 
            </section>
        </main>

    </div>
@endsection