<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-candidates.css'])
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
                'active' => true,
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

        $candidates = [
            [
                'name' => 'Alex Johnson',
                'role' => 'Senior Laravel Engineer',
                'location' => 'Remote (US/EU overlap)',
                'match' => '92%',
                'availability' => '2 weeks',
                'tags' => ['Laravel', 'MySQL', 'REST APIs', 'AWS'],
                'stage' => 'Interviewing',
                'stage_class' => 'stage-interview',
                'updated' => '30m ago',
            ],
            [
                'name' => 'Priya Nair',
                'role' => 'Product Designer (UI/UX)',
                'location' => 'Bangalore, IN',
                'match' => '84%',
                'availability' => 'Immediate',
                'tags' => ['Figma', 'Design systems', 'Prototyping'],
                'stage' => 'Shortlisted',
                'stage_class' => 'stage-shortlist',
                'updated' => '1h ago',
            ],
            [
                'name' => 'Diego Martinez',
                'role' => 'Data Engineer',
                'location' => 'Barcelona (Remote EU)',
                'match' => '88%',
                'availability' => '3 weeks',
                'tags' => ['Python', 'Airflow', 'Snowflake', 'DBT'],
                'stage' => 'Offer out',
                'stage_class' => 'stage-offer',
                'updated' => 'Today',
            ],
            [
                'name' => 'Sara Lee',
                'role' => 'Customer Success Lead',
                'location' => 'Austin, TX',
                'match' => '76%',
                'availability' => '1 month',
                'tags' => ['B2B SaaS', 'Playbooks', 'Renewals'],
                'stage' => 'Screening',
                'stage_class' => 'stage-screening',
                'updated' => '2h ago',
            ],
            [
                'name' => 'Kenji Tanaka',
                'role' => 'Frontend Developer (React)',
                'location' => 'Tokyo (Hybrid)',
                'match' => '81%',
                'availability' => 'Notice: 1 month',
                'tags' => ['React', 'TypeScript', 'UI animations'],
                'stage' => 'New',
                'stage_class' => 'stage-new',
                'updated' => '3h ago',
            ],
        ];

        $talentSignals = [
            ['label' => 'Highly aligned', 'value' => '36'],
            ['label' => 'Ready to interview', 'value' => '12'],
            ['label' => 'Needs review', 'value' => '18'],
            ['label' => 'Dormant >30d', 'value' => '6'],
        ];

        $shortlist = [
            ['name' => 'Alex Johnson', 'role' => 'Senior Laravel Engineer', 'note' => 'Strong on queues + scaling'],
            ['name' => 'Priya Nair', 'role' => 'Product Designer', 'note' => 'Systems thinker, case study ready'],
            ['name' => 'Diego Martinez', 'role' => 'Data Engineer', 'note' => 'Great on cost optimization'],
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

            <main class="content candidates-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Candidates</h1>
                        <p>Search, shortlist, and progress talent across every role.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Save view"><i
                                class="fas fa-bookmark"></i></button>
                        <button type="button" class="icon-btn" aria-label="Refresh"><i
                                class="fas fa-rotate"></i></button>
                    </div>
                </div>

                <section class="summary-grid">
                    <article class="summary-card">
                        <p class="muted">Talent pool</p>
                        <h3>186</h3>
                        <span class="pill green">+18 this week</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">Ready to interview</p>
                        <h3>24</h3>
                        <span class="pill blue">12 for engineering</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">Offers out</p>
                        <h3>4</h3>
                        <span class="pill orange">3 awaiting reply</span>
                    </article>
                    <article class="summary-card">
                        <p class="muted">Nudges due</p>
                        <h3>9</h3>
                        <span class="pill purple">Send follow-ups</span>
                    </article>
                </section>

                <section class="filters-panel">
                    <div class="filter-bar">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by name, skill, or company"
                                aria-label="Search candidates">
                        </div>
                        <select aria-label="Role filter">
                            <option>All roles</option>
                            <option>Senior Laravel Engineer</option>
                            <option>Product Designer</option>
                            <option>Data Engineer</option>
                            <option>Customer Success Lead</option>
                        </select>
                        <select aria-label="Stage filter">
                            <option>All stages</option>
                            <option>New</option>
                            <option>Screening</option>
                            <option>Interviewing</option>
                            <option>Offer</option>
                        </select>
                        <select aria-label="Availability filter">
                            <option>Any availability</option>
                            <option>Immediate</option>
                            <option>&lt; 2 weeks</option>
                            <option>&lt; 1 month</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Apply</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> New this week</span>
                        <span class="filter-chip"><i class="fas fa-clipboard-check"></i> Shortlisted</span>
                        <span class="filter-chip"><i class="fas fa-laptop-code"></i> Backend</span>
                        <span class="filter-chip"><i class="fas fa-globe"></i> Remote</span>
                        <span class="filter-chip"><i class="fas fa-building"></i> Design</span>
                    </div>
                </section>

                <section class="candidates-grid">
                    <article class="panel candidate-list-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Talent stream</h2>
                                <p class="muted" style="margin: 4px 0 0;">Ranked by match, stage, and recency.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Export</button>
                                <button type="button" class="btn-primary">Bulk message</button>
                            </div>
                        </header>

                        <div class="candidate-list">
                            @foreach ($candidates as $person)
                                <article class="candidate-row">
                                    <div class="row-main">
                                        <div class="avatar"><i class="fas fa-user"></i></div>
                                        <div class="candidate-text">
                                            <div class="name-line">
                                                <strong>{{ $person['name'] }}</strong>
                                                <span
                                                    class="stage-badge {{ $person['stage_class'] }}">{{ $person['stage'] }}</span>
                                                <span class="match">{{ $person['match'] }} match</span>
                                            </div>
                                            <p class="muted">{{ $person['role'] }} • {{ $person['location'] }} •
                                                Available {{ $person['availability'] }}</p>
                                            <div class="tag-row">
                                                @foreach ($person['tags'] as $tag)
                                                    <span class="tag">{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-meta">
                                        <span class="muted">Updated {{ $person['updated'] }}</span>
                                        <div class="row-actions">
                                            <button type="button" class="btn-ghost">Profile</button>
                                            <button type="button" class="btn-primary">Advance</button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel candidate-side">
                        <header class="panel-header" style="margin-bottom: 6px;">
                            <div>
                                <h2 style="margin: 0;">Signals</h2>
                                <p class="muted" style="margin: 4px 0 0;">Where to focus first.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Refresh</button>
                            </div>
                        </header>
                        <div class="signal-list">
                            @foreach ($talentSignals as $item)
                                <div class="signal-row">
                                    <strong>{{ $item['value'] }}</strong>
                                    <span class="muted">{{ $item['label'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 10px;">
                            <div>
                                <h3 style="margin: 0;">Shortlist</h3>
                                <p class="muted" style="margin: 4px 0 0;">Pin best-fit candidates.</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-primary">Share</button>
                            </div>
                        </div>
                        <div class="shortlist">
                            @foreach ($shortlist as $item)
                                <div class="shortlist-row">
                                    <div>
                                        <strong>{{ $item['name'] }}</strong>
                                        <p class="muted">{{ $item['role'] }}</p>
                                        <span class="muted">{{ $item['note'] }}</span>
                                    </div>
                                    <button type="button" class="btn-ghost">View</button>
                                </div>
                            @endforeach
                        </div>

                        <div class="panel-header" style="margin-top: 10px;">
                            <div>
                                <h3 style="margin: 0;">Talent notes</h3>
                                <p class="muted" style="margin: 4px 0 0;">Recent interactions and nudges.</p>
                            </div>
                        </div>
                        <div class="activity-list">
                            <div class="activity-row">
                                <span class="dot green"></span>
                                <div>
                                    <strong>Replied: Alex Johnson</strong>
                                    <p class="muted">Confirmed tech screen • 20m ago</p>
                                </div>
                            </div>
                            <div class="activity-row">
                                <span class="dot blue"></span>
                                <div>
                                    <strong>Portfolio added: Priya Nair</strong>
                                    <p class="muted">New case study uploaded • 1h ago</p>
                                </div>
                            </div>
                            <div class="activity-row">
                                <span class="dot purple"></span>
                                <div>
                                    <strong>Nudge sent: Sara Lee</strong>
                                    <p class="muted">Waiting on screening form • 2h ago</p>
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
            <a href="#" class="mobile-nav-item active">
                <i class="fas fa-users"></i>
                <span>Candidates</span>
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
