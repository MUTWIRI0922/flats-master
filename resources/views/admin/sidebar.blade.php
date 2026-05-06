        <style>

                .dashboard-sidebar {
                    width: 20%;
                    max-width: 250px;
                    background-color: #f8f9fa;
                    padding: 20px;
                    margin-top: 60px;

                    overflow-y: auto;

                }

                .col-md-4,
                .col-md-8 {
                    padding: 0;
                }

                .dropdown-submenu {
                    display: none;
                    list-style: none;
                    padding-left: 20px;
                }

                .dropdown-submenu.open {
                    display: block;
                }

                .dropdown-toggle {
                    cursor: pointer;
                    position: relative;
                }

                .dropdown-toggle::after {
                    content: '';
                    position: absolute;
                    right: 10px;
                    transition: transform 0.2s;
                }

                .dropdown-toggle.open::after {
                    transform: rotate(180deg);
                }
                /* ── Top Nav ── */
                .top-nav {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 60px;
                    background-color: #5eacff;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 24px;
                    z-index: 1000;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                }

                .top-nav .nav-left {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .top-nav .nav-left .app-name {
                    color: white;
                    font-size: 1.1rem;
                    font-weight: 700;
                    letter-spacing: 0.5px;
                    text-decoration: none;
                }

                .top-nav .nav-divider {
                    color: rgba(255,255,255,0.3);
                    font-size: 1.2rem;
                }

                .top-nav .page-title {
                    color: rgba(255,255,255,0.85);
                    font-size: 0.95rem;
                    font-weight: 500;
                }

                .top-nav .nav-right {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                }

                .top-nav .datetime {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                    color: white;
                }


                .top-nav .datetime #nav-date {
                    font-size: 0.75rem;
                    color: rgba(255,255,255,0.75);
                    line-height: 1.2;
                }

                .top-nav .nav-user {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    color: white;
                    font-size: 0.88rem;
                }

                .top-nav .nav-user .avatar {
                    width: 34px;
                    height: 34px;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1rem;
                }
        </style>
        <!-- ── Fixed Top Nav ── -->
        <nav class="top-nav">
            <div class="nav-left">
                <span class="page-title">@yield('title', 'Dashboard')</span>
            </div>

            <div class="nav-right">
                <!-- Date & Time -->
                <div class="datetime">
                    <span id="nav-date">Monday, 1 Jan 2025</span>
                </div>


            </div>
        </nav>
        <aside class="dashboard-sidebar">
            <nav>
                <ul class="list-group">
                    <li class="list-group-item"><img src="" alt="">logo</li>
                    <li class="list-group-item"><i class="bi bi-speedometer2"></i><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                    <li class="list-group-item"><i class="bi bi-people"></i><a href="{{ route('admin.users') }}"> Users</a></li>
                    <li class="list-group-item"><i class="bi bi-list"></i><a href="{{ route('subscriptions.view') }}"> Subscriptions</a></li>
                    <li class="list-group-item"><i class="bi bi-house"></i><a href="{{ route('properties.view') }}"> Properties</a></li>
                    <li class="list-group-item dropdown-toggle"><i class="bi bi-person"></i> Profile
                        <ul class="dropdown-submenu">
                            <li class="list-group-item"><a href="">View Profile</a></li>
                            <li class="list-group-item"><a href="">Edit Profile</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item dropdown-toggle"><i class="bi bi-shield"></i> Authorization
                        <ul class="dropdown-submenu">
                            <li class="list-group-item"><a href="">Permissions</a></li>
                            <li class="list-group-item"><a href="">Roles</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item dropdown-toggle"><i class="bi bi-bar-chart"></i><a href=""> Reports</a>
                        <ul class="dropdown-submenu">
                            <li class="list-group-item"><a href="">users</a></li>
                            <li class="list-group-item"><a href="">subscriptions</a></li>
                            <li class="list-group-item"><a href="">properties</a></li>

                        </ul>
                    </li>
                    <li class="list-group-item"><i class="bi bi-credit-card"></i> Payments</li>
                    <li class="list-group-item"><i class="bi bi-gear"></i>  Settings</li>
                    <li class="list-group-item"><i class="bi bi-key"></i> Change Password</li>
                    <li class="list-group-item"><i class="bi bi-box-arrow-right"></i> Logout</li>
                </ul>
            </nav>
        </aside>
    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
            item.addEventListener('click', function() {
                const submenu = this.querySelector('.dropdown-submenu');
                if (!submenu) return;

                if (this.classList.contains('open')) {
                    // Close this submenu
                    submenu.classList.remove('open');
                    this.classList.remove('open');
                } else {
                    // Close all others first
                    document.querySelectorAll('.dropdown-submenu').forEach(sub => sub.classList.remove('open'));
                    document.querySelectorAll('.dropdown-toggle').forEach(tog => tog.classList.remove('open'));

                    // Open this one
                    submenu.classList.add('open');
                    this.classList.add('open');
                }
            });
        });
    </script>