@extends('layouts.app')
@section('title', 'User Support')
@section('content')
<style>
    small {
        margin: 0;
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .support-contact-panel {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 0.8fr);
        gap: 32px;
        align-items: center;
        overflow: hidden;
        margin-bottom: 28px;
        padding: 32px;
        border: 1px solid #e3eaf4;
        border-radius: 18px;
        background: linear-gradient(125deg, #f2f6ff 0%, #f8faff 56%, #fff 100%);
        box-shadow: 0 10px 30px rgba(31, 50, 84, 0.06);
    }

    .support-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 12px;
        color: #3157a4;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .support-contact-copy h2 {
        margin: 0 0 10px;
        color: #182230;
        font-size: clamp(1.45rem, 3vw, 1.9rem);
        font-weight: 700;
    }

    .support-contact-copy > p {
        max-width: 480px;
        margin: 0;
        color: #667085;
        font-size: 0.92rem;
        line-height: 1.7;
    }

    .support-response-time {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
        color: #52647d;
        font-size: 0.8rem;
    }

    .support-response-time i {
        color: #31836a;
    }

    .support-channels {
        display: grid;
        gap: 12px;
    }

    .support-channel {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        padding: 15px;
        border: 1px solid #e8edf4;
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.92);
        color: inherit;
        text-decoration: none;
        transition: border-color 160ms ease, box-shadow 160ms ease, transform 160ms ease;
    }

    .support-channel:hover {
        transform: translateY(-2px);
        border-color: #bfd0f4;
        box-shadow: 0 8px 18px rgba(49, 87, 164, 0.09);
        color: inherit;
    }

    .support-channel-icon {
        display: flex;
        flex: 0 0 42px;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #eef4ff;
        color: #3157a4;
        font-size: 1.1rem;
    }

    .support-channel-copy {
        display: grid;
        min-width: 0;
        gap: 3px;
    }

    .support-channel-copy small {
        color: #667085;
        font-size: 0.74rem;
    }

    .support-channel-copy strong {
        color: #202b3c;
        font-size: 0.88rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .support-channel-arrow {
        margin-left: auto;
        color: #98a2b3;
    }

    .support-faq {
        padding: 26px 28px;
        border: 1px solid #e8edf3;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(31, 41, 55, 0.04);
    }

    .support-faq-heading {
        margin-bottom: 16px;
    }

    .support-faq-heading h2 {
        margin: 0 0 5px;
        color: #182230;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .support-faq-heading p {
        margin: 0;
        color: #667085;
        font-size: 0.82rem;
    }

    .support-faq-item {
        border-top: 1px solid #eef1f5;
    }

    .support-faq-item summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 0;
        color: #27364b;
        cursor: pointer;
        font-size: 0.88rem;
        font-weight: 600;
        list-style: none;
    }

    .support-faq-item summary::-webkit-details-marker {
        display: none;
    }

    .support-faq-item summary::after {
        color: #667085;
        content: "+";
        font-size: 1.2rem;
        font-weight: 400;
        line-height: 1;
    }

    .support-faq-item[open] summary::after {
        content: "\2212";
    }

    .support-faq-item p {
        max-width: 760px;
        margin: -5px 0 16px;
        color: #667085;
        font-size: 0.84rem;
        line-height: 1.65;
    }

    @media (max-width: 768px) {
        .support-contact-panel {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 24px;
        }

        .support-faq {
            padding: 22px;
        }
    }

    #raiseTicketModal {
        font-size: 0.75rem;
    }

    select option {
        font-size: 0.75rem;
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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- page header -->
                <div class="page-header">
                    <div class="">
                        <h5 class="title">Do you need help?</h5>
                        <p class="subtitle">Our support team is here to assist you with any questions or issues you may have.</p>
                    </div>
                    <div class="page-controls">
                        <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#raiseTicketModal"><i class="bi bi-plus"></i>Raise Ticket</a>
                    </div>
                </div>
                <!-- page content for support contacts -->
                <div class="support-page-content">
                    <section class="support-contact-panel" aria-labelledby="support-contact-heading">
                        <div class="support-contact-copy">
                            <span class="support-eyebrow"><i class="bi bi-headset" aria-hidden="true"></i> Support desk</span>
                            <h2 id="support-contact-heading">How can we help?</h2>
                            <p>Reach out to our team and we’ll help you get back on track. Choose whichever contact method works best for you.</p>
                            <span class="support-response-time"><i class="bi bi-clock" aria-hidden="true"></i> We’re ready when you need us</span>
                        </div>
                        <div class="support-channels">
                            <a class="support-channel" href="mailto:info@twitech.co.ke">
                                <span class="support-channel-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                                <span class="support-channel-copy">
                                    <small>Email support</small>
                                    <strong>info@twitech.co.ke</strong>
                                </span>
                                <i class="bi bi-arrow-up-right support-channel-arrow" aria-hidden="true"></i>
                            </a>
                            <a class="support-channel" href="tel:+254754876140">
                                <span class="support-channel-icon"><i class="bi bi-telephone" aria-hidden="true"></i></span>
                                <span class="support-channel-copy">
                                    <small>Call our team</small>
                                    <strong>+254 754 876 140</strong>
                                </span>
                                <i class="bi bi-arrow-up-right support-channel-arrow" aria-hidden="true"></i>
                            </a>
                        </div>
                    </section>

                    <section class="support-faq" aria-labelledby="support-faq-heading">
                        <div class="support-faq-heading">
                            <h2 id="support-faq-heading">Frequently asked questions</h2>
                            <p>Quick answers to some common questions.</p>
                        </div>
                        <details class="support-faq-item">
                            <summary>How do I reset my password?</summary>
                            <p>Go to your profile page and choose “Change Password” to update your password.</p>
                        </details>
                        <details class="support-faq-item">
                            <summary>How do I update my profile information?</summary>
                            <p>Visit your profile page and select “Edit Profile” to update your personal details.</p>
                        </details>
                        <details class="support-faq-item">
                            <summary>How do I report an issue?</summary>
                            <p>Select “Raise Ticket” at the top of this page, describe the issue, and submit the form so our team can follow up.</p>
                        </details>
                    </section>
                </div>

            </div>
            <div class="modal fade" id="raiseTicketModal" tabindex="-1" aria-labelledby="raiseTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="raiseTicketForm" method="POST" action="">
                            @csrf
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="raiseTicketModalLabel">Raise Ticket</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="g-3">
                                    <div class="">
                                        <label for="ticket_title" class="form-label">Ticket Title</label>
                                        <input type="text" class="form-control" id="ticket_title" name="ticket_title" required>
                                    </div>
                                    <div class="">
                                        <label for="ticket_priority" class="form-label">Priority</label>
                                        <select class="form-select" id="ticket_priority" name="ticket_priority" required>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>                                    
                                    <div class="">
                                        <label for="ticket_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="ticket_description" name="ticket_description" rows="3" required></textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm">Raise Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection