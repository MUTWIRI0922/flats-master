        <style>

                .dashboard-sidebar {
                    width: 20%;
                    max-width: 250px;
                    background-color: #f8f9fa;
                    padding: 20px;
                    border-right: 1px solid #e4e6eb;
                    overflow: hidden;
                }


                .dashboard-main h1,
                .dashboard-main p {
                    margin: 0 0 12px;
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
        </style>
        <aside class="dashboard-sidebar">
            <nav>
                <ul class="list-group">
                    <li class="list-group-item"><img src="" alt="">logo</li>
                    <li class="list-group-item"><i class="bi bi-speedometer2"></i><a href=""> Dashboard</a></li>
                    <li class="list-group-item"><i class="bi bi-people"></i><a href=""> Users</a></li>
                    <li class="list-group-item dropdown-toggle"><i class="bi bi-list"></i> Subscriptions
                        <ul class="dropdown-submenu">
                            <li class="list-group-item"><a href="">Active</a></li>
                            <li class="list-group-item"><a href="">Expired</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item"><i class="bi bi-house"></i><a href=""> Properties</a></li>
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
                </ul>
            </nav>
        </aside>