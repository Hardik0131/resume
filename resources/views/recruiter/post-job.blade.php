<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-post-job.css', 'resources/js/recruiter-post-job.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
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
                'active' => true,
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
                'active' => false,
                'badge' => null,
                'url' => route('recruiter.settings'),
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
                    <a href="#" class="menu-item">Logout</a>
                </div>
            </aside>
            <div class="sidebar-backdrop" id="recruiterBackdrop"></div>

            <main class="content postjob-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Post a Job</h1>
                        <p>Share a clear, compelling job to attract the right talent.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Drafts">
                            <i class="fas fa-save"></i>
                        </button>
                        <button type="button" class="icon-btn" aria-label="Preview">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <section class="panel steps-panel">
                    <div class="steps">
                        <span class="step active"><i class="fas fa-pen"></i> Details</span>
                        <span class="step"><i class="fas fa-list"></i> Requirements</span>
                        <span class="step"><i class="fas fa-dollar-sign"></i> Compensation</span>
                        <span class="step"><i class="fas fa-share-nodes"></i> Publish</span>
                    </div>
                    <div class="hint">Tip: Candidates respond better to concise descriptions and clear salary ranges.
                    </div>
                </section>

                @if (session('success'))
                    <div class="alert success-alert" data-auto-dismiss="3000" role="status" aria-live="polite">
                        <span class="alert-main">
                            <i class="fas fa-circle-check"></i>
                            <span>{{ session('success') }}</span>
                        </span>
                        <button type="button" class="alert-close" aria-label="Close alert">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @elseif (session('error'))
                    <div class="alert error-alert" data-auto-dismiss="3000" role="alert" aria-live="assertive">
                        <span class="alert-main">
                            <i class="fas fa-circle-exclamation"></i>
                            <span>{{ session('error') }}</span>
                        </span>
                        <button type="button" class="alert-close" aria-label="Close alert">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <section class="postjob-grid">
                    <article class="panel form-panel">
                        @include('recruiter.partials.job-form')
                    </article>

                    <article class="panel preview-panel">
                        @if ($draftJobCard)
                            <header class="preview-header">
                                <div>
                                    <p class="muted">Live Preview</p>
                                    <h2>{{ $draftJobCard->job_title ?? 'Untitled draft' }}</h2>
                                    @php
                                        $currencySymbol = match ($draftJobCard->currency ?? '') {
                                            'USD' => '$',
                                            'INR' => '₹',
                                            'EUR' => '€',
                                            default => '',
                                        };

                                        $salaryRange =
                                            $draftJobCard->min_salary && $draftJobCard->max_salary
                                                ? $currencySymbol .
                                                    number_format($draftJobCard->min_salary) .
                                                    ' - ' .
                                                    $currencySymbol .
                                                    number_format($draftJobCard->max_salary)
                                                : 'Salary TBD';
                                    @endphp
                                    <p class="sub">
                                        {{ $draftJobCard->location ?? 'Location TBD' }} •
                                        {{ $draftJobCard->employment_type ?? 'Type TBD' }} •
                                        {{ $salaryRange }}
                                    </p>
                                </div>
                                <span class="pill">Draft</span>
                            </header>
                            <div class="preview-meta">
                                <div class="preview-meta-item">
                                    <i class="fas fa-building"></i>
                                    <span>{{ $draftJobCard->department ?? 'Department TBD' }}</span>
                                </div>
                                <div class="preview-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Updated {{ $draftJobCard->updated_at->diffForHumans() ?? 'just now' }}</span>
                                </div>
                                <div class="preview-meta-item">
                                    <i class="fas fa-globe"></i>
                                    <span>{{ $draftJobCard->work_type ?? 'Work type TBD' }}</span>
                                </div>
                            </div>
                            <div class="preview-body">
                                <h3>About the role</h3>
                                @php
                                    $aboutLines = collect(
                                        preg_split('/\r\n|\r|\n/', (string) $draftJobCard->job_description),
                                    )
                                        ->map(fn($line) => trim($line))
                                        ->filter()
                                        ->values();
                                @endphp
                                @if ($aboutLines->isNotEmpty())
                                    <ul>
                                        @foreach ($aboutLines as $line)
                                            <li>{{ $line }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No description added yet.</p>
                                @endif
                                <h3>Requirements</h3>
                                @php
                                    $skills = $draftJobCard->required_skills
                                        ? (is_array($draftJobCard->required_skills)
                                            ? $draftJobCard->required_skills
                                            : json_decode($draftJobCard->required_skills, true))
                                        : [];
                                    $skills = $skills ?: ['No skills provided'];
                                    $jobSkillsArray = array_map('trim', explode(',', $skills));
                                @endphp
                                <div class="job-tags" style="display: flex; flex-wrap: wrap; gap: 8px;">
                                    @foreach ($jobSkillsArray as $tag)
                                        <span class="pill">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="preview-actions">
                                <button type="button" class="btn-ghost">Copy link</button>
                                <a href="{{ route('recruiter.edit-job', $draftJobCard->slug) }}">
                                    <button type="button" class="btn-primary">
                                        Preview as
                                        candidate
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="draft-empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-file-circle-plus"></i>
                                </div>
                                <h3>No Draft Job Yet</h3>
                                <p>Your saved draft jobs will appear here. Start filling the form and save it as draft.
                                </p>
                            </div>
                        @endif
                    </article>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('recruiter.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('recruiter.post-job') }}" class="mobile-nav-item active">
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
            co

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
