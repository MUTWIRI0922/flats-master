@extends('layouts.app')
@section('title', 'Add Tenant')
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
                            <h5 class="title">Add Tenant</h5>
                            <p class="subtitle">Enter tenant details to add them to your property management system</p>
                        </div>

                    </div>

                 <div>
                    <div class="">
                        <form action="{{ route('tenants.store', ['owner_id' => session()->get('owner_id')]) }}" method="POST">
                            @csrf
                            <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="property_id" class="form-label">Property</label>
                                <select class="form-control" id="property_id" name="property_id" required>
                                    <option value="">Select a property</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}" @selected(old('property_id') == $property->id)>{{ $property->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="unit_id" class="form-label">Unit</label>
                                <select class="form-control" id="unit_id" name="unit_id" required disabled>
                                    <option value="">Select a unit</option>
                                    @foreach($properties as $property)
                                        @foreach($property->units as $unit)
                                            @if($unit->status === 'available')
                                                <option value="{{ $unit->id }}" data-property-id="{{ $property->id }}" @selected(old('unit_id') == $unit->id)>{{ $unit->unit_number }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>                            

                            </div>
                            <button type="submit" class="btn btn-primary">Add Tenant</button>
                        </form>
                    </div>
                 </div>
            </div>
        </section>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const propertySelect = document.getElementById('property_id');
        const unitSelect = document.getElementById('unit_id');
        const unitOptions = Array.from(unitSelect.querySelectorAll('option[data-property-id]'));
        const placeholder = unitSelect.querySelector('option:not([data-property-id])');

        function updateUnits() {
            const propertyId = propertySelect.value;
            let hasAvailableUnits = false;

            unitOptions.forEach(function (option) {
                const isForSelectedProperty = option.dataset.propertyId === propertyId;
                option.hidden = !isForSelectedProperty;
                option.disabled = !isForSelectedProperty;
                hasAvailableUnits = hasAvailableUnits || isForSelectedProperty;
            });

            unitSelect.value = '';
            unitSelect.disabled = !propertyId || !hasAvailableUnits;
            placeholder.textContent = propertyId && !hasAvailableUnits
                ? 'No available units for this property'
                : 'Select a unit';
        }

        propertySelect.addEventListener('change', updateUnits);
        updateUnits();
    });
</script>
@endsection