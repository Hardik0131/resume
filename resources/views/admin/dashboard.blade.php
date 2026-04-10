<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/admin-dashboard.css')
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => true,
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

        $pendingApprovals = [
            [
                'name' => 'TechNova Pvt Ltd',
                'type' => 'Recruiter Company',
                'submitted' => '2 hours ago',
                'priority' => 'High',
            ],
            [
                'name' => 'BuildStack Labs',
                'type' => 'Recruiter Company',
                'submitted' => '6 hours ago',
                'priority' => 'Medium',
            ],
            [
                'name' => 'AI Forge Solutions',
                'type' => 'Employer Verification',
                'submitted' => '1 day ago',
                'priority' => 'High',
            ],
        ];

        $recentReports = [
            ['subject' => 'Suspicious Job Post', 'by' => 'Rahul M.', 'status' => 'Open', 'severity' => 'High'],
            [
                'subject' => 'Spam Recruiter Message',
                'by' => 'Priya S.',
                'status' => 'Investigating',
                'severity' => 'Medium',
            ],
            ['subject' => 'Profile Abuse', 'by' => 'Aman K.', 'status' => 'Resolved', 'severity' => 'Low'],
        ];

        $topMetrics = [
            ['label' => 'Total Users', 'value' => '12,480', 'delta' => '+4.2%', 'tone' => 'good'],
            ['label' => 'Active Recruiters', 'value' => '1,120', 'delta' => '+2.1%', 'tone' => 'good'],
            ['label' => 'Jobs Live', 'value' => '3,965', 'delta' => '+7.6%', 'tone' => 'good'],
            ['label' => 'Tickets Open', 'value' => '89', 'delta' => '-1.9%', 'tone' => 'neutral'],
        ];

        $systemHealth = [
            ['service' => 'API Gateway', 'uptime' => '99.99%', 'status' => 'Healthy'],
            ['service' => 'Queue Worker', 'uptime' => '99.92%', 'status' => 'Healthy'],
            ['service' => 'Mail Service', 'uptime' => '98.87%', 'status' => 'Degraded'],
            ['service' => 'Database', 'uptime' => '99.97%', 'status' => 'Healthy'],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="adminSidebar">
                <div class="brand">HiRist Admin</div>

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
                    <a href="#" class="menu-item">
                        <span class="menu-icon"><i class="fas fa-right-from-bracket"></i></span>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>

            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

            <main class="content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Platform Overview, {{ auth()->user()->name ?? 'Admin' }}</h1>
                        <p>Monitor growth, moderation, and operations from one control center.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                        <button type="button" class="icon-btn" aria-label="Admin Profile"><i
                                class="fas fa-user-shield"></i></button>
                    </div>
                </div>

                <section class="stats-grid">
                    @foreach ($topMetrics as $metric)
                        <article class="stat-card {{ $metric['tone'] }} wave">
                            <h3>{{ $metric['label'] }}</h3>
                            <p>{{ $metric['value'] }}</p>
                            <span class="stat-delta">{{ $metric['delta'] }}</span>
                        </article>
                    @endforeach
                </section>

                <section class="panel-grid top-panels">
                    <article class="panel panel-large wave-soft">
                        <header class="panel-header">
                            <h2>Pending Approvals</h2>
                            <a href="#" class="panel-link">Open Queue</a>
                        </header>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Submitted</th>
                                        <th>Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingApprovals as $approval)
                                        <tr>
                                            <td>{{ $approval['name'] }}</td>
                                            <td>{{ $approval['type'] }}</td>
                                            <td>{{ $approval['submitted'] }}</td>
                                            <td>
                                                <span
                                                    class="priority {{ strtolower($approval['priority']) }}">{{ $approval['priority'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Quick Admin Actions</h2>
                        </header>
                        <div class="action-buttons">
                            <a href="#" class="action-btn primary"><i class="fas fa-user-plus"></i> Add
                                Moderator</a>
                            <a href="#" class="action-btn secondary"><i class="fas fa-file-export"></i> Export
                                Analytics</a>
                            <a href="#" class="action-btn secondary"><i class="fas fa-bullhorn"></i> Broadcast
                                Notice</a>
                            <a href="#" class="action-btn secondary"><i class="fas fa-sliders"></i> Platform
                                Settings</a>
                        </div>
                    </article>
                </section>

                <section class="panel-grid bottom-panels">
                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Recent Reports</h2>
                            <a href="#" class="panel-link">See All</a>
                        </header>
                        <div class="list">
                            @foreach ($recentReports as $report)
                                <div class="list-row stacked">
                                    <strong>{{ $report['subject'] }}</strong>
                                    <span>By {{ $report['by'] }}</span>
                                    <div class="report-meta">
                                        <span
                                            class="chip {{ strtolower($report['status']) }}">{{ $report['status'] }}</span>
                                        <span
                                            class="chip severity-{{ strtolower($report['severity']) }}">{{ $report['severity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>System Health</h2>
                            <a href="#" class="panel-link">Diagnostics</a>
                        </header>
                        <div class="list">
                            @foreach ($systemHealth as $service)
                                <div class="list-row health-row">
                                    <div>
                                        <strong>{{ $service['service'] }}</strong>
                                        <span>Uptime: {{ $service['uptime'] }}</span>
                                    </div>
                                    <span
                                        class="status-pill {{ strtolower($service['status']) }}">{{ $service['status'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile admin navigation">
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="mobile-nav-item">
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
            const backdrop = document.getElementById('sidebarBackdrop');

            if (!toggle || !backdrop) return;

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
