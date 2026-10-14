@extends('layouts.app')
@section('title', 'Edit Tenant')
@section('content')
<style>
    .tenant-edit-content {
        --tenant-edit-ink: #20302e;
        --tenant-edit-muted: #71817d;
        --tenant-edit-line: #e3eae6;
        --tenant-edit-green: #285b4d;
        padding-block: 26px;
    }

    .tenant-edit-content__inner {
        width: min(100%, 920px);
        margin-inline: auto;
    }

    .tenant-edit-heading {
        margin-bottom: 18px;
    }

    .tenant-edit-heading .title {
        color: var(--tenant-edit-ink);
        font-size: 1.35rem;
    }

    .tenant-edit-heading .subtitle {
        color: var(--tenant-edit-muted);
        font-size: 0.8rem;
    }

    .tenant-edit-panel {
        overflow: hidden;
        border: 1px solid var(--tenant-edit-line);
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 10px 28px rgba(32, 48, 46, 0.055);
    }

    .tenant-edit-panel__identity {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 24px;
        border-bottom: 1px solid var(--tenant-edit-line);
        background: linear-gradient(100deg, #eef5f1, #fff 80%);
    }

    .tenant-edit-panel__monogram {
        display: grid;
        flex: 0 0 48px;
        width: 48px;
        aspect-ratio: 1;
        place-items: center;
        border: 1px solid #d2e2d9;
        border-radius: 7px;
        background: #e1eee7;
        color: var(--tenant-edit-green);
        font-size: 0.95rem;
        font-weight: 700;
    }

    .tenant-edit-panel__name {
        margin: 0;
        color: var(--tenant-edit-ink);
        font-size: 0.92rem;
        font-weight: 700;
    }

    .tenant-edit-panel__record {
        margin: 3px 0 0;
        color: var(--tenant-edit-muted);
        font-size: 0.72rem;
    }

    .tenant-edit-panel__body {
        padding: 24px;
    }

    .tenant-edit-panel__section-title {
        margin: 0;
        color: var(--tenant-edit-ink);
        font-size: 0.94rem;
        font-weight: 700;
    }

    .tenant-edit-panel__section-note {
        margin: 4px 0 18px;
        color: var(--tenant-edit-muted);
        font-size: 0.77rem;
    }

    .tenant-edit-form .row {
        row-gap: 14px;
    }

    .tenant-edit-form .form-label {
        margin-bottom: 7px;
        color: var(--tenant-edit-ink);
        font-size: 0.77rem;
        font-weight: 650;
    }

    .tenant-edit-form .form-control {
        min-height: 42px;
        border-color: #d8e1dc;
        border-radius: 6px;
        color: var(--tenant-edit-ink);
        font-size: 0.84rem;
    }

    .tenant-edit-form .form-control:focus {
        border-color: var(--tenant-edit-green);
        box-shadow: 0 0 0 3px rgba(40, 91, 77, 0.12);
    }

    .tenant-edit-form__actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 22px;
        padding-top: 17px;
        border-top: 1px solid var(--tenant-edit-line);
    }

    .tenant-edit-form__cancel,
    .tenant-edit-form__submit {
        display: inline-flex;
        min-height: 38px;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
    }

    .tenant-edit-form__cancel {
        border: 1px solid var(--tenant-edit-line);
        background: #fff;
        color: var(--tenant-edit-muted);
    }

    .tenant-edit-form__submit {
        border: 0;
        background: var(--tenant-edit-green);
        color: #fff;
    }

    .tenant-edit-form__submit:hover {
        background: #1d493e;
        color: #fff;
    }

    @media (max-width: 600px) {
        .tenant-edit-content {
            padding: 18px 14px;
        }

        .tenant-edit-panel__identity {
            padding: 15px 18px;
        }

        .tenant-edit-panel__body {
            padding: 20px 18px;
        }

        .tenant-edit-form__actions {
            justify-content: stretch;
        }

        .tenant-edit-form__cancel,
        .tenant-edit-form__submit {
            flex: 1 1 0;
        }
    }
</style>
<div class="main-page">
    @include('user.sidebar')
    <main class="main-content">

        <header class="topbar">
            <h1 class="page-title">Edit Tenant</h1>

            <div class="profile">
                <div>
                    <a href=""><i class="bi bi-bell fs-4"></i></a>
                </div>
                <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </header>
        <section class="content tenant-edit-content">
            <div class="container-fluid tenant-edit-content__inner">
                <!-- page header -->

                <div class="page-header tenant-edit-heading">
                    <div class="">
                        <h5 class="title">Edit Tenant</h5>
                        <p class="subtitle">Update tenant details as needed</p>
                    </div>

                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success error-message">
                    {{ session('success') }}
                </div>
                @endif
                <div class="tenant-edit-panel">
                    <div class="tenant-edit-panel__identity">
                        <div class="tenant-edit-panel__monogram" aria-hidden="true">
                            {{ mb_strtoupper(mb_substr((string) $tenant->first_name, 0, 1) . mb_substr((string) $tenant->last_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="tenant-edit-panel__name">{{ $tenant->first_name }} {{ $tenant->last_name }}</p>
                            <p class="tenant-edit-panel__record">Tenant record #{{ $tenant->id }}</p>
                        </div>
                    </div>
                    <div class="tenant-edit-panel__body">
                        <h3 class="tenant-edit-panel__section-title">Contact information</h3>
                        <p class="tenant-edit-panel__section-note">Update the details used to reach this tenant.</p>
                        <form class="tenant-edit-form" action="{{ route('user.tenant.update', $tenant->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $tenant->first_name) }}" autocomplete="given-name" maxlength="255" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $tenant->last_name) }}" autocomplete="family-name" maxlength="255" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $tenant->phone) }}" autocomplete="tel" maxlength="255" required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $tenant->email) }}" autocomplete="email" maxlength="255" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                            </div>
                            <div class="tenant-edit-form__actions">
                                <a href="{{ route('user.tenant.show', $tenant->id) }}" class="tenant-edit-form__cancel">Cancel</a>
                                <button type="submit" class="tenant-edit-form__submit">
                                    <i class="bi bi-check2" aria-hidden="true"></i>
                                    <span>Save changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const propertySelect = document.getElementById('property_id');
        const unitSelect = document.getElementById('unit_id');
        const unitOptions = Array.from(unitSelect.querySelectorAll('option[data-property-id]'));
        const placeholder = unitSelect.querySelector('option:not([data-property-id])');

        function updateUnits() {
            const propertyId = propertySelect.value;
            let hasAvailableUnits = false;

            unitOptions.forEach(function(option) {
                const isForSelectedProperty = option.dataset.propertyId === propertyId;
                option.hidden = !isForSelectedProperty;
                option.disabled = !isForSelectedProperty;
                hasAvailableUnits = hasAvailableUnits || isForSelectedProperty;
            });

            unitSelect.value = '';
            unitSelect.disabled = !propertyId || !hasAvailableUnits;
            placeholder.textContent = propertyId && !hasAvailableUnits ?
                'No available units for this property' :
                'Select a unit';
        }

        propertySelect.addEventListener('change', updateUnits);
        updateUnits();
    });
</script> -->
@endsection