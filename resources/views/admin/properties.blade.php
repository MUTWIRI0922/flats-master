
@extends('layouts.admin')
@section('content')
    <div class="dashboard-wrapper">
        @include('admin.sidebar')

        <main class="dashboard-main">
            <section id="Properties">
                <h5>Properties</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Location</th>
                            <th>No. of units</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                        <tr>
                            <td>{{$property->name}}</td>
                            <td>{{$property->owner->name}}</td>
                            <td>{{$property->location}}</td>
                            <td>{{$property->unit_count}}</td>
                            <td>{{$property->status}}</td>
                            
                            
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No properties found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section> 
        </main>
    </div>

@endsection