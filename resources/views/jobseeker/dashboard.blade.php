<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/jobseeker-dashboard.css')
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => true,
                'badge' => null,
                'url' => route('jobseeker.dashboard'),
            ],
            [
                'label' => 'All Jobs',
                'icon' => 'fa-list',
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.all-jobs'),
            ],
            [
                'label' => 'My Profile',
                'icon' => 'fa-user',
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.profile'),
            ],
            [
                'label' => 'Applied Jobs',
                'icon' => 'fa-briefcase',
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.applied-jobs'),
            ],
            [
                'label' => 'Saved Jobs',
                'icon' => 'fa-bookmark',
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.saved-jobs'),
            ],
            ['label' => 'Messages', 'icon' => 'fa-envelope', 'active' => false, 'badge' => '3'],
            ['label' => 'Settings', 'icon' => 'fa-gear', 'active' => false, 'badge' => null],
        ];

        // $recentApplications = [
        //     ['title' => 'PHP Developer', 'company' => 'Tech Solutions', 'status' => 'In Review', 'dot' => 'status-dot status-review', 'text' => 'status-review-text'],
        //     ['title' => 'MySQL Database Admin', 'company' => 'DataCorp', 'status' => 'Interview', 'dot' => 'status-dot status-interview', 'text' => 'status-interview-text'],
        //     ['title' => 'Frontend Developer', 'company' => 'Web Innovate', 'status' => 'Rejected', 'dot' => 'status-dot status-rejected', 'text' => 'status-rejected-text'],
        // ];

        // $savedJobs = [
        //     'UI/UX Designer - Creative Agency',
        //     'Laravel Developer - NexaSoft',
        //     'Project Manager - BuildTech',
        // ];

        // $latestMessages = [
        //     ['sender' => 'HR Manager', 'text' => 'Your interview is confirmed for tomorrow.'],
        //     ['sender' => 'Recruiter', 'text' => 'Please send your updated resume.'],
        //     ['sender' => 'John Doe', 'text' => 'Are you available for a quick call?'],
        // ];
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
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Welcome Back, {{ auth()->user()->name ?? 'Hardik' }}!</h1>
                        <p>Here are your latest updates.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Notifications">
                            <i class="fas fa-bell"></i>
                        </button>
                        <a href="{{ route('jobseeker.profile') }}" class="icon-btn" aria-label="Profile">
                            <i class="fas fa-circle-user"></i>
                        </a>
                    </div>
                </div>

                <section class="stats-grid">
                    <article class="stat-card blue wave">
                        <h3>Applied Jobs</h3>
                        <p>{{ $applicationCount }}</p>
                    </article>
                    <article class="stat-card purple wave">
                        <h3>Interviews Scheduled</h3>
                        <p>4</p>
                    </article>
                    <article class="stat-card green wave">
                        <h3>Saved Jobs</h3>
                        <p>{{ $savedJobCount }}</p>
                    </article>
                    <article class="stat-card orange wave">
                        <h3>New Messages</h3>
                        <p>2</p>
                    </article>
                </section>

                <section class="panel-grid top-panels">
                    <article class="panel panel-large wave-soft">
                        <header class="panel-header">
                            <h2>Recent Applications</h2>
                            <a href="{{ route('jobseeker.applied-jobs') }}" class="panel-link">View All</a>
                        </header>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentApplicationsArray as $application)
                                        <tr>
                                            <td>{{ $application->job_title ?? 'N/A' }}</td>
                                            <td>{{ $application->company->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="status {{ $application->status ?: 'Unknown' }}">
                                                    <span class="{{ $application->status ?: 'Unknown' }}"></span>
                                                    {{ $application->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (count($recentApplicationsArray) === 0)
                            <div class="empty-table-state">
                                <div class="empty-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <h3>No Recent Applications</h3>
                                <p>You haven't applied to any jobs yet.</p>
                                <a href="{{ route('jobseeker.all-jobs') }}" class="btn-primary">Apply Now</a>
                            </div>
                        @endif
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Upcoming Interview</h2>
                        </header>
                        @if ($upcomingInterview)
                            <div class="interview-card">
                                <h3>{{ $upcomingInterview->job_title ?? 'N/A' }}</h3>
                                <p>{{ $upcomingInterview->company->name ?? 'N/A' }}</p>
                                <div class="interview-meta">
                                    <span>Date:
                                        {{ $upcomingInterview->interview_date ? \Carbon\Carbon::parse($upcomingInterview->interview_date)->format('M d, Y') : 'N/A' }}</span>
                                    <span>Time: {{ $upcomingInterview->interview_time ?? 'N/A' }}</span>
                                </div>
                                <a href="#" class="btn-primary">View Details</a>
                            </div>
                        @else
                            <div class="empty-interview-state">
                                <div class="empty-icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <h3>No Interviews Scheduled</h3>
                                <p>You don't have any upcoming interviews yet. Keep applying to get started!</p>
                                <a href="{{ route('jobseeker.all-jobs') }}" class="btn-primary">Browse Jobs</a>
                            </div>
                        @endif
                    </article>
                </section>

                <section class="panel-grid bottom-panels">
                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Saved Jobs</h2>
                            <a href="{{ route('jobseeker.saved-jobs') }}" class="panel-link">View All</a>
                        </header>
                        @if ($recentSavedJobArray)
                            <div class="list">
                                @foreach ($recentSavedJobArray as $job)
                                    <div class="list-row">
                                        <span>{{ ucfirst($job->job_title) ?? 'N/A' }}-{{$job->company->name ?? 'N/A'}}</span>
                                        <span class="mini-icon"></span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-list-state">
                                <div class="empty-icon">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <h3>No Saved Jobs</h3>
                                <p>Save interesting roles for later.</p>
                                <a href="{{ route('jobseeker.all-jobs') }}" class="btn-primary">Browse Jobs</a>
                            </div>
                        @endif
                    </article>

                    <article class="panel wave-soft">
                        <header class="panel-header">
                            <h2>Latest Messages</h2>
                            <a href="#" class="panel-link">View All</a>
                        </header>
                        @if ($messages)
                            <div class="list">
                                @foreach ($messages as $message)
                                    <div class="list-row stacked">
                                        <strong>{{ $message['sender'] }}:</strong>
                                        <span>{{ $message['text'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-list-state">
                                <div class="empty-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3>No Messages</h3>
                                <p>You don't have any messages yet.</p>
                            </div>
                        @endif
                    </article>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="#" class="mobile-nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('jobseeker.all-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-list"></i>
                <span>All Jobs</span>
            </a>
            <a href="{{ route('jobseeker.applied-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-briefcase"></i>
                <span>Applied Jobs</span>
            </a>
            <a href="{{ route('jobseeker.saved-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-bookmark"></i>
                <span>Saved Jobs</span>
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
