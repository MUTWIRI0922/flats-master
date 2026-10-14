@extends('layouts.app')
@section('title', 'Tenant profile')
@section('content')
<style>
    .tenant-view {
        --tenant-ink: #20302e;
        --tenant-muted: #71817d;
        --tenant-line: #e3eae6;
        --tenant-green: #285b4d;
        --tenant-coral: #c76042;
        padding: 28px 24px;
    }

    .tenant-view__inner {
        width: min(100%, 940px);
        margin: 0 auto;
    }

    .tenant-view__actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .tenant-view__back,
    .tenant-view__edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 38px;
        font-size: 0.84rem;
        font-weight: 600;
        text-decoration: none;
    }

    .tenant-view__back {
        color: var(--tenant-muted);
    }

    .tenant-view__back:hover {
        color: var(--tenant-green);
    }

    .tenant-view__edit {
        padding: 0 14px;
        border-radius: 6px;
        background: var(--tenant-green);
        color: #fff;
        transition: background-color 160ms ease, transform 160ms ease;
    }

    .tenant-view__edit:hover {
        background: #1d493e;
        color: #fff;
        transform: translateY(-1px);
    }

    .tenant-view__sheet {
        overflow: hidden;
        border: 1px solid var(--tenant-line);
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 12px 32px rgba(32, 48, 46, 0.06);
        animation: tenant-view-enter 300ms ease-out both;
    }

    .tenant-view__identity {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 30px 32px;
        border-bottom: 1px solid var(--tenant-line);
        background: linear-gradient(105deg, #eef5f1 0%, #fff 75%);
    }

    .tenant-view__monogram {
        display: grid;
        flex: 0 0 72px;
        width: 72px;
        aspect-ratio: 1;
        place-items: center;
        border: 1px solid #d2e2d9;
        border-radius: 8px;
        background: #e1eee7;
        color: var(--tenant-green);
        font-size: 1.35rem;
        font-weight: 700;
    }

    .tenant-view__kicker {
        margin: 0 0 6px;
        color: var(--tenant-coral);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .tenant-view__name {
        margin: 0;
        color: var(--tenant-ink);
        font-size: 1.6rem;
        font-weight: 650;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .tenant-view__caption {
        margin: 7px 0 0;
        color: var(--tenant-muted);
        font-size: 0.82rem;
    }

    .tenant-view__details {
        padding: 24px 32px 28px;
    }

    .tenant-view__section-heading {
        margin: 0 0 4px;
        color: var(--tenant-ink);
        font-size: 0.95rem;
        font-weight: 700;
    }

    .tenant-view__section-caption {
        margin: 0 0 16px;
        color: var(--tenant-muted);
        font-size: 0.78rem;
    }

    .tenant-view__contact-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        border-top: 1px solid var(--tenant-line);
    }

    .tenant-view__contact {
        display: flex;
        min-width: 0;
        align-items: center;
        gap: 12px;
        padding: 17px 16px 17px 0;
        border-bottom: 1px solid var(--tenant-line);
    }

    .tenant-view__contact:first-child {
        margin-right: 24px;
    }

    .tenant-view__contact-icon {
        display: grid;
        flex: 0 0 38px;
        width: 38px;
        aspect-ratio: 1;
        place-items: center;
        border-radius: 7px;
        background: #edf4f0;
        color: var(--tenant-green);
        font-size: 0.95rem;
    }

    .tenant-view__contact:nth-child(2) .tenant-view__contact-icon {
        background: #fbf0ec;
        color: var(--tenant-coral);
    }

    .tenant-view__contact-label {
        display: block;
        margin-bottom: 3px;
        color: var(--tenant-muted);
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .tenant-view__contact-value {
        display: block;
        color: var(--tenant-ink);
        font-size: 0.87rem;
        font-weight: 600;
        overflow-wrap: anywhere;
        text-decoration: none;
    }

    a.tenant-view__contact-value:hover {
        color: var(--tenant-green);
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    @keyframes tenant-view-enter {
        from {
            opacity: 0;
            transform: translateY(7px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 600px) {
        .tenant-view {
            padding: 20px 14px;
        }

        .tenant-view__identity {
            align-items: flex-start;
            gap: 15px;
            padding: 22px 19px;
        }

        .tenant-view__monogram {
            flex-basis: 58px;
            width: 58px;
            font-size: 1.1rem;
        }

        .tenant-view__name {
            font-size: 1.3rem;
        }

        .tenant-view__details {
            padding: 21px 19px 24px;
        }

        .tenant-view__contact-list {
            grid-template-columns: minmax(0, 1fr);
        }

        .tenant-view__contact:first-child {
            margin-right: 0;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .tenant-view__sheet,
        .tenant-view__edit {
            animation: none;
            transition: none;
        }
    }
</style>
<div class="main-page">
    @include('user.sidebar')
    <main class="main-content">
        <header class="topbar">
            <h1 class="page-title">Tenant profile</h1>
            <div class="profile">
                <div>
                    <a href="" aria-label="Notifications"><i class="bi bi-bell fs-4" aria-hidden="true"></i></a>
                </div>
                <img class="avatar" src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile">
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </header>
        <section class="content tenant-view">
            <div class="container-fluid tenant-view__inner">
                <div class="tenant-view__actions">
                    <a href="{{ route('user.tenants') }}" class="tenant-view__back">
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        <span>All tenants</span>
                    </a>
                    <a href="{{ route('user.tenant.edit', $tenant->id) }}" class="tenant-view__edit">
                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                        <span>Edit tenant</span>
                    </a>
                </div>

                <article class="tenant-view__sheet" aria-labelledby="tenant-name">
                    <header class="tenant-view__identity">
                        <div class="tenant-view__monogram" aria-hidden="true">
                            {{ mb_strtoupper(mb_substr((string) $tenant->first_name, 0, 1) . mb_substr((string) $tenant->last_name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="tenant-view__name" id="tenant-name">{{ $tenant->first_name }} {{ $tenant->last_name }}</h2>
                            <p class="tenant-view__caption">Tenant Details</p>
                        </div>
                    </header>

                    <div class="tenant-view__details">
                        <h3 class="tenant-view__section-heading">Contact details</h3>

                        <div class="tenant-view__contact-list">
                            <div class="tenant-view__contact">
                                <span class="tenant-view__contact-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                                <div class="min-w-0">
                                    <span class="tenant-view__contact-label">Email address</span>
                                    <a class="tenant-view__contact-value" href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a>
                                </div>
                            </div>
                            <div class="tenant-view__contact">
                                <span class="tenant-view__contact-icon"><i class="bi bi-telephone" aria-hidden="true"></i></span>
                                <div class="min-w-0">
                                    <span class="tenant-view__contact-label">Phone number</span>
                                    <a class="tenant-view__contact-value" href="tel:{{ $tenant->phone }}">{{ $tenant->phone }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>
</div>
@endsection