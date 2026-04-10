<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/recruiter-dashboard.css')
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => true,
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
                'label' => 'Applications',
                'icon' => 'fa-file-alt',
                'active' => false,
                'badge' => '12',
                'url' => route('recruiter.applications'),
            ],
            [
                'label' => 'Job Postings',
                'icon' => 'fa-briefcase',
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.job-postings'),
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
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.settings'),
            ],
        ];

        $activeJobPostings = [
            ['title' => 'Senior PHP Developer', 'applicants' => 24, 'status' => 'Active', 'posted' => '5 days ago'],
            ['title' => 'MySQL Database Admin', 'applicants' => 18, 'status' => 'Active', 'posted' => '2 weeks ago'],
            [
                'title' => 'Frontend Developer (React)',
                'applicants' => 32,
                'status' => 'Active',
                'posted' => '3 days ago',
            ],
        ];

        $pendingApplications = [
            [
                'candidate' => 'Alex Johnson',
                'position' => 'Senior PHP Developer',
                'applied' => '2 hours ago',
                'status' => 'New',
            ],
            [
                'candidate' => 'Sarah Smith',
                'position' => 'Frontend Developer',
                'applied' => '1 day ago',
                'status' => 'Reviewing',
            ],
            [
                'candidate' => 'Mike Chen',
                'position' => 'MySQL Admin',
                'applied' => '3 days ago',
                'status' => 'Interview',
            ],
        ];

        $upcomingInterviews = [
            [
                'candidate' => 'John Williams',
                'position' => 'Senior PHP Developer',
                'date' => 'April 28, 2024',
                'time' => '2:00 PM',
            ],
            [
                'candidate' => 'Emily Davis',
                'position' => 'Frontend Developer',
                'date' => 'April 29, 2024',
                'time' => '10:30 AM',
            ],
        ];

        $shortlistedCandidates = [
            'Alex Johnson - Senior PHP Developer',
            'Sarah Smith - Frontend Developer',
            'David Wilson - Database Admin',
            'Lisa Anderson - UI/UX Designer',
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

            <main class="content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Welcome Back, {{ auth()->user()->name ?? 'Recruiter' }}!</h1>
                        <p>Manage your job postings and candidates efficiently.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Notifications">
                            <i class="fas fa-bell"></i>
                        </button>
                        <button type="button" class="icon-btn" aria-label="Profile">
                            <i class="fas fa-circle-user"></i>
                        </button>
                    </div>
                </div>

                <section class="stats-grid">
                    <article class="stat-card blue wave">
                        <h3>Active Postings</h3>
                        <p>8</p>
                    </article>
                    <article class="stat-card purple wave">
                        <h3>Total Applications</h3>
                        <p>156</p>
                    </article>
                    <article class="stat-card green wave">
                        <h3>Shortlisted</h3>
                        <p>23</p>
                    </article>
                    <article class="stat-card orange wave">
                        <h3>Pending Review</h3>
                        <p>12</p>
                    </article>
                </section>

                <section class="panel-grid top-panels">
                    <article class="panel panel-large wave-soft">
                        <header class="panel-header">
                            <h2>Active Job Postings</h2>
                            <a href="#" class="panel-link">View All</a>
                        </header>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Applicants</th>
                                        <th>Status</th>
                                        <th>Posted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeJobPostings as $job)
                                        <tr>
                                            <td>{{ $job['title'] }}</td>
                                            <td>{{ $job['applicants'] }}</td>
                                            <td>
                                                <span class="status status-active">
                                                    <span class="status-dot status-active-dot"></span>
                                                    {{ $job['status'] }}
                                                </span>
                                            </td>
                                            <td>{{ $job['posted'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Quick Actions</h2>
                        </header>
                        <div class="action-buttons">
                            <a href="#" class="action-btn primary">
                                <i class="fas fa-plus"></i>
                                Post New Job
                            </a>
                            <a href="#" class="action-btn secondary">
                                <i class="fas fa-file-import"></i>
                                Import Candidates
                            </a>
                            <a href="#" class="action-btn secondary">
                                <i class="fas fa-download"></i>
                                Export Report
                            </a>
                        </div>
                    </article>
                </section>

                <section class="panel-grid bottom-panels">
                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Pending Applications</h2>
                            <a href="#" class="panel-link">Review All</a>
                        </header>
                        <div class="application-list">
                            @foreach ($pendingApplications as $app)
                                <div class="app-row">
                                    <div class="app-info">
                                        <strong>{{ $app['candidate'] }}</strong>
                                        <p>{{ $app['position'] }}</p>
                                        <span class="app-meta">{{ $app['applied'] }}</span>
                                    </div>
                                    <span class="app-status {{ strtolower(str_replace(' ', '-', $app['status'])) }}">
                                        {{ $app['status'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Upcoming Interviews</h2>
                            <a href="#" class="panel-link">Schedule</a>
                        </header>
                        <div class="interview-list">
                            @foreach ($upcomingInterviews as $interview)
                                <div class="interview-row">
                                    <div class="interview-info">
                                        <strong>{{ $interview['candidate'] }}</strong>
                                        <p>{{ $interview['position'] }}</p>
                                        <div class="interview-meta">
                                            <span><i class="fas fa-calendar"></i> {{ $interview['date'] }}</span>
                                            <span><i class="fas fa-clock"></i> {{ $interview['time'] }}</span>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-interview">Join</a>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Shortlisted Candidates</h2>
                            <a href="#" class="panel-link">Manage</a>
                        </header>
                        <div class="candidate-list">
                            @foreach ($shortlistedCandidates as $candidate)
                                <div class="candidate-row">
                                    <div class="candidate-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>{{ $candidate }}</span>
                                    <button class="candidate-action" aria-label="more options">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Recent Notifications</h2>
                            <a href="#" class="panel-link">Clear All</a>
                        </header>
                        <div class="notification-list">
                            <div class="notification-item">
                                <span class="notif-icon new"><i class="fas fa-star"></i></span>
                                <div class="notif-content">
                                    <strong>New Application</strong>
                                    <p>Alex Johnson applied for Senior PHP Developer</p>
                                    <span class="notif-time">30 mins ago</span>
                                </div>
                            </div>
                            <div class="notification-item">
                                <span class="notif-icon"><i class="fas fa-check-circle"></i></span>
                                <div class="notif-content">
                                    <strong>Interview Scheduled</strong>
                                    <p>Interview with Emily Davis has been confirmed</p>
                                    <span class="notif-time">2 hours ago</span>
                                </div>
                            </div>
                            <div class="notification-item">
                                <span class="notif-icon"><i class="fas fa-user-check"></i></span>
                                <div class="notif-content">
                                    <strong>Candidate Hired</strong>
                                    <p>Congratulations! David Wilson has joined your team</p>
                                    <span class="notif-time">1 day ago</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('recruiter.dashboard') }}" class="mobile-nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('recruiter.post-job') }}" class="mobile-nav-item">
                <i class="fas fa-plus-circle"></i>
                <span>Post Job</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="fas fa-file-alt"></i>
                <span>Applications</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
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
