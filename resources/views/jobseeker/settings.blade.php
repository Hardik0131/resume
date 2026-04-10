<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/jobseeker-dashboard.css')
    <style>
        .settings-grid { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 12px; }
        .settings-grid .panel { height: 100%; }
        .form-grid { display: grid; gap: 12px; }
        .field { display: grid; gap: 6px; }
        .field label { font-weight: 700; color: #dce5f6; }
        .field small { color: #9ca8bf; }
        .field input, .field select, .field textarea { border-radius: 10px; border: 1px solid rgba(148, 163, 184, 0.25); background: rgba(15, 23, 42, 0.72); color: #e5edff; padding: 11px 12px; font-size: 14px; }
        .switch-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border: 1px solid rgba(148, 163, 184, 0.18); border-radius: 10px; background: rgba(9, 14, 28, 0.85); }
        .switch-row span { color: #dce5f6; font-weight: 700; }
        .switch-row small { color: #9ca8bf; display: block; font-weight: 600; }
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(148, 163, 184, 0.35); transition: .2s; border-radius: 999px; }
        .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .2s; border-radius: 50%; }
        input:checked + .slider { background: linear-gradient(90deg, #2563eb, #1d4ed8); }
        input:checked + .slider:before { transform: translateX(20px); }
        .btn-row { display: flex; gap: 10px; justify-content: flex-end; margin-top: 6px; }
        .btn-ghost-alt { border: 1px solid rgba(148, 163, 184, 0.3); background: rgba(15, 23, 42, 0.55); color: #dce5f6; border-radius: 8px; padding: 10px 14px; font-weight: 700; text-decoration: none; }
        @media (max-width: 960px) { .settings-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    @php
        $menuItems = [
            ['label' => 'Dashboard', 'icon' => 'fa-chart-line', 'active' => false, 'badge' => null, 'url' => route('jobseeker.dashboard')],
            ['label' => 'All Jobs', 'icon' => 'fa-list', 'active' => false, 'badge' => null, 'url' => route('jobseeker.all-jobs')],
            ['label' => 'My Profile', 'icon' => 'fa-user', 'active' => false, 'badge' => null, 'url' => route('jobseeker.profile')],
            ['label' => 'Applied Jobs', 'icon' => 'fa-briefcase', 'active' => false, 'badge' => null, 'url' => route('jobseeker.applied-jobs')],
            ['label' => 'Saved Jobs', 'icon' => 'fa-bookmark', 'active' => false, 'badge' => null, 'url' => route('jobseeker.saved-jobs')],
            ['label' => 'Messages', 'icon' => 'fa-envelope', 'active' => false, 'badge' => '3', 'url' => route('jobseeker.messages')],
            ['label' => 'Settings', 'icon' => 'fa-gear', 'active' => true, 'badge' => null, 'url' => route('jobseeker.settings')],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="jobseekerSidebar">
                <div class="brand">JobSeeker</div>

                <nav class="menu" aria-label="Job seeker sidebar">
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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="menu-item">Logout</button>
                    </form>
                </div>
            </aside>
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

            <main class="content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu" aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Settings</h1>
                        <p>Control notifications, privacy, and account preferences.</p>
                    </div>
                </div>

                <div class="settings-grid">
                    <section class="panel">
                        <h2 style="margin-top:0;">Notifications</h2>
                        <div class="form-grid">
                            <div class="switch-row">
                                <div>
                                    <span>Job alerts</span>
                                    <small>Email me when new jobs match my interests.</small>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-row">
                                <div>
                                    <span>Application updates</span>
                                    <small>Notify me about status changes for my applications.</small>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-row">
                                <div>
                                    <span>Messages</span>
                                    <small>Push/email alerts when recruiters message me.</small>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-row">
                                <div>
                                    <span>Product updates</span>
                                    <small>Occasional tips and feature announcements.</small>
                                </div>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="btn-row">
                            <button type="button" class="btn-ghost-alt">Cancel</button>
                            <button type="button" class="btn-primary">Save changes</button>
                        </div>
                    </section>

                    <section class="panel">
                        <h2 style="margin-top:0;">Privacy & Account</h2>
                        <div class="form-grid">
                            <div class="field">
                                <label for="visibility">Profile visibility</label>
                                <select id="visibility" name="visibility">
                                    <option>Public to recruiters</option>
                                    <option>Only visible when I apply</option>
                                    <option>Private</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="job-alerts">Job alert keywords</label>
                                <input id="job-alerts" name="job_alerts" type="text" value="frontend, react, laravel">
                                <small>Comma-separated keywords to match roles.</small>
                            </div>
                            <div class="field">
                                <label for="location">Preferred locations</label>
                                <input id="location" name="location" type="text" value="Remote, Bangalore, Pune">
                                <small>City or remote preferences.</small>
                            </div>
                            <div class="btn-row">
                                <button type="button" class="btn-ghost-alt">Cancel</button>
                                <button type="button" class="btn-primary">Save preferences</button>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('jobseeker.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('jobseeker.all-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-list"></i>
                <span>All Jobs</span>
            </a>
            <a href="{{ route('jobseeker.applied-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-briefcase"></i>
                <span>Applied</span>
            </a>
            <a href="{{ route('jobseeker.saved-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-bookmark"></i>
                <span>Saved</span>
            </a>
        </nav>
    </div>

    <script>
        (function () {
            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('jobseekerSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

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
