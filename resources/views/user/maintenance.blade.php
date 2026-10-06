@extends('layouts.app')
@section('title', 'Maintenance Tickets')
@section('content')
<style>
    .maintenance-ticket-card {
        width: 100%;
        max-width: 260px;
        padding: 10px;
        color: #17314e;
        background: #fff;
        border: 1px solid #dce3eb;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(20, 40, 60, 0.08);
    }

    .maintenance-ticket-card__heading {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 8px;
    }

    .maintenance-ticket-card__title {
        margin: 0;
        font-size: 0.75rem;
        line-height: 1.35;
    }

    .maintenance-ticket-card__priority {
        flex: 0 0 auto;
        padding: 2px 6px;
        color: #875600;
        background: #fff1c7;
        border-radius: 4px;
        font-size: 0.625rem;
    }

    .maintenance-ticket-card__property,
    .maintenance-ticket-card__date {
        margin: 6px 0 0;
        color: #718096;
        font-size: 0.625rem;
        line-height: 1.4;
    }

    .maintenance-ticket-card__message {
        margin: 8px 0 0;
        color: #526579;
        font-size: 0.6875rem;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .maintenance-ticket-card__action {
        width: 100%;
        margin-top: 8px;
        padding: 4px 8px;
        color: #234765;
        background: #edf4fa;
        border: 0;
        border-radius: 5px;
        font-size: 0.625rem;
        cursor: pointer;
    }

    #ticketStageModal {
        z-index: 3000;
    }

    .modal-backdrop {
        z-index: 2990;
    }

    h5 {
        font-size: 0.75rem;
        font-weight: normal;
        color: #111827;
        text-transform: uppercase;
    }
</style>
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
                <div class="page-header">
                        <div>
                            <h5 class="title">Maintenance Tickets</h5>
                            <p class="subtitle">Maintenance requests and tickets raised by my tenants</p>
                        </div>
                </div>
                <!-- filters by date -->
                <p class="mb-0 text-primary"><i class="bi bi-funnel"></i> Filter maintenance tickets by date</p>
                <div class="date-filters mb-4">
                    <div class="date-filters__field">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" placeholder="dd/mm/yyyy" class="form-control bg-white">
                    </div>
                    <div class="date-filters__field">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" placeholder="dd/mm/yyyy" class="form-control bg-white">
                    </div>
                    <div class="date-filters__action">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
                <!-- maintenance tickets in order of status -->
                <div class="row">
                    <h5 class="mb-3"><i class="bi bi-circle-fill text-warning"></i> New Tickets</h5>
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <article class="maintenance-ticket-card">
                            <div class="maintenance-ticket-card__heading">
                                <h6 class="maintenance-ticket-card__title">AC unit not cooling - Unit C01</h6>
                                <span class="maintenance-ticket-card__priority">Medium</span>
                            </div>
                            <p class="maintenance-ticket-card__property">Skyline Towers &middot; C01</p>
                            <p class="maintenance-ticket-card__date">Reported 2024-09-14</p>
                            <button type="button" class="maintenance-ticket-card__action" data-bs-toggle="modal" data-bs-target="#ticketStageModal" data-ticket-title="AC unit not cooling - Unit C01" data-next-stage="In Progress">Move to In Progress</button>
                        </article>
                    </div>
                    <h5 class="mb-3 mt-4"><i class="bi bi-circle-fill text-primary"></i> In Progress Tickets</h5>
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <article class="maintenance-ticket-card">
                            <div class="maintenance-ticket-card__heading">
                                <h6 class="maintenance-ticket-card__title">Leaking faucet in kitchen - Unit B02</h6>
                                <span class="maintenance-ticket-card__priority">High</span>
                            </div>
                            <p class="maintenance-ticket-card__property">Sunset Villas &middot; B02</p>
                            <p class="maintenance-ticket-card__date">Reported 2024-09-12</p>
                            <button type="button" class="maintenance-ticket-card__action" data-bs-toggle="modal" data-bs-target="#ticketStageModal" data-ticket-title="Leaking faucet in kitchen - Unit B02" data-next-stage="Completed">Move to Completed</button>
                        </article>
                    </div>
                    <h5 class="mb-3 mt-4"><i class="bi bi-circle-fill text-success"></i> Completed Tickets</h5>
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <article class="maintenance-ticket-card">
                            <div class="maintenance-ticket-card__heading">
                                <h6 class="maintenance-ticket-card__title">Broken window in living room - Unit A03</h6>
                                <span class="maintenance-ticket-card__priority">Low</span>
                            </div>
                            <p class="maintenance-ticket-card__property">Greenfield Apartments &middot; A03</p>
                            <p class="maintenance-ticket-card__date">Reported 2024-09-10</p>
                            <button type="button" class="maintenance-ticket-card__action">View Details</button>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="ticketStageModal" tabindex="-1" aria-labelledby="ticketStageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="ticketStageForm">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="ticketStageModalLabel">Update ticket status</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="small text-muted mb-3" id="ticketStageDescription"></p>
                            <label for="ticketStageMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="ticketStageMessage" name="message" rows="4" maxlength="500" placeholder="Write a message about this update" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('ticketStageModal');
        const form = document.getElementById('ticketStageForm');
        const title = document.getElementById('ticketStageModalLabel');
        const description = document.getElementById('ticketStageDescription');
        const messageInput = document.getElementById('ticketStageMessage');
        let activeButton = null;
        let nextStage = '';

        modal.addEventListener('show.bs.modal', function (event) {
            activeButton = event.relatedTarget;
            nextStage = activeButton.dataset.nextStage;
            title.textContent = `Move ticket to ${nextStage}`;
            description.textContent = activeButton.dataset.ticketTitle;
            messageInput.value = '';
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const message = messageInput.value.trim();
            if (!message || !activeButton) {
                messageInput.setCustomValidity('Please enter a message.');
                messageInput.reportValidity();
                return;
            }

            messageInput.setCustomValidity('');
            const card = activeButton.closest('.maintenance-ticket-card');
            const ticketMessage = document.createElement('p');
            ticketMessage.className = 'maintenance-ticket-card__message';
            ticketMessage.textContent = `Update message: ${message}`;
            card.insertBefore(ticketMessage, activeButton);

            activeButton.textContent = `Moved to ${nextStage}`;
            activeButton.disabled = true;
            modal.querySelector('[data-bs-dismiss="modal"]').click();
        });

        messageInput.addEventListener('input', function () {
            messageInput.setCustomValidity('');
        });
    });
</script>

@endsection