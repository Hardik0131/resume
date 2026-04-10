<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-settings.css'])
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.dashboard'),
            ],
            [
                'label' => 'Post Job',
                'icon' => 'fa-plus-circle',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.post-job'),
            ],
            [
                'label' => 'Job Postings',
                'icon' => 'fa-briefcase',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.job-postings'),
            ],
            [
                'label' => 'Applications',
                'icon' => 'fa-file-alt',
                'active' => false,
                'badge' => '12',
                'url' => route('recruiter.applications'),
            ],
            [
                'label' => 'Candidates',
                'icon' => 'fa-users',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.candidates'),
            ],
            [
                'label' => 'Messages',
                'icon' => 'fa-envelope',
                'active' => false,
                'badge' => '5',
                'url' => route('recruiter.messages'),
            ],
            [
                'label' => 'Interviews',
                'icon' => 'fa-video',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.interviews'),
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-gear',
                'active' => true,
                'badge' => null,
                'url' => route('recruiter.settings'),
            ],
        ];

        $channels = [
            ['label' => 'Email updates', 'desc' => 'Get alerts for new candidates, interviews, and offers.'],
            ['label' => 'In-app notifications', 'desc' => 'Show activity badges inside the dashboard.'],
            ['label' => 'Slack webhooks', 'desc' => 'Send key events to your hiring channel.'],
            ['label' => 'Calendar invites', 'desc' => 'Auto-send calendar invites to candidates and panel.'],
        ];

        $branding = [
            ['label' => 'Primary color', 'value' => '#2563eb'],
            ['label' => 'Accent color', 'value' => '#7c3aed'],
            ['label' => 'Button style', 'value' => 'Rounded'],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="recruiterSidebar">
                <div class="brand">HiRist | Recruiter</div>

                <nav class="menu" aria-label="Recruiter sidebar">
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
            <div class="sidebar-backdrop" id="recruiterBackdrop"></div>

            <main class="content settings-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Settings</h1>
                        <p>Manage your profile, team preferences, and notifications.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Support"><i
                                class="fas fa-circle-info"></i></button>
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                    </div>
                </div>

                <section class="settings-grid">
                    <article class="panel profile-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Profile</h2>
                                <p class="muted" style="margin: 4px 0 0;">Update name, email, and company.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Save changes</button>
                            </div>
                        </header>
                        <div class="field-grid">
                            <label class="field">
                                <span class="field-label">Full name</span>
                                <input type="text" placeholder="Jane Doe" aria-label="Full name">
                            </label>
                            <label class="field">
                                <span class="field-label">Work email</span>
                                <input type="email" placeholder="jane@company.com" aria-label="Work email">
                            </label>
                        </div>
                        <div class="field-grid">
                            <label class="field">
                                <span class="field-label">Company</span>
                                <input type="text" placeholder="Acme Corp" aria-label="Company">
                            </label>
                            <label class="field">
                                <span class="field-label">Role</span>
                                <input type="text" placeholder="Talent Lead" aria-label="Role">
                            </label>
                        </div>
                        <div class="field-grid">
                            <label class="field">
                                <span class="field-label">Timezone</span>
                                <select aria-label="Timezone">
                                    <option>GMT</option>
                                    <option>GMT+1</option>
                                    <option>GMT+5:30</option>
                                    <option>GMT-5</option>
                                </select>
                            </label>
                            <label class="field toggle-field">
                                <span>
                                    <span class="field-label">Two-factor authentication</span>
                                    <small class="muted">Add an extra layer of security.</small>
                                </span>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </label>
                        </div>
                    </article>

                    <article class="panel notifications-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Notifications</h2>
                                <p class="muted" style="margin: 4px 0 0;">Choose where you get hiring updates.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Reset</button>
                            </div>
                        </header>
                        <div class="toggle-list">
                            @foreach ($channels as $channel)
                                <label class="toggle-item">
                                    <div>
                                        <strong>{{ $channel['label'] }}</strong>
                                        <p class="muted">{{ $channel['desc'] }}</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </label>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel branding-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Branding</h2>
                                <p class="muted" style="margin: 4px 0 0;">Control how candidates see your brand.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Publish</button>
                            </div>
                        </header>
                        <div class="logo-upload">
                            <div class="logo-box">
                                <i class="fas fa-image"></i>
                                <p class="muted">Upload logo</p>
                                <button type="button" class="btn-ghost">Choose file</button>
                            </div>
                            <div class="brand-fields">
                                @foreach ($branding as $item)
                                    <label class="field">
                                        <span class="field-label">{{ $item['label'] }}</span>
                                        <input type="text" value="{{ $item['value'] }}"
                                            aria-label="{{ $item['label'] }}">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </article>

                    <article class="panel security-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Security</h2>
                                <p class="muted" style="margin: 4px 0 0;">Session controls and password updates.</p>
                            </div>
                        </header>
                        <div class="field-grid">
                            <label class="field">
                                <span class="field-label">Current password</span>
                                <input type="password" placeholder="••••••••" aria-label="Current password">
                            </label>
                            <label class="field">
                                <span class="field-label">New password</span>
                                <input type="password" placeholder="Create a strong password"
                                    aria-label="New password">
                            </label>
                        </div>
                        <div class="field-grid">
                            <label class="field">
                                <span class="field-label">Session timeout</span>
                                <select aria-label="Session timeout">
                                    <option>30 minutes</option>
                                    <option>1 hour</option>
                                    <option>4 hours</option>
                                </select>
                            </label>
                            <div class="inline-actions">
                                <button type="button" class="btn-primary">Update password</button>
                                <button type="button" class="btn-ghost">Sign out of all devices</button>
                            </div>
                        </div>
                    </article>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('recruiter.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('recruiter.post-job') }}" class="mobile-nav-item">
                <i class="fas fa-plus-circle"></i>
                <span>Post Job</span>
            </a>
            <a href="{{ route('recruiter.job-postings') }}" class="mobile-nav-item">
                <i class="fas fa-briefcase"></i>
                <span>Postings</span>
            </a>
            <a href="{{ route('recruiter.settings') }}" class="mobile-nav-item active">
                <i class="fas fa-gear"></i>
                <span>Settings</span>
            </a>
        </nav>
    </div>

    <script>
        (function() {
            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('recruiterSidebar');
            const backdrop = document.getElementById('recruiterBackdrop');

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
