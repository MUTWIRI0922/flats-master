    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
            background: #f7f8fa;
        }

        .sidebar {
            width: 200px;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            position: ;
            z-index: 1000;

        }

        .sidebar .brand {
            display: flex;
            align-items: stretch;
            gap: 8px;
            color: #111827;
            margin-top: 0;
        }

        .sidebar .brand > i {
            display: flex;
            align-items: center;
            font-size: 2rem;
            line-height: 1;
        }

        .sidebar .brand > div {
            line-height: 1;
        }

        .sidebar .brand p {
            margin: 0;
        }

        .sidebar .brand small {
            font-size: 0.6rem;
        }

        .sidebar .list-group-item {
            background: transparent;
            border: none;
            padding: 20; 
            border-radius: 10px;
            margin-bottom: 6px;
        }
        .list-group-item.active {
            background: #4117ff;
            color: #ffffff;
        }
        .list-group-item.active a {
            color: #ffffff;
        }
        .list-group-item:hover {
            background: #f3f4f6;
            color: #111827;
        }
        .list-group-item a {
            color: #0d0d0e;
            text-decoration: none;
            display: block;
            
        }


        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .page-title {
            font-size: 1.125rem;
            margin: 0;
            color: #111827;
            font-weight: 700;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
        }

        .profile-name {
            
            color: #111827;
        }

        .content {
            padding: 24px;
            flex: 1;
            background: transparent;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .dashboard { flex-direction: column; }
            .main-content { min-height: auto; }
            .topbar { padding: 0 12px; }
        }
    </style>
        <aside class="sidebar">
            <div class="brand d-flex align-items-center gap-2">
                <i class="bi bi-bootstrap fs-4"></i> 
                <div>
                    <p class="">Flat Master</p>
                    <p class=""><small>Landlord Portal</small></p>
                </div>
            </div>
            <hr>
            <nav class="">
                <ul class="list-group">
                    <li class="list-group-item {{ Request::routeIs('userdashboard') ? 'active' : '' }}">
                        <a href="{{ route('userdashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="list-group-item {{ Request::is('properties') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-house"></i> My Properties</a>
                    </li>
                    <li class="list-group-item {{ Request::is('tenants') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-people"></i> Tenants</a>
                    </li>
                    <li class="list-group-item {{ Request::is('payments') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-currency-dollar"></i> Payments</a>
                    </li>
                    <li class="list-group-item {{ Request::is('messages') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-envelope"></i> Messages</a>
                    </li>
                    <li class="list-group-item {{ Request::is('maintenance') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-wrench"></i> Maintenance</a>
                    </li>
                    <li class="list-group-item {{ Request::is('settings') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-gear"></i> Settings</a>
                    </li>
                    <li class="list-group-item {{ Request::is('profile') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-person"></i> Profile</a>
                    </li>
                    <li class="list-group-item {{ Request::is('support') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-question-circle"></i> Support</a>
                    </li>
                    <li class="list-group-item {{ Request::is('logout') ? 'active' : '' }}">
                        <a href=""><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </aside>