<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Jobs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-jobs.css'])
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
                'url' => url('/admin/teams'),
            ],
            [
                'label' => 'Companies',
                'icon' => 'fa-building',
                'active' => false,
                'badge' => null,
                'url' => url('/admin/companies'),
            ],
            [
                'label' => 'Jobs',
                'icon' => 'fa-briefcase',
                'active' => true,
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
            ['label' => 'Live jobs', 'value' => '3,965'],
            ['label' => 'Pending review', 'value' => '74'],
            ['label' => 'Flagged', 'value' => '18'],
            ['label' => 'Closed last 7d', 'value' => '432'],
        ];

        $jobs = [
            [
                'title' => 'Senior Backend Engineer',
                'company' => 'TechNova Pvt Ltd',
                'team' => 'Product Engineering',
                'type' => 'Full-time',
                'location' => 'Remote / India',
                'status' => 'Live',
                'age' => '3d',
                'apps' => 124,
            ],
            [
                'title' => 'Product Manager',
                'company' => 'BuildStack Labs',
                'team' => 'Growth & GTM',
                'type' => 'Full-time',
                'location' => 'Bangalore',
                'status' => 'Pending',
                'age' => '1d',
                'apps' => 42,
            ],
            [
                'title' => 'Data Scientist',
                'company' => 'AI Forge Solutions',
                'team' => 'Data',
                'type' => 'Contract',
                'location' => 'Remote',
                'status' => 'Live',
                'age' => '5h',
                'apps' => 88,
            ],
            [
                'title' => 'UX Researcher',
                'company' => 'Design & Research',
                'team' => 'Design',
                'type' => 'Full-time',
                'location' => 'Remote / APAC',
                'status' => 'Flagged',
                'age' => '2d',
                'apps' => 17,
            ],
            [
                'title' => 'Customer Success Lead',
                'company' => 'Nimbus Retail',
                'team' => 'Customer Ops',
                'type' => 'Full-time',
                'location' => 'Delhi',
                'status' => 'Live',
                'age' => '7d',
                'apps' => 63,
            ],
        ];

        $reviewQueue = [
            ['title' => 'Security Engineer', 'company' => 'Helios Cloud', 'submitted' => '45m ago', 'risk' => 'Low'],
            [
                'title' => 'Growth Analyst',
                'company' => 'Urban Mobility Co',
                'submitted' => '2h ago',
                'risk' => 'Medium',
            ],
            ['title' => 'ML Ops Engineer', 'company' => 'Arcadia Health', 'submitted' => '5h ago', 'risk' => 'High'],
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

            <main class="content admin-jobs-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Jobs</h1>
                        <p>Oversee listings, compliance, and review queues.</p>
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
                            <input type="text" placeholder="Search title, company, or ID" aria-label="Search jobs">
                        </div>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Live</option>
                            <option>Pending</option>
                            <option>Flagged</option>
                            <option>Closed</option>
                        </select>
                        <select aria-label="Type filter">
                            <option>All types</option>
                            <option>Full-time</option>
                            <option>Contract</option>
                            <option>Internship</option>
                        </select>
                        <select aria-label="Location filter">
                            <option>All locations</option>
                            <option>Remote</option>
                            <option>India</option>
                            <option>APAC</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export</button>
                            <button type="button" class="btn-primary">Create job</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> Pending review</span>
                        <span class="filter-chip"><i class="fas fa-shield"></i> Verified companies</span>
                        <span class="filter-chip"><i class="fas fa-flag"></i> Flagged</span>
                        <span class="filter-chip"><i class="fas fa-briefcase"></i> Remote roles</span>
                    </div>
                </section>

                <section class="panel jobs-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Job listings</h2>
                            <p class="muted" style="margin: 4px 0 0;">Status, company, type, and applicant volume.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Bulk actions</button>
                            <button type="button" class="btn-primary">Create job</button>
                        </div>
                    </header>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Team</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Age</th>
                                    <th>Applicants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td data-label="Title">{{ $job['title'] }}</td>
                                        <td data-label="Company">{{ $job['company'] }}</td>
                                        <td data-label="Team"><span class="tag">{{ $job['team'] }}</span></td>
                                        <td data-label="Type"><span class="tag">{{ $job['type'] }}</span></td>
                                        <td data-label="Location">{{ $job['location'] }}</td>
                                        <td data-label="Status">
                                            @php
                                                $pillClass = match ($job['status']) {
                                                    'Live' => 'pill green',
                                                    'Pending' => 'pill orange',
                                                    default => 'pill red',
                                                };
                                            @endphp
                                            <span class="{{ $pillClass }}">{{ $job['status'] }}</span>
                                        </td>
                                        <td data-label="Age">{{ $job['age'] }}</td>
                                        <td data-label="Applicants">{{ $job['apps'] }}</td>
                                        <td data-label="Actions">
                                            <div class="row-actions">
                                                <button class="btn-ghost" type="button">Review</button>
                                                <button class="btn-primary" type="button">Manage</button>
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
                            <h2>Review queue</h2>
                            <p class="muted" style="margin: 4px 0 0;">New postings awaiting checks.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Assign</button>
                            <button type="button" class="btn-primary">Open queue</button>
                        </div>
                    </header>

                    <div class="queue-list">
                        @foreach ($reviewQueue as $item)
                            <article class="queue-row risk-{{ strtolower($item['risk']) }}">
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p class="muted">{{ $item['company'] }}</p>
                                </div>
                                <div class="queue-meta">
                                    <span><i class="fas fa-clock"></i> {{ $item['submitted'] }}</span>
                                    <span class="tag">{{ $item['risk'] }} risk</span>
                                </div>
                                <div class="row-actions">
                                    <button class="btn-ghost" type="button">View</button>
                                    <button class="btn-primary" type="button">Approve</button>
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
            <a href="{{ url('/admin/teams') }}" class="mobile-nav-item">
                <i class="fas fa-people-group"></i>
                <span>Teams</span>
            </a>
            <a href="{{ url('/admin/jobs') }}" class="mobile-nav-item active">
                <i class="fas fa-briefcase"></i>
                <span>Jobs</span>
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
