<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-applications.css'])
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
                'active' => true,
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
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.settings'),
            ],
        ];

        $applications = [
            [
                'name' => 'Alex Johnson',
                'role' => 'Senior Laravel Engineer',
                'stage' => 'Interview',
                'stage_class' => 'stage-interview',
                'submitted' => '2h ago',
                'location' => 'Remote',
                'score' => 86,
                'tags' => ['Laravel', 'REST', 'MySQL'],
                'status' => 'Hot',
            ],
            [
                'name' => 'Priya Nair',
                'role' => 'Product Designer (UI/UX)',
                'stage' => 'Screening',
                'stage_class' => 'stage-screening',
                'submitted' => '6h ago',
                'location' => 'Bangalore',
                'score' => 78,
                'tags' => ['Figma', 'Design systems', 'Prototyping'],
                'status' => 'Review',
            ],
            [
                'name' => 'Diego Martinez',
                'role' => 'Data Engineer',
                'stage' => 'Offer',
                'stage_class' => 'stage-offer',
                'submitted' => '1d ago',
                'location' => 'EU (Remote)',
                'score' => 91,
                'tags' => ['Python', 'Airflow', 'Snowflake'],
                'status' => 'Offer out',
            ],
            [
                'name' => 'Sara Lee',
                'role' => 'Customer Success Lead',
                'stage' => 'Shortlist',
                'stage_class' => 'stage-shortlist',
                'submitted' => '1d ago',
                'location' => 'Austin, TX',
                'score' => 74,
                'tags' => ['B2B', 'Playbooks', 'Renewals'],
                'status' => 'Shortlist',
            ],
            [
                'name' => 'Kenji Tanaka',
                'role' => 'Frontend Developer (React)',
                'stage' => 'Applied',
                'stage_class' => 'stage-applied',
                'submitted' => '3h ago',
                'location' => 'Tokyo (Hybrid)',
                'score' => 69,
                'tags' => ['React', 'TypeScript', 'CSS'],
                'status' => 'New',
            ],
        ];

        $stageTotals = [
            ['label' => 'New', 'count' => 32, 'delta' => '+6 today'],
            ['label' => 'Screening', 'count' => 18, 'delta' => '+2 today'],
            ['label' => 'Interview', 'count' => 12, 'delta' => '+1 today'],
            ['label' => 'Offer', 'count' => 4, 'delta' => 'Stable'],
        ];

        $insights = [
            ['title' => 'Replies in < 24h', 'value' => '82%', 'detail' => 'Response SLAs this week'],
            ['title' => 'Time to first touch', 'value' => '6.4h', 'detail' => 'Avg across active roles'],
            ['title' => 'Interview pass rate', 'value' => '37%', 'detail' => 'From screening to onsite'],
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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="menu-item">Logout</button>
                    </form>
                </div>
            </aside>
            <div class="sidebar-backdrop" id="recruiterBackdrop"></div>

            <main class="content applications-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Applications</h1>
                        <p>Stay on top of every candidate, from new applies to offers.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Bulk actions">
                            <i class="fas fa-layer-group"></i>
                        </button>
                        <button type="button" class="icon-btn" aria-label="Notifications">
                            <i class="fas fa-bell"></i>
                        </button>
                    </div>
                </div>

                <section class="summary-grid">
                    <article class="summary-card">
                        <p class="muted">Total candidates</p>
                        <h3>421</h3>
                        <span class="pill green">+32 this week</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">New today</p>
                        <h3>14</h3>
                        <span class="pill blue">Most from Laravel role</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">Interviews scheduled</p>
                        <h3>12</h3>
                        <span class="pill purple">6 today</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">Offers out</p>
                        <h3>4</h3>
                        <span class="pill orange">3 awaiting reply</span>
                    </article>
                </section>

                <section class="filters-panel">
                    <div class="filter-bar">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by candidate, role, or tag"
                                aria-label="Search applications">
                        </div>
                        <select aria-label="Stage filter">
                            <option>All stages</option>
                            <option>New</option>
                            <option>Screening</option>
                            <option>Interview</option>
                            <option>Offer</option>
                        </select>
                        <select aria-label="Job filter">
                            <option>All roles</option>
                            <option>Senior Laravel Engineer</option>
                            <option>Product Designer</option>
                            <option>Data Engineer</option>
                            <option>Customer Success Lead</option>
                        </select>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Hot</option>
                            <option>Review</option>
                            <option>Shortlist</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Apply</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> New today</span>
                        <span class="filter-chip"><i class="fas fa-clipboard-check"></i> Needs review</span>
                        <span class="filter-chip"><i class="fas fa-headset"></i> Interviewing</span>
                        <span class="filter-chip"><i class="fas fa-briefcase"></i> Offers</span>
                        <span class="filter-chip"><i class="fas fa-globe"></i> Remote</span>
                    </div>
                </section>

                <section class="app-grid">
                    <article class="panel app-list-panel">
                        <header class="panel-header">
                            <div>
                                <h2>All candidates</h2>
                                <p class="muted" style="margin: 4px 0 0;">Filter by stage, score, and role.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Export CSV</button>
                                <button type="button" class="btn-primary">Bulk message</button>
                            </div>
                        </header>

                        <div class="stage-tabs" role="tablist">
                            @foreach ($stageTotals as $stage)
                                <button type="button" class="stage-tab" role="tab">
                                    <span>{{ $stage['label'] }}</span>
                                    <strong>{{ $stage['count'] }}</strong>
                                    <small>{{ $stage['delta'] }}</small>
                                </button>
                            @endforeach
                        </div>

                        <div class="application-list">
                            @foreach ($applications as $app)
                                <article class="application-row">
                                    <div class="row-main">
                                        <div class="avatar"><i class="fas fa-user"></i></div>
                                        <div class="candidate-text">
                                            <div class="name-line">
                                                <strong>{{ $app['name'] }}</strong>
                                                <span
                                                    class="stage-badge {{ $app['stage_class'] }}">{{ $app['stage'] }}</span>
                                            </div>
                                            <p class="muted">{{ $app['role'] }} • {{ $app['location'] }}</p>
                                            <div class="tag-row">
                                                @foreach ($app['tags'] as $tag)
                                                    <span class="tag">{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-meta">
                                        <span class="score">{{ $app['score'] }} / 100</span>
                                        <span class="status-pill">{{ $app['status'] }}</span>
                                        <span class="muted">{{ $app['submitted'] }}</span>
                                        <div class="row-actions">
                                            <a href="{{ route('recruiter.application-view', ['id' => $loop->iteration]) }}"
                                                class="btn-ghost">View</a>
                                            <button type="button" class="btn-primary">Advance</button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel insights-panel">
                        <header class="panel-header" style="margin-bottom: 6px;">
                            <div>
                                <h2 style="margin: 0;">Insights</h2>
                                <p class="muted" style="margin: 4px 0 0;">Quick metrics for this week.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Refresh</button>
                            </div>
                        </header>
                        <div class="insight-cards">
                            @foreach ($insights as $insight)
                                <div class="insight-card">
                                    <p class="muted">{{ $insight['title'] }}</p>
                                    <h3>{{ $insight['value'] }}</h3>
                                    <span class="muted">{{ $insight['detail'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 8px;">
                            <div>
                                <h3 style="margin: 0;">Stage focus</h3>
                                <p class="muted" style="margin: 4px 0 0;">Who needs attention next.</p>
                            </div>
                        </div>
                        <div class="focus-list">
                            <div class="focus-row">
                                <div>
                                    <strong>8 candidates</strong>
                                    <p class="muted">Waiting for screening response</p>
                                </div>
                                <button type="button" class="btn-primary">Send nudges</button>
                            </div>
                            <div class="focus-row">
                                <div>
                                    <strong>5 candidates</strong>
                                    <p class="muted">Ready to schedule interview</p>
                                </div>
                                <button type="button" class="btn-ghost">Schedule</button>
                            </div>
                        </div>

                        <div class="panel-header" style="margin-top: 8px;">
                            <div>
                                <h3 style="margin: 0;">Activity</h3>
                                <p class="muted" style="margin: 4px 0 0;">Recent candidate touches.</p>
                            </div>
                        </div>
                        <div class="activity-list">
                            <div class="activity-row">
                                <span class="dot green"></span>
                                <div>
                                    <strong>Offer sent to Diego Martinez</strong>
                                    <p class="muted">Data Engineer • 25 minutes ago</p>
                                </div>
                            </div>
                            <div class="activity-row">
                                <span class="dot blue"></span>
                                <div>
                                    <strong>Interview scheduled for Alex Johnson</strong>
                                    <p class="muted">Senior Laravel Engineer • 1 hour ago</p>
                                </div>
                            </div>
                            <div class="activity-row">
                                <span class="dot purple"></span>
                                <div>
                                    <strong>Portfolio added by Priya Nair</strong>
                                    <p class="muted">Product Designer • 3 hours ago</p>
                                </div>
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
            <a href="{{ route('recruiter.applications') }}" class="mobile-nav-item active">
                <i class="fas fa-file-alt"></i>
                <span>Applications</span>
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
