<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Teams</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-teams.css'])
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
                'active' => false,
                'badge' => null,
                'url' => route('admin.users'),
            ],
            [
                'label' => 'Teams',
                'icon' => 'fa-people-group',
                'active' => true,
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

        $stats = [
            ['label' => 'Total teams', 'value' => '24'],
            ['label' => 'Active squads', 'value' => '19'],
            ['label' => 'Pending invites', 'value' => '7'],
            ['label' => 'Open roles', 'value' => '42'],
        ];

        $teams = [
            [
                'name' => 'Growth & GTM',
                'lead' => 'Alex Johnson',
                'members' => 14,
                'roles' => 6,
                'status' => 'Active',
                'focus' => ['Sales ops', 'Partnerships'],
            ],
            [
                'name' => 'Product Engineering',
                'lead' => 'Priya Nair',
                'members' => 22,
                'roles' => 11,
                'status' => 'Hiring',
                'focus' => ['Backend', 'Data'],
            ],
            [
                'name' => 'Design & Research',
                'lead' => 'Diego Martinez',
                'members' => 9,
                'roles' => 3,
                'status' => 'Active',
                'focus' => ['UX', 'Brand'],
            ],
            [
                'name' => 'Customer Ops',
                'lead' => 'Sara Lee',
                'members' => 12,
                'roles' => 2,
                'status' => 'Paused',
                'focus' => ['Support', 'Success'],
            ],
        ];

        $invites = [
            [
                'email' => 'meera@hirist.com',
                'team' => 'Product Engineering',
                'role' => 'Recruiter',
                'status' => 'Pending',
                'sent' => '2h ago',
            ],
            [
                'email' => 'tom@hirist.com',
                'team' => 'Growth & GTM',
                'role' => 'Admin',
                'status' => 'Accepted',
                'sent' => '1d ago',
            ],
            [
                'email' => 'lia@hirist.com',
                'team' => 'Design & Research',
                'role' => 'Viewer',
                'status' => 'Pending',
                'sent' => '3d ago',
            ],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="adminSidebar">
                <div class="brand">HiRist | Admin</div>

                <nav class="menu" aria-label="Admin sidebar">
                    @foreach ($menuItems as $item)
                        <a href="{{ $item['url'] ?? '#' }}" class="menu-item {{ $item['active'] ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fas {{ $item['icon'] }}"></i></span>
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

            <main class="content admin-teams-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Teams</h1>
                        <p>Manage team pods, invites, and hiring lanes.</p>
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
                            <input type="text" placeholder="Search teams or leads" aria-label="Search teams">
                        </div>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Active</option>
                            <option>Hiring</option>
                            <option>Paused</option>
                        </select>
                        <select aria-label="Region filter">
                            <option>All regions</option>
                            <option>APAC</option>
                            <option>EMEA</option>
                            <option>Americas</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export</button>
                            <button type="button" class="btn-primary">New team</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> Hiring now</span>
                        <span class="filter-chip"><i class="fas fa-shield"></i> Admin-led</span>
                        <span class="filter-chip"><i class="fas fa-clock"></i> Pending invites</span>
                        <span class="filter-chip"><i class="fas fa-eye"></i> View-only</span>
                    </div>
                </section>

                <section class="panel team-grid-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Team pods</h2>
                            <p class="muted" style="margin: 4px 0 0;">Ownership, headcount, and hiring focus.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Bulk actions</button>
                            <button type="button" class="btn-primary">Create team</button>
                        </div>
                    </header>

                    <div class="team-grid">
                        @foreach ($teams as $team)
                            <article class="team-card status-{{ strtolower($team['status']) }}">
                                <div class="team-card-header">
                                    <div>
                                        <h3>{{ $team['name'] }}</h3>
                                        <p class="muted">Lead: {{ $team['lead'] }}</p>
                                    </div>
                                    <span class="status-pill">{{ $team['status'] }}</span>
                                </div>
                                <div class="team-meta">
                                    <span><i class="fas fa-user-group"></i> {{ $team['members'] }} members</span>
                                    <span><i class="fas fa-briefcase"></i> {{ $team['roles'] }} open roles</span>
                                </div>
                                <div class="team-tags">
                                    @foreach ($team['focus'] as $focus)
                                        <span class="tag">{{ $focus }}</span>
                                    @endforeach
                                </div>
                                <div class="team-actions">
                                    <button type="button" class="btn-ghost">View</button>
                                    <button type="button" class="btn-primary">Manage</button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="panel invites-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Team invites</h2>
                            <p class="muted" style="margin: 4px 0 0;">Pending and recent invitations.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Resend all pending</button>
                            <button type="button" class="btn-primary">Invite</button>
                        </div>
                    </header>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Team</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Sent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invites as $invite)
                                    <tr>
                                        <td data-label="Email">{{ $invite['email'] }}</td>
                                        <td data-label="Team">{{ $invite['team'] }}</td>
                                        <td data-label="Role"><span class="tag">{{ $invite['role'] }}</span></td>
                                        <td data-label="Status">
                                            @php
                                                $statusClass = match ($invite['status']) {
                                                    'Accepted' => 'pill green',
                                                    'Pending' => 'pill orange',
                                                    default => 'pill red',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $invite['status'] }}</span>
                                        </td>
                                        <td data-label="Sent">{{ $invite['sent'] }}</td>
                                        <td data-label="Actions">
                                            <div class="row-actions">
                                                <button class="btn-ghost" type="button">Resend</button>
                                                <button class="btn-primary" type="button">Cancel</button>
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
            <a href="{{ route('admin.users') }}" class="mobile-nav-item">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ url('/admin/teams') }}" class="mobile-nav-item active">
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
