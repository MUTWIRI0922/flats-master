    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
            background: #f7f8fa;
        }

        .sidebar {
            width: 200px;
            background: #4d2efc;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .sidebar .brand {
            font-weight: 700;
            margin-bottom: 18px;
            color: #111827;
        }

        .sidebar .list-group-item {
            background: transparent;
            border: none;
            padding: 20; 
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .sidebar .list-group-item a {
            color: #f8fbff;
            text-decoration: none;
            display: block;
            font-weight: 600;

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
            background: #4117ff;
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
        }

        .profile-name {
            font-weight: 600;
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
            <div class="brand"></div>
            <nav class="mt-5">
                <ul class="list-group">
                    <li class="list-group-item"><a href=""><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-house"></i> My Properties</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-people"></i> Tenants</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-currency-dollar"></i> Payments</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-envelope"></i> Messages</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-wrench"></i> Maintenance</a></li>
                    <li class="list-group-item"><a href=""><i class="bi bi-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </aside>