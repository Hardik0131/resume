<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Settings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-settings.css'])
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
                'active' => false,
                'badge' => null,
                'url' => route('admin.reports'),
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-gear',
                'active' => true,
                'badge' => null,
                'url' => route('admin.settings'),
            ],
        ];

        $stats = [
            ['label' => 'Active integrations', 'value' => '9'],
            ['label' => 'Security alerts', 'value' => '2'],
            ['label' => 'Users with 2FA', 'value' => '86%'],
            ['label' => 'Pending config changes', 'value' => '5'],
        ];

        $recentActivity = [
            ['event' => 'SSO provider updated', 'time' => '35m ago', 'status' => 'Applied'],
            ['event' => 'Billing webhook rotated', 'time' => '2h ago', 'status' => 'Applied'],
            ['event' => 'New API key generated', 'time' => '6h ago', 'status' => 'Review'],
            ['event' => 'Data retention policy changed', 'time' => '1d ago', 'status' => 'Applied'],
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

            <main class="content admin-settings-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Platform Settings</h1>
                        <p>Configure security, integrations, notifications, and operational defaults.</p>
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
                            <input type="text" placeholder="Search setting groups or keys" aria-label="Search settings">
                        </div>
                        <select aria-label="Category filter">
                            <option>All categories</option>
                            <option>Security</option>
                            <option>Notifications</option>
                            <option>Billing</option>
                            <option>Integrations</option>
                        </select>
                        <select aria-label="Environment filter">
                            <option>Production</option>
                            <option>Staging</option>
                            <option>Development</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export</button>
                            <button type="button" class="btn-primary">Save all</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-shield"></i> Security</span>
                        <span class="filter-chip"><i class="fas fa-plug"></i> Integrations</span>
                        <span class="filter-chip"><i class="fas fa-bell"></i> Notifications</span>
                        <span class="filter-chip"><i class="fas fa-database"></i> Data</span>
                    </div>
                </section>

                <section class="settings-grid">
                    <article class="panel settings-card">
                        <header class="panel-header">
                            <h2>General</h2>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Save</button>
                            </div>
                        </header>
                        <p>Core platform details used across admin and outbound communication.</p>
                        <div class="form-grid">
                            <div class="field">
                                <label for="platform-name">Platform name</label>
                                <input id="platform-name" type="text" value="HiRist">
                            </div>
                            <div class="field">
                                <label for="support-email">Support email</label>
                                <input id="support-email" type="email" value="support@hirist.com">
                            </div>
                            <div class="field">
                                <label for="timezone">Timezone</label>
                                <select id="timezone">
                                    <option>Asia/Kolkata</option>
                                    <option>UTC</option>
                                    <option>America/New_York</option>
                                </select>
                            </div>
                        </div>
                    </article>

                    <article class="panel settings-card">
                        <header class="panel-header">
                            <h2>Security Controls</h2>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Apply</button>
                            </div>
                        </header>
                        <p>Authentication and session hardening defaults.</p>
                        <div class="switch-list">
                            <div class="switch-row">
                                <div class="switch-copy">
                                    <strong>Enforce 2FA for admins</strong>
                                    <span>Require OTP for all admin roles.</span>
                                </div>
                                <span class="switch-pill on" aria-hidden="true"></span>
                            </div>
                            <div class="switch-row">
                                <div class="switch-copy">
                                    <strong>IP allowlist for super-admin</strong>
                                    <span>Restrict privileged actions to approved IPs.</span>
                                </div>
                                <span class="switch-pill on" aria-hidden="true"></span>
                            </div>
                            <div class="switch-row">
                                <div class="switch-copy">
                                    <strong>Rotate API tokens every 30 days</strong>
                                    <span>Auto-expire service tokens and notify owners.</span>
                                </div>
                                <span class="switch-pill" aria-hidden="true"></span>
                            </div>
                        </div>
                    </article>

                    <article class="panel settings-card">
                        <header class="panel-header">
                            <h2>Integrations</h2>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Test all</button>
                                <button type="button" class="btn-primary">Save</button>
                            </div>
                        </header>
                        <p>Connected external services and keys.</p>
                        <div class="form-grid">
                            <div class="field">
                                <label for="mail-provider">Mail provider</label>
                                <select id="mail-provider">
                                    <option>SendGrid</option>
                                    <option>Mailgun</option>
                                    <option>SES</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="webhook-url">Billing webhook URL</label>
                                <input id="webhook-url" type="url" value="https://api.hirist.com/webhooks/billing">
                            </div>
                            <div class="field">
                                <label for="slack-channel">Alert channel</label>
                                <input id="slack-channel" type="text" value="#admin-alerts">
                            </div>
                        </div>
                    </article>

                    <article class="panel settings-card">
                        <header class="panel-header">
                            <h2>Audit Activity</h2>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Export log</button>
                            </div>
                        </header>
                        <p>Recent platform-level configuration changes.</p>
                        <div class="activity-list">
                            @foreach ($recentActivity as $item)
                                <div class="activity-row">
                                    <div>
                                        <strong>{{ $item['event'] }}</strong>
                                        <span>{{ $item['time'] }}</span>
                                    </div>
                                    @php
                                        $statusClass = match ($item['status']) {
                                            'Applied' => 'pill green',
                                            'Review' => 'pill orange',
                                            default => 'pill red',
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ $item['status'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </article>
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
            <a href="{{ route('admin.reports') }}" class="mobile-nav-item">
                <i class="fas fa-flag"></i>
                <span>Reports</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="mobile-nav-item active">
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
