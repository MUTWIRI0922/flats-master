@extends('layouts.admin')
@section('content')

    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="create-role-section" class="content-section">
                <h5 class="text-center">Create Role</h5>

                <form action="{{ route('admin.storerole') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <br>
                    <h5>assign permissions to role</h5>
                    <div class="form-group">
                        <label class="form-label">Assign Permissions</label>
                        <div class="row">
                            @foreach($permissions->chunk(ceil($permissions->count() / 3)) as $column)
                                <div class="col-md-4">
                                    @foreach($column as $permission)
                                        <div class="form-check">
                                            <label>
                                                <input type="checkbox" 
                                                    name="permissions[]" 
                                                    value="{{ $permission->name }}"
                                                >
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Create Role</button>
                </form>
            </section>
        </main>

    </div>
@endsection