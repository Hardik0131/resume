<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Detail | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-application-view.css'])
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

        $applicationId = $id ?? 1;

        $applicant = [
            'name' => 'Alex Johnson',
            'job_title' => 'Senior Laravel Engineer',
            'application_code' => 'APP' . str_pad((string) $applicationId, 4, '0', STR_PAD_LEFT),
            'location' => 'Remote',
            'email' => 'alex.johnson@mail.com',
            'phone' => '+1 415 555 0183',
            'experience' => '6 years',
            'current_company' => 'NexaSoft Labs',
            'notice_period' => '30 days',
            'expected_salary' => '$95,000 / year',
            'score' => 86,
            'status' => 'Interview',
            'status_class' => 'status-interview',
            'summary' =>
                'Senior backend engineer focused on Laravel architecture, API performance, and clean code practices. Built multi-tenant SaaS products and led migrations from monolith to modular services.',
        ];

        $skills = ['Laravel', 'PHP 8', 'REST APIs', 'MySQL', 'Redis', 'Docker', 'AWS'];

        $timeline = [
            ['title' => 'Application submitted', 'date' => 'Mar 31, 2026 - 09:40 AM', 'class' => 'dot-blue'],
            ['title' => 'Recruiter shortlist', 'date' => 'Mar 31, 2026 - 11:15 AM', 'class' => 'dot-purple'],
            ['title' => 'Screening call completed', 'date' => 'Apr 01, 2026 - 04:00 PM', 'class' => 'dot-green'],
            ['title' => 'Technical interview pending', 'date' => 'Scheduled for Apr 04, 2026', 'class' => 'dot-orange'],
        ];

        $answers = [
            [
                'question' => 'Why are you a fit for this role?',
                'answer' => 'I have shipped high-traffic Laravel platforms and improved API response times by over 40%.',
            ],
            [
                'question' => 'What is your expected CTC?',
                'answer' => '$95,000 per year (negotiable based on benefits and growth scope).',
            ],
            [
                'question' => 'When can you join?',
                'answer' => 'Within 30 days after final offer.',
            ],
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

            <main class="content application-view-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Application Detail</h1>
                        <p>Review applicant profile, timeline, and actions before moving to the next stage.</p>
                    </div>
                    <div class="top-actions">
                        <a href="{{ route('recruiter.applications') }}" class="btn-ghost"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="button" class="btn-primary"><i class="fas fa-user-check"></i> Move to Next Stage</button>
                    </div>
                </div>

                <section class="application-grid">
                    <article class="panel profile-panel">
                        <div class="profile-head">
                            <div class="avatar-lg"><i class="fas fa-user"></i></div>
                            <div>
                                <p class="app-code">#{{ $applicant['application_code'] }}</p>
                                <h2>{{ $applicant['name'] }}</h2>
                                <p class="muted">{{ $applicant['job_title'] }} - {{ $applicant['location'] }}</p>
                                <span class="status-badge {{ $applicant['status_class'] }}">{{ $applicant['status'] }}</span>
                            </div>
                        </div>

                        <div class="info-grid">
                            <div class="info-box"><span>Email</span><strong>{{ $applicant['email'] }}</strong></div>
                            <div class="info-box"><span>Phone</span><strong>{{ $applicant['phone'] }}</strong></div>
                            <div class="info-box"><span>Experience</span><strong>{{ $applicant['experience'] }}</strong></div>
                            <div class="info-box"><span>Current Company</span><strong>{{ $applicant['current_company'] }}</strong></div>
                            <div class="info-box"><span>Notice Period</span><strong>{{ $applicant['notice_period'] }}</strong></div>
                            <div class="info-box"><span>Expected Salary</span><strong>{{ $applicant['expected_salary'] }}</strong></div>
                        </div>

                        <div class="score-wrap">
                            <span>Match Score</span>
                            <strong>{{ $applicant['score'] }}/100</strong>
                        </div>

                        <div class="summary-box">
                            <h3>Professional Summary</h3>
                            <p>{{ $applicant['summary'] }}</p>
                        </div>

                        <div class="tag-row">
                            @foreach ($skills as $skill)
                                <span class="tag">{{ $skill }}</span>
                            @endforeach
                        </div>

                        <div class="profile-actions">
                            <button type="button" class="btn-ghost"><i class="fas fa-download"></i> Resume</button>
                            <button type="button" class="btn-ghost"><i class="fas fa-envelope"></i> Message</button>
                            <button type="button" class="btn-primary"><i class="fas fa-calendar-check"></i> Schedule Interview</button>
                        </div>
                    </article>

                    <article class="panel side-panel">
                        <div class="timeline-card">
                            <h3>Application Timeline</h3>
                            <div class="timeline-list">
                                @foreach ($timeline as $item)
                                    <div class="timeline-row">
                                        <span class="dot {{ $item['class'] }}"></span>
                                        <div>
                                            <strong>{{ $item['title'] }}</strong>
                                            <p class="muted">{{ $item['date'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="qa-card">
                            <h3>Screening Answers</h3>
                            <div class="qa-list">
                                @foreach ($answers as $item)
                                    <div class="qa-item">
                                        <strong>{{ $item['question'] }}</strong>
                                        <p>{{ $item['answer'] }}</p>
                                    </div>
                                @endforeach
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
