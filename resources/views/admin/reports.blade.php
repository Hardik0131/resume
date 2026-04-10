<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-reports.css'])
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
                'active' => true,
                'badge' => '3',
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
            ['label' => 'Scheduled reports', 'value' => '14'],
            ['label' => 'Generated today', 'value' => '27'],
            ['label' => 'Failed exports', 'value' => '3'],
            ['label' => 'Data freshness', 'value' => '99.4%'],
        ];

        $reportRuns = [
            [
                'name' => 'Weekly growth snapshot',
                'owner' => 'Ops Team',
                'type' => 'PDF',
                'status' => 'Completed',
                'last_run' => '2026-04-01 09:10',
                'trend' => '+6.2%',
            ],
            [
                'name' => 'Recruiter performance',
                'owner' => 'Revenue Team',
                'type' => 'CSV',
                'status' => 'Completed',
                'last_run' => '2026-04-01 08:42',
                'trend' => '+2.1%',
            ],
            [
                'name' => 'Billing exceptions',
                'owner' => 'Finance Team',
                'type' => 'XLSX',
                'status' => 'Failed',
                'last_run' => '2026-04-01 08:03',
                'trend' => '-1.4%',
            ],
            [
                'name' => 'Moderation SLA report',
                'owner' => 'Safety Team',
                'type' => 'PDF',
                'status' => 'Running',
                'last_run' => '2026-04-01 09:28',
                'trend' => '+0.8%',
            ],
        ];

        $queue = [
            [
                'title' => 'Q2 executive board pack',
                'meta' => 'Cross-team KPI bundle | 18 charts',
                'submitted' => '20m ago',
                'priority' => 'High',
            ],
            [
                'title' => 'Company churn cohorts',
                'meta' => 'Finance + Product segment rollup',
                'submitted' => '1h ago',
                'priority' => 'Medium',
            ],
            [
                'title' => 'Jobs pipeline drilldown',
                'meta' => 'Hiring funnel by company tier',
                'submitted' => '3h ago',
                'priority' => 'Low',
            ],
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
            <div class="sidebar-backdrop" id="adminBackdrop"></div>

            <main class="content admin-reports-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Reports Dashboard</h1>
                        <p>Manage scheduled analytics, exports, and executive report requests.</p>
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
                            <input type="text" placeholder="Search report name, owner, or run id" aria-label="Search reports">
                        </div>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Completed</option>
                            <option>Running</option>
                            <option>Failed</option>
                        </select>
                        <select aria-label="Format filter">
                            <option>All formats</option>
                            <option>PDF</option>
                            <option>CSV</option>
                            <option>XLSX</option>
                        </select>
                        <select aria-label="Owner filter">
                            <option>All owners</option>
                            <option>Ops Team</option>
                            <option>Finance Team</option>
                            <option>Safety Team</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export list</button>
                            <button type="button" class="btn-primary">Create report</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> Failed runs</span>
                        <span class="filter-chip"><i class="fas fa-clock"></i> Running now</span>
                        <span class="filter-chip"><i class="fas fa-calendar"></i> Scheduled today</span>
                        <span class="filter-chip"><i class="fas fa-chart-column"></i> Executive packs</span>
                    </div>
                </section>

                <section class="panel runs-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Report runs</h2>
                            <p class="muted" style="margin: 4px 0 0;">Status, ownership, output type, and trend delta.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Bulk actions</button>
                            <button type="button" class="btn-primary">Schedule run</button>
                        </div>
                    </header>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Report</th>
                                    <th>Owner</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Last run</th>
                                    <th>Trend</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportRuns as $run)
                                    <tr>
                                        <td data-label="Report">{{ $run['name'] }}</td>
                                        <td data-label="Owner">{{ $run['owner'] }}</td>
                                        <td data-label="Type"><span class="tag">{{ $run['type'] }}</span></td>
                                        <td data-label="Status">
                                            @php
                                                $statusClass = match ($run['status']) {
                                                    'Completed' => 'pill green',
                                                    'Running' => 'pill orange',
                                                    default => 'pill red',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $run['status'] }}</span>
                                        </td>
                                        <td data-label="Last run">{{ $run['last_run'] }}</td>
                                        <td data-label="Trend">
                                            @php
                                                $trendDirection = str_starts_with($run['trend'], '-') ? 'down' : 'up';
                                            @endphp
                                            <span class="trend {{ $trendDirection }}">
                                                <i class="fas {{ $trendDirection === 'up' ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                                                {{ $run['trend'] }}
                                            </span>
                                        </td>
                                        <td data-label="Actions">
                                            <div class="row-actions">
                                                <button class="btn-ghost" type="button">Download</button>
                                                <button class="btn-primary" type="button">Open</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="panel queue-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Request queue</h2>
                            <p class="muted" style="margin: 4px 0 0;">Incoming report requests awaiting assignment.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Assign</button>
                            <button type="button" class="btn-primary">Open queue</button>
                        </div>
                    </header>

                    <div class="queue-list">
                        @foreach ($queue as $item)
                            <article class="queue-row">
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p class="muted">{{ $item['meta'] }}</p>
                                </div>
                                <div class="queue-meta">
                                    <span><i class="fas fa-clock"></i> {{ $item['submitted'] }}</span>
                                    <span class="tag">{{ $item['priority'] }} priority</span>
                                </div>
                                <div class="row-actions">
                                    <button class="btn-ghost" type="button">Assign</button>
                                    <button class="btn-primary" type="button">Start</button>
                                </div>
                            </article>
                        @endforeach
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
            <a href="{{ route('admin.billing') }}" class="mobile-nav-item">
                <i class="fas fa-credit-card"></i>
                <span>Billing</span>
            </a>
            <a href="{{ url('/admin/reports') }}" class="mobile-nav-item active">
                <i class="fas fa-flag"></i>
                <span>Reports</span>
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
