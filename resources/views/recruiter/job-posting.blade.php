<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Postings | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-job-postings.css'])
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
                'active' => true,
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
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.settings'),
            ],
        ];

        // $jobPostings = [
        //     [
        //         'title' => 'Senior Laravel Engineer',
        //         'department' => 'Engineering',
        //         'location' => 'Remote, Global',
        //         'work_type' => 'Remote',
        //         'employment_type' => 'Full-time',
        //         'salary' => '$90k – $120k',
        //         'status' => 'active',
        //         'status_label' => 'Active',
        //         'applicants' => 128,
        //         'new' => 14,
        //         'views' => 1820,
        //         'posted' => '5 days ago',
        //         'closing' => 'May 18, 2026',
        //         'tags' => ['Laravel', 'MySQL', 'REST APIs', 'AWS'],
        //         'pipeline' => [
        //             'New' => 68,
        //             'Screening' => 28,
        //             'Interview' => 14,
        //             'Offer' => 4,
        //         ],
        //     ],
        //     [
        //         'title' => 'Product Designer (UI/UX)',
        //         'department' => 'Design',
        //         'location' => 'Bangalore, IN',
        //         'work_type' => 'Hybrid',
        //         'employment_type' => 'Full-time',
        //         'salary' => '₹28L – ₹36L',
        //         'status' => 'paused',
        //         'status_label' => 'Paused',
        //         'applicants' => 74,
        //         'new' => 6,
        //         'views' => 940,
        //         'posted' => '2 weeks ago',
        //         'closing' => 'May 05, 2026',
        //         'tags' => ['Figma', 'Design systems', 'Prototyping'],
        //         'pipeline' => [
        //             'New' => 30,
        //             'Screening' => 18,
        //             'Interview' => 9,
        //             'Offer' => 2,
        //         ],
        //     ],
        //     [
        //         'title' => 'Data Engineer',
        //         'department' => 'Data',
        //         'location' => 'Remote, EU timezone',
        //         'work_type' => 'Remote',
        //         'employment_type' => 'Contract',
        //         'salary' => '€55 – €70/hr',
        //         'status' => 'active',
        //         'status_label' => 'Active',
        //         'applicants' => 92,
        //         'new' => 11,
        //         'views' => 1240,
        //         'posted' => '8 days ago',
        //         'closing' => 'May 27, 2026',
        //         'tags' => ['Python', 'Airflow', 'Snowflake', 'DBT'],
        //         'pipeline' => [
        //             'New' => 40,
        //             'Screening' => 22,
        //             'Interview' => 8,
        //             'Offer' => 3,
        //         ],
        //     ],
        //     [
        //         'title' => 'Customer Success Lead',
        //         'department' => 'Customer Success',
        //         'location' => 'Austin, TX',
        //         'work_type' => 'On-site',
        //         'employment_type' => 'Full-time',
        //         'salary' => '$80k – $95k',
        //         'status' => 'draft',
        //         'status_label' => 'Draft',
        //         'applicants' => 0,
        //         'new' => 0,
        //         'views' => 120,
        //         'posted' => 'Draft',
        //         'closing' => 'Not scheduled',
        //         'tags' => ['B2B', 'Playbooks', 'Renewals'],
        //         'pipeline' => [
        //             'New' => 0,
        //             'Screening' => 0,
        //             'Interview' => 0,
        //             'Offer' => 0,
        //         ],
        //     ],
        // ];

        $pipelineSummary = [
            ['label' => 'Screening', 'value' => 42, 'total' => 100],
            ['label' => 'Interviews scheduled', 'value' => 28, 'total' => 60],
            ['label' => 'Offers out', 'value' => 6, 'total' => 14],
            ['label' => 'Hires this month', 'value' => 3, 'total' => 6],
        ];

        $closingSoon = [
            ['title' => 'Product Designer', 'closing' => 'May 05', 'status' => 'Paused'],
            ['title' => 'Senior Laravel Engineer', 'closing' => 'May 18', 'status' => 'Active'],
            ['title' => 'Data Engineer', 'closing' => 'May 27', 'status' => 'Active'],
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

            <main class="content jobposting-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Job Postings</h1>
                        <p>Monitor performance, stages, and deadlines across every open role.</p>
                    </div>
                    <div class="top-actions">
                        <a href="{{ route('recruiter.post-job') }}" class="pill-btn primary">+ Post Job</a>
                        <button type="button" class="icon-btn" aria-label="Refresh">
                            <i class="fas fa-rotate"></i>
                        </button>
                        <button type="button" class="icon-btn" aria-label="Notifications">
                            <i class="fas fa-bell"></i>
                        </button>
                    </div>
                </div>

                <section class="overview-grid">
                    <article class="stat-card blue wave">
                        <h3>Active roles</h3>
                        <p>{{ $activeRoleCount }}</p>
                        <small>{{ $closingSoonCount }} closing this month</small>
                    </article>
                    <article class="stat-card purple wave">
                        <h3>Total applicants</h3>
                        <p>421</p>
                        <small>32 new this week</small>
                    </article>
                    <article class="stat-card green wave">
                        <h3>Interviews</h3>
                        <p>46</p>
                        <small>12 scheduled today</small>
                    </article>
                    <article class="stat-card orange wave">
                        <h3>Offers</h3>
                        <p>9</p>
                        <small>3 awaiting response</small>
                    </article>
                </section>

                <section class="filters-panel" aria-label="Filters">
                    <div class="filters-grid">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by role, team, or location"
                                aria-label="Search job postings">
                        </div>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Active</option>
                            <option>Paused</option>
                            <option>Draft</option>
                            <option>Closed</option>
                        </select>
                        <select aria-label="Team filter">
                            <option>All teams</option>
                            <option>Engineering</option>
                            <option>Design</option>
                            <option>Product</option>
                            <option>Marketing</option>
                        </select>
                        <select aria-label="Location filter">
                            <option>Anywhere</option>
                            <option>Remote</option>
                            <option>On-site</option>
                            <option>Hybrid</option>
                        </select>
                        <div style="justify-self: flex-end; display: flex; gap: 8px;">
                            <button type="button" class="btn-ghost">Save view</button>
                            <button type="button" class="btn-primary">Apply</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-circle text-green"></i> Active roles</span>
                        <span class="filter-chip"><i class="fas fa-hourglass-half"></i> Closing soon</span>
                        <span class="filter-chip"><i class="fas fa-bolt"></i> High priority</span>
                        <span class="filter-chip"><i class="fas fa-moon"></i> Drafts</span>
                        <span class="filter-chip"><i class="fas fa-globe"></i> Remote-friendly</span>
                    </div>
                </section>

                <section class="job-grid">
                    <article class="job-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Open & draft roles</h2>
                                <p class="muted" style="margin: 4px 0 0;">Track candidates, stage movement, and
                                    deadlines at a glance.</p>
                            </div>
                            <div class="panel-actions">
                                <a href="#" class="pill-btn secondary">Export CSV</a>
                                <a href="{{ route('recruiter.post-job') }}" class="pill-btn primary">+ New posting</a>
                            </div>
                        </header>

                        <div class="job-list {{ $listings->count() === 1 ? 'single-card' : '' }}">
                            @foreach ($listings as $job)
                                {{-- @php
                                    $pipelineTotal = array_sum($job['pipeline']);
                                @endphp --}}
                                @php
                                    if ($job->currency === 'USD') {
                                        $salary =
                                            '$' .
                                            number_format($job->min_salary / 1000, 0) .
                                            'k - ' .
                                            '$' .
                                            number_format($job->max_salary / 1000, 0) .
                                            'k';
                                    } elseif ($job->currency === 'INR') {
                                        $salary =
                                            '₹' .
                                            number_format($job->min_salary / 100000, 0) .
                                            'L - ' .
                                            '₹' .
                                            number_format($job->max_salary / 100000, 0) .
                                            'L';
                                    } elseif ($job->currency === 'EUR') {
                                        $salary =
                                            '€' .
                                            number_format($job->min_salary / 100, 0) .
                                            ' - ' .
                                            '€' .
                                            number_format($job->max_salary / 100, 0);
                                    } else {
                                        $salary =
                                            number_format($job->min_salary, 0) .
                                            ' - ' .
                                            number_format($job->max_salary, 0);
                                    }
                                @endphp
                                <article class="job-card">
                                    <header>
                                        <div>
                                            <h3 class="job-title">{{ ucfirst($job->job_title) }}</h3>
                                            <p class="job-sub">{{ ucfirst($job->company_name) }} • {{ ucfirst($job->location) }} •
                                                {{ $job->employment_type }} • {{ $salary }}</p>
                                        </div>
                                        <span class="status-pill status-{{ $job->status }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </header>

                                    @php
                                        if($job->published_at === null){
                                            $job->published_at = 'Draft Not Published';
                                        }
                                    @endphp

                                    <div class="job-meta">
                                        <span><i class="fas fa-calendar"></i> Posted
                                            @if($job->published_at !== null && $job->published_at !== 'Draft Not Published')
                                                {{ \Carbon\Carbon::parse($job->published_at)->diffForHumans() }}    
                                            @else
                                                {{ $job->published_at }}  
                                            @endif
                                        </span>
                                        <span><i class="fas fa-flag-checkered"></i> Closes
                                            {{ \Carbon\Carbon::parse($job->closing_date)->format('M j, Y') }}</span>
                                        <span><i class="fas fa-location-dot"></i> {{ $job->work_type }}</span>
                                        <span><i class="fas fa-user"></i> {{ $job->applicants ?? 0 }} applicants</span>
                                    </div>

                                    @php
                                        $skills = $job->required_skills
                                            ? (is_array($job->required_skills)
                                                ? $job->required_skills
                                                : json_decode($job->required_skills))
                                            : [];
                                        $skills = $skills ?: ['No skills listed'];
                                        $skillJobArray = array_map('trim', explode(',', $skills));
                                    @endphp
                                    <div class="job-tags">
                                        @foreach ($skillJobArray as $skill)
                                            <span class="job-tag">{{ strtoupper($skill) }}</span>
                                        @endforeach
                                    </div>

                                    @php
                                        $job->new = 6;
                                        $job->views = 1000;
                                        $job->applicants = 10;
                                    @endphp

                                    <div class="metrics">
                                        <span class="metric-chip"><i class="fas fa-user-plus"></i>
                                            {{ $job->new }} new</span>
                                        <span class="metric-chip"><i class="fas fa-eye"></i> {{ $job->views }}
                                            views</span>
                                        <span class="metric-chip"><i class="fas fa-check-circle"></i>
                                            {{ $job->applicants - $job->new }} reviewed</span>
                                    </div>

                                    <div class="stage-bar">
                                        {{-- @foreach ($job['pipeline'] as $stage => $count)
                                            @php
                                                $width =
                                                    $pipelineTotal > 0
                                                        ? round(($count / max($pipelineTotal, 1)) * 100)
                                                        : 0;
                                            @endphp
                                            <div class="stage-row">
                                                <span>{{ $stage }}</span>
                                                <span>{{ $count }}</span>
                                                <div class="bar-track" aria-hidden="true">
                                                    <span class="bar-fill"
                                                        style="width: {{ $width }}%"></span>
                                                </div>
                                            </div>
                                        @endforeach --}}
                                    </div>

                                    <div class="job-actions">
                                        <button type="button" class="btn-ghost">Preview</button>
                                        <button type="button" class="btn-ghost">Share</button>
                                        <button type="button" class="btn-primary">View candidates</button>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        @if ($listings->hasPages())
                            @php
                                $currentPage = $listings->currentPage();
                                $lastPage = $listings->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp
                            <nav class="job-pagination" aria-label="Job postings pagination">
                                <a href="{{ $listings->onFirstPage() ? '#' : $listings->previousPageUrl() }}"
                                    class="page-link {{ $listings->onFirstPage() ? 'disabled' : '' }}"
                                    aria-disabled="{{ $listings->onFirstPage() ? 'true' : 'false' }}">
                                    <i class="fas fa-chevron-left"></i>
                                    Prev
                                </a>

                                <div class="page-numbers">
                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        <a href="{{ $listings->url($page) }}"
                                            class="page-link {{ $page === $currentPage ? 'active' : '' }}"
                                            aria-current="{{ $page === $currentPage ? 'page' : 'false' }}">
                                            {{ $page }}
                                        </a>
                                    @endfor
                                </div>

                                <a href="{{ $listings->hasMorePages() ? $listings->nextPageUrl() : '#' }}"
                                    class="page-link {{ $listings->hasMorePages() ? '' : 'disabled' }}"
                                    aria-disabled="{{ $listings->hasMorePages() ? 'false' : 'true' }}">
                                    Next
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        @endif
                    </article>

                    <article class="insights-panel">
                        <div class="panel-header" style="margin-bottom: 6px;">
                            <div>
                                <h2 style="margin: 0;">Pipeline health</h2>
                                <p class="muted" style="margin: 4px 0 0;">Where candidates sit across stages.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Refresh</button>
                            </div>
                        </div>

                        <div class="pipeline">
                            @foreach ($pipelineSummary as $row)
                                @php
                                    $pct = $row['total'] > 0 ? round(($row['value'] / $row['total']) * 100) : 0;
                                @endphp
                                <div class="pipeline-row">
                                    <div class="row-top">
                                        <span>{{ $row['label'] }}</span>
                                        <strong>{{ $row['value'] }} / {{ $row['total'] }}</strong>
                                    </div>
                                    <div class="bar-track" aria-hidden="true">
                                        <span class="bar-fill" style="width: {{ $pct }}%"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 8px;">
                            <div>
                                <h3>Closing soon</h3>
                                <p class="muted" style="margin: 4px 0 0;">Prioritize roles nearing their deadline.
                                </p>
                            </div>
                        </div>
                        <div class="closing-soon">
                            @foreach ($closingSoon as $item)
                                <div class="closing-item">
                                    <div class="label">
                                        <strong>{{ $item['title'] }}</strong>
                                        <span>Closes {{ $item['closing'] }}</span>
                                    </div>
                                    <span class="pill">{{ $item['status'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 8px;">
                            <div>
                                <h3>Checklist</h3>
                                <p class="muted" style="margin: 4px 0 0;">Quick wins to boost applicants.</p>
                            </div>
                        </div>
                        <div class="checklist" aria-label="Job posting checklist">
                            <div class="checklist-item">
                                <i class="fas fa-bolt"></i>
                                <span>Add screening questions to top roles</span>
                            </div>
                            <div class="checklist-item">
                                <i class="fas fa-share-nodes"></i>
                                <span>Share active postings to the talent pool</span>
                            </div>
                            <div class="checklist-item">
                                <i class="fas fa-pen"></i>
                                <span>Refresh descriptions older than 30 days</span>
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
            <a href="{{ route('recruiter.job-postings') }}" class="mobile-nav-item active">
                <i class="fas fa-briefcase"></i>
                <span>Postings</span>
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
