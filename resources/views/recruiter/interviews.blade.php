<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviews | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-interviews.css'])
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
                'active' => true,
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

        $interviews = [
            [
                'candidate' => 'Alex Johnson',
                'role' => 'Senior Laravel Engineer',
                'type' => 'Technical screen',
                'time' => 'Today • 3:00 PM',
                'duration' => '45m',
                'timezone' => 'GMT+1',
                'panel' => ['You', 'Priya Nair'],
                'stage' => 'Tech screen',
                'stage_class' => 'stage-tech',
                'status' => 'Confirmed',
                'status_class' => 'status-confirmed',
                'location' => 'Zoom link',
            ],
            [
                'candidate' => 'Diego Martinez',
                'role' => 'Data Engineer',
                'type' => 'Hiring manager',
                'time' => 'Today • 5:30 PM',
                'duration' => '60m',
                'timezone' => 'GMT+2',
                'panel' => ['You', 'Kavya Rao'],
                'stage' => 'Onsite loop',
                'stage_class' => 'stage-onsite',
                'status' => 'Prep due',
                'status_class' => 'status-warning',
                'location' => 'Meet link',
            ],
            [
                'candidate' => 'Priya Nair',
                'role' => 'Product Designer',
                'type' => 'Portfolio review',
                'time' => 'Tomorrow • 11:00 AM',
                'duration' => '45m',
                'timezone' => 'IST',
                'panel' => ['You', 'Design lead'],
                'stage' => 'Portfolio',
                'stage_class' => 'stage-portfolio',
                'status' => 'Awaiting confirm',
                'status_class' => 'status-pending',
                'location' => 'Zoom link',
            ],
            [
                'candidate' => 'Sara Lee',
                'role' => 'Customer Success Lead',
                'type' => 'Executive round',
                'time' => 'Friday • 9:00 AM',
                'duration' => '30m',
                'timezone' => 'CST',
                'panel' => ['You', 'VP CS'],
                'stage' => 'Final',
                'stage_class' => 'stage-final',
                'status' => 'Confirmed',
                'status_class' => 'status-confirmed',
                'location' => 'Zoom link',
            ],
        ];

        $agenda = [
            ['label' => 'Send prep notes', 'detail' => 'Diego • DS round', 'time' => 'Due in 30m'],
            ['label' => 'Review scorecards', 'detail' => 'Alex • Tech screen', 'time' => 'Before 5pm'],
            ['label' => 'Confirm panel', 'detail' => 'Sara • Executive', 'time' => 'Today'],
        ];

        $feedbackQueue = [
            [
                'candidate' => 'Kenji Tanaka',
                'role' => 'Frontend Developer',
                'age' => '40m ago',
                'status' => 'Awaiting feedback',
            ],
            ['candidate' => 'Mia Chen', 'role' => 'QA Lead', 'age' => '1h ago', 'status' => 'Pending scorecard'],
            ['candidate' => 'Luis Ortega', 'role' => 'Data Engineer', 'age' => '3h ago', 'status' => 'Write summary'],
        ];

        $weekStats = [
            ['title' => 'Scheduled this week', 'value' => '14', 'sub' => '+3 vs last week'],
            ['title' => 'Awaiting confirmation', 'value' => '6', 'sub' => 'Send reminders'],
            ['title' => 'Feedback pending', 'value' => '9', 'sub' => 'Most in engineering'],
            ['title' => 'Offers out', 'value' => '4', 'sub' => '2 awaiting reply'],
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

            <main class="content interviews-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Interviews</h1>
                        <p>Keep candidates and panels in sync across every stage.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Calendar"><i
                                class="fas fa-calendar"></i></button>
                        <button type="button" class="icon-btn" aria-label="Share"><i
                                class="fas fa-share-nodes"></i></button>
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                    </div>
                </div>

                <section class="summary-grid">
                    @foreach ($weekStats as $stat)
                        <article class="summary-card">
                            <p class="muted">{{ $stat['title'] }}</p>
                            <h3>{{ $stat['value'] }}</h3>
                            <span class="pill">{{ $stat['sub'] }}</span>
                        </article>
                    @endforeach
                </section>

                <section class="filters-panel">
                    <div class="filter-bar">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by candidate, role, or panel"
                                aria-label="Search interviews">
                        </div>
                        <select aria-label="Stage filter">
                            <option>All stages</option>
                            <option>Tech screen</option>
                            <option>Onsite</option>
                            <option>Portfolio</option>
                            <option>Final</option>
                        </select>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Confirmed</option>
                            <option>Awaiting confirm</option>
                            <option>Reschedule</option>
                        </select>
                        <select aria-label="Timezone filter">
                            <option>All timezones</option>
                            <option>AMER</option>
                            <option>EMEA</option>
                            <option>APAC</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Apply</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> Today</span>
                        <span class="filter-chip"><i class="fas fa-clock"></i> Awaiting confirm</span>
                        <span class="filter-chip"><i class="fas fa-clipboard-check"></i> Feedback pending</span>
                        <span class="filter-chip"><i class="fas fa-globe"></i> Remote</span>
                        <span class="filter-chip"><i class="fas fa-users"></i> Panel needed</span>
                    </div>
                </section>

                <section class="interviews-grid">
                    <article class="panel schedule-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Schedule</h2>
                                <p class="muted" style="margin: 4px 0 0;">Confirm times, links, and panelists.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Export</button>
                                <button type="button" class="btn-primary">Create slot</button>
                            </div>
                        </header>

                        <div class="schedule-list">
                            @foreach ($interviews as $slot)
                                <article class="interview-row">
                                    <div class="row-main">
                                        <div class="avatar"><i class="fas fa-user"></i></div>
                                        <div class="row-text">
                                            <div class="name-line">
                                                <strong>{{ $slot['candidate'] }}</strong>
                                                <span
                                                    class="stage-badge {{ $slot['stage_class'] }}">{{ $slot['stage'] }}</span>
                                            </div>
                                            <p class="muted">{{ $slot['role'] }} • {{ $slot['type'] }} •
                                                {{ $slot['duration'] }} • {{ $slot['timezone'] }}</p>
                                            <div class="tag-row">
                                                <span class="tag"><i class="fas fa-clock"></i>
                                                    {{ $slot['time'] }}</span>
                                                <span class="tag"><i class="fas fa-location-dot"></i>
                                                    {{ $slot['location'] }}</span>
                                                <span class="tag"><i class="fas fa-users"></i>
                                                    {{ implode(', ', $slot['panel']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-meta">
                                        <span
                                            class="status-pill {{ $slot['status_class'] }}">{{ $slot['status'] }}</span>
                                        <div class="row-actions">
                                            <button type="button" class="btn-ghost">Reschedule</button>
                                            <button type="button" class="btn-primary">Join</button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel side-panel">
                        <header class="panel-header" style="margin-bottom: 6px;">
                            <div>
                                <h2 style="margin: 0;">Today</h2>
                                <p class="muted" style="margin: 4px 0 0;">Quick agenda and reminders.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Refresh</button>
                            </div>
                        </header>
                        <div class="agenda-list">
                            @foreach ($agenda as $item)
                                <div class="agenda-row">
                                    <div>
                                        <strong>{{ $item['label'] }}</strong>
                                        <p class="muted">{{ $item['detail'] }}</p>
                                    </div>
                                    <span class="pill subtle">{{ $item['time'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 10px;">
                            <div>
                                <h3 style="margin: 0;">Feedback queue</h3>
                                <p class="muted" style="margin: 4px 0 0;">Close loops to move faster.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Send nudges</button>
                            </div>
                        </div>
                        <div class="feedback-list">
                            @foreach ($feedbackQueue as $item)
                                <div class="feedback-row">
                                    <div>
                                        <strong>{{ $item['candidate'] }}</strong>
                                        <p class="muted">{{ $item['role'] }}</p>
                                    </div>
                                    <div class="feedback-meta">
                                        <span class="muted">{{ $item['age'] }}</span>
                                        <span class="status-pill status-pending">{{ $item['status'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 10px;">
                            <div>
                                <h3 style="margin: 0;">Prep & links</h3>
                                <p class="muted" style="margin: 4px 0 0;">Share briefing docs with panel.</p>
                            </div>
                        </div>
                        <div class="prep-links">
                            <a class="prep-card" href="#">
                                <div>
                                    <strong>Interview kits</strong>
                                    <p class="muted">Role scorecards and rubrics</p>
                                </div>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a class="prep-card" href="#">
                                <div>
                                    <strong>Candidate profiles</strong>
                                    <p class="muted">Resumes, notes, and tags</p>
                                </div>
                                <i class="fas fa-arrow-right"></i>
                            </a>
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
            <a href="{{ route('recruiter.interviews') }}" class="mobile-nav-item active">
                <i class="fas fa-video"></i>
                <span>Interviews</span>
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
