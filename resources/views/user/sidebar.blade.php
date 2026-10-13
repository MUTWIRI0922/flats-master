    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
            background: #f7f8fa;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.001);
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            overflow-y: auto;
            z-index: 1030;
            transition: transform 0.2s ease, visibility 0.2s ease;
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
        }

        .sidebar .brand {
            display: flex;
            align-items: stretch;
            gap: 8px;
            color: #111827;
            margin-top: 0;
        }

        .sidebar .brand>i {
            display: flex;
            align-items: center;
            font-size: 2rem;
            line-height: 1;
        }

        .sidebar .brand>div {
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
            width: calc(100% - 200px);
            margin-left: 200px;
        }

        .topbar {
            height: 64px;
            position: fixed;
            top: 0;
            right: 0;
            left: 200px;
            z-index: 1020;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .main-content>.content {
            margin-top: 64px;
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

        .sidebar-toggle,
        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 768px) {
            body.sidebar-open {
                overflow: hidden;
            }

            .sidebar {
                display: block;
                visibility: hidden;
                transform: translateX(-100%);
                z-index: 1040;
            }

            .sidebar.is-open {
                visibility: visible;
                transform: translateX(0);
            }

            .sidebar-toggle {
                position: fixed;
                top: 12px;
                left: 12px;
                z-index: 1050;
                display: inline-flex;
                width: 36px;
                height: 36px;
                align-items: center;
                justify-content: center;
                padding: 0;
                color: #17314e;
                background: #fff;
                border: 1px solid #dce3eb;
                border-radius: 6px;
                font-size: 1.2rem;
            }

            .sidebar-backdrop.is-visible {
                position: fixed;
                inset: 0;
                z-index: 1030;
                display: block;
                background: rgba(14, 30, 49, 0.38);
            }

            .topbar .page-title {
                max-width: calc(100% - 150px);
                margin-left: 40px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .dashboard {
                flex-direction: column;
            }

            .main-content {
                width: 100%;
                min-height: auto;
                margin-left: 0;
            }

            .topbar {
                left: 0;
            }

            .topbar {
                padding: 0 12px;
            }
        }
    </style>
    <aside class="sidebar" id="userSidebar">
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
                <li class="list-group-item {{ Request::routeIs('user.properties') ? 'active' : '' }}">
                    <a href="{{ route('user.properties')}}"><i class="bi bi-house"></i> My Properties</a>
                </li>
                <li class="list-group-item {{ Request::is('user.tenants') ? 'active' : '' }}">
                    <a href="{{ route('user.tenants') }}"><i class="bi bi-people"></i> Tenants</a>
                </li>
                <li class="list-group-item {{ Request::is('payments') ? 'active' : '' }}">
                    <a href="{{ route('payments') }}"><i class="bi bi-currency-dollar"></i> Payments</a>
                </li>
                <li class="list-group-item {{ Request::is('expenses') ? 'active' : '' }}">
                    <a href="{{ route('expenses') }}"><i class="bi bi-credit-card"></i> Expenses</a>
                </li>
                <li class="list-group-item {{ Request::is('maintenance') ? 'active' : '' }}">
                    <a href="{{ route('maintenance') }}"><i class="bi bi-wrench"></i> Maintenance</a>
                </li>
                <li class="list-group-item {{ Request::is('reports') ? 'active' : '' }}">
                    <a href="{{ route('reports') }}"><i class="bi bi-bar-chart"></i> Reports</a>
                </li>
                <li class="list-group-item {{ Request::is('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="bi bi-gear"></i> Settings</a>
                </li>
                <li class="list-group-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}"><i class="bi bi-person"></i> Profile</a>
                </li>
                <li class="list-group-item {{ Request::is('support') ? 'active' : '' }}">
                    <a href="{{ route('support') }}"><i class="bi bi-question-circle"></i> Support</a>
                </li>
                <li class="list-group-item {{ Request::is('logout') ? 'active' : '' }}">
                    <a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </nav>
    </aside>
    <button type="button" class="sidebar-backdrop" aria-label="Close navigation menu" hidden></button>
    <button type="button" class="sidebar-toggle" aria-label="Open navigation menu" aria-controls="userSidebar" aria-expanded="false" title="Open navigation menu">
        <i class="bi bi-list" aria-hidden="true"></i>
    </button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            const backdrop = document.querySelector('.sidebar-backdrop');
            const toggleIcon = toggle.querySelector('i');
            const mobileViewport = window.matchMedia('(max-width: 768px)');

            function setSidebarOpen(isOpen) {
                sidebar.classList.toggle('is-open', isOpen);
                backdrop.classList.toggle('is-visible', isOpen);
                backdrop.hidden = !isOpen;
                toggle.setAttribute('aria-expanded', String(isOpen));
                toggle.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
                toggle.title = isOpen ? 'Close navigation menu' : 'Open navigation menu';
                toggleIcon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
                document.body.classList.toggle('sidebar-open', isOpen);
            }

            toggle.addEventListener('click', function() {
                setSidebarOpen(!sidebar.classList.contains('is-open'));
            });
            backdrop.addEventListener('click', function() {
                setSidebarOpen(false);
            });
            sidebar.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (mobileViewport.matches) setSidebarOpen(false);
                });
            });
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && sidebar.classList.contains('is-open')) {
                    setSidebarOpen(false);
                }
            });
            mobileViewport.addEventListener('change', function(event) {
                if (!event.matches) setSidebarOpen(false);
            });
        });
    </script>