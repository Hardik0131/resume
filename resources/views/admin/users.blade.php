<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-users.css'])
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => false,
                'badge' => null,
                'url' => route('admin.dashboard'),
            ],
            [
                'label' => 'Users',
                'icon' => 'fa-users',
                'active' => true,
                'badge' => null,
                'url' => route('admin.users'),
            ],
            [
                'label' => 'Teams',
                'icon' => 'fa-people-group',
                'active' => false,
                'badge' => null,
                'url' => route('admin.teams'),
            ],
            [
                'label' => 'Companies',
                'icon' => 'fa-building',
                'active' => false,
                'badge' => null,
                'url' => route('admin.companies'),
            ],
            [
                'label' => 'Jobs',
                'icon' => 'fa-briefcase',
                'active' => false,
                'badge' => null,
                'url' => route('admin.jobs'),
            ],
            [
                'label' => 'Moderation',
                'icon' => 'fa-shield-halved',
                'active' => false,
                'badge' => null,
                'url' => route('admin.moderation'),
            ],
            [
                'label' => 'Billing',
                'icon' => 'fa-credit-card',
                'active' => false,
                'badge' => null,
                'url' => route('admin.billing'),
            ],
            [
                'label' => 'Reports',
                'icon' => 'fa-flag',
                'active' => false,
                'badge' => null,
                'url' => route('admin.reports'),
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-gear',
                'active' => false,
                'badge' => null,
                'url' => route('admin.settings'),
            ],
        ];

        $users = [
            [
                'name' => 'Alex Johnson',
                'email' => 'alex@example.com',
                'role' => 'Admin',
                'status' => 'Active',
                'created' => '2024-11-04',
            ],
            [
                'name' => 'Priya Nair',
                'email' => 'priya@example.com',
                'role' => 'Recruiter',
                'status' => 'Active',
                'created' => '2024-12-12',
            ],
            [
                'name' => 'Diego Martinez',
                'email' => 'diego@example.com',
                'role' => 'Recruiter',
                'status' => 'Pending',
                'created' => '2025-01-03',
            ],
            [
                'name' => 'Sara Lee',
                'email' => 'sara@example.com',
                'role' => 'Viewer',
                'status' => 'Suspended',
                'created' => '2024-09-20',
            ],
            [
                'name' => 'Kenji Tanaka',
                'email' => 'kenji@example.com',
                'role' => 'Recruiter',
                'status' => 'Active',
                'created' => '2025-02-15',
            ],
        ];

        $stats = [
            ['label' => 'Total users', 'value' => '128'],
            ['label' => 'Admins', 'value' => '8'],
            ['label' => 'Recruiters', 'value' => '92'],
            ['label' => 'Pending invites', 'value' => '6'],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="adminSidebar">
                <div class="brand">HiRist | Admin</div>

                <nav class="menu" aria-label="Admin sidebar">
                    @foreach ($menuItems as $item)
                        <a href="{{ $item['url'] ?? '#' }}" class="menu-item {{ $item['active'] ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="fas {{ $item['icon'] }}"></i>
                            </span>
                            <span>{{ $item['label'] }}</span>
                            @if ($item['badge'])
                                <span class="badge">{{ $item['badge'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </nav>

                <div class="logout-wrap">
                    <a href="#" class="menu-item">Logout</a>
                </div>
            </aside>
            <div class="sidebar-backdrop" id="adminBackdrop"></div>

            <main class="content admin-users-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Users</h1>
                        <p>Manage access, invitations, and roles.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                        <button type="button" class="icon-btn" aria-label="Support"><i
                                class="fas fa-circle-info"></i></button>
                    </div>
                </div>

                <section class="summary-grid">
                    @foreach ($stats as $stat)
                        <article class="summary-card">
                            <p class="muted">{{ $stat['label'] }}</p>
                            <h3>{{ $stat['value'] }}</h3>
                        </article>
                    @endforeach
                </section>

                <section class="filters-panel">
                    <div class="filter-bar">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by name or email" aria-label="Search users">
                        </div>
                        <select aria-label="Role filter">
                            <option>All roles</option>
                            <option>Admin</option>
                            <option>Recruiter</option>
                            <option>Viewer</option>
                        </select>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Active</option>
                            <option>Pending</option>
                            <option>Suspended</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export</button>
                            <button type="button" class="btn-primary">Invite user</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> New invites</span>
                        <span class="filter-chip"><i class="fas fa-shield"></i> Admins</span>
                        <span class="filter-chip"><i class="fas fa-users"></i> Recruiters</span>
                        <span class="filter-chip"><i class="fas fa-clock"></i> Pending</span>
                    </div>
                </section>

                <section class="panel users-panel">
                    <header class="panel-header">
                        <div>
                            <h2>All users</h2>
                            <p class="muted" style="margin: 4px 0 0;">Roles, status, and creation dates.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Bulk actions</button>
                            <button type="button" class="btn-primary">Invite user</button>
                        </div>
                    </header>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td data-label="Name">{{ $user['name'] }}</td>
                                        <td data-label="Email">{{ $user['email'] }}</td>
                                        <td data-label="Role"><span class="tag">{{ $user['role'] }}</span></td>
                                        <td data-label="Status">
                                            @php
                                                $pillClass = match ($user['status']) {
                                                    'Active' => 'pill green',
                                                    'Pending' => 'pill orange',
                                                    default => 'pill red',
                                                };
                                            @endphp
                                            <span class="{{ $pillClass }}">{{ $user['status'] }}</span>
                                        </td>
                                        <td data-label="Created">{{ $user['created'] }}</td>
                                        <td data-label="Actions">
                                            <div class="row-actions">
                                                <button class="btn-ghost" type="button">Reset password</button>
                                                <button class="btn-primary" type="button">Edit</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="mobile-nav-item active">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ url('/admin/teams') }}" class="mobile-nav-item">
                <i class="fas fa-people-group"></i>
                <span>Teams</span>
            </a>
            <a href="{{ url('/admin/settings') }}" class="mobile-nav-item">
                <i class="fas fa-gear"></i>
                <span>Settings</span>
            </a>
        </nav>
    </div>

    <script>
        (function() {
            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('adminBackdrop');

            if (!toggle || !sidebar || !backdrop) return;

            const closeMenu = () => {
                document.body.classList.remove('menu-open');
                toggle.setAttribute('aria-expanded', 'false');
            };

            const openMenu = () => {
                document.body.classList.add('menu-open');
                toggle.setAttribute('aria-expanded', 'true');
            };

            toggle.addEventListener('click', () => {
                if (document.body.classList.contains('menu-open')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            backdrop.addEventListener('click', closeMenu);

            window.addEventListener('resize', () => {
                if (window.innerWidth > 760) {
                    closeMenu();
                }
            });
        })();
    </script>
</body>

</html>
