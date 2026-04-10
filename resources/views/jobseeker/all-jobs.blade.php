<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Jobs</title>
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
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.dashboard'),
            ],
            [
                'label' => 'All Jobs',
                'icon' => 'fa-list',
                'active' => true,
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
            [
                'label' => 'Messages',
                'icon' => 'fa-envelope',
                'active' => false,
                'badge' => '3',
                'url' => route('jobseeker.messages'),
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-gear',
                'active' => false,
                'badge' => null,
                'url' => route('jobseeker.settings'),
            ],
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
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>All Jobs</h1>
                        <p>Browse open roles and apply quickly.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="panel" id="pageAlert"
                        style="margin-bottom: 12px; border-color: rgba(34, 197, 94, 0.28); background: linear-gradient(180deg, rgba(10, 28, 22, 0.96), rgba(10, 18, 35, 0.92)); display:flex; align-items:flex-start; justify-content:space-between; gap:12px;">
                        <div style="display:flex; gap:10px; align-items:flex-start;">
                            <div
                                style="width:38px; height:38px; border-radius:11px; display:inline-flex; align-items:center; justify-content:center; background:rgba(34,197,94,0.14); color:#86efac; flex-shrink:0;">
                                <i class="fas fa-circle-check"></i>
                            </div>
                            <div>
                                <strong style="color:#f8fafc; display:block; font-size:15px;">Application
                                    submitted</strong>
                                <span
                                    style="color:#c6d2e6; display:block; margin-top:4px; line-height:1.5;">{{ session('success') }}</span>
                            </div>
                        </div>
                        <button type="button" id="pageAlertClose" aria-label="Dismiss alert"
                            style="width:32px; height:32px; border-radius:9px; border:1px solid rgba(148,163,184,0.24); background:rgba(15,23,42,0.6); color:#dce5f6; cursor:pointer; flex-shrink:0;">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <section class="alljobs-list">
                    @forelse ($jobs as $job)
                        <article class="panel job-card">
                            <div class="job-main">
                                <div class="job-title-row">
                                    <h2 class="job-title">{{ ucfirst($job->job_title) }}</h2>
                                    <span class="mini-icon"></span>
                                </div>
                                <div class="job-meta">
                                    <span><i class="fas fa-location-dot"></i>
                                        <p>{{ ucfirst($job->location) ?? 'Remote' }}</p>
                                    </span>
                                    <span><i class="fas fa-briefcase"></i>
                                        <p>{{ ucfirst($job->work_type) ?? 'Remote' }}</p>
                                    </span>
                                    <span><i class="fas fa-id-card"></i>
                                        <p>{{ ucfirst($job->employment_type) ?? 'Full-time' }}</p>
                                    </span>
                                    <span><i class="fas fa-user-graduate"></i>
                                        <p>{{ ucfirst($job->experience_level) ?? 'N/A' }}</p>
                                    </span>
                                    @php
                                        $salaryMin = $job->min_salary;
                                        $salaryMax = $job->max_salary;
                                        $currency = $job->currency ?? 'USD';
                                        $salaryText =
                                            ($salaryMin ? $currency . ' ' . number_format($salaryMin) : 'N/A') .
                                            ' - ' .
                                            ($salaryMax ? $currency . ' ' . number_format($salaryMax) : 'N/A');
                                    @endphp
                                    <span><i class="fas fa-sack-dollar"></i>
                                        <p>{{ $salaryText }}</p>
                                    </span>
                                    @if ($job->closing_date)
                                        <span><i class="fas fa-calendar-day"></i>
                                            <p>Closes
                                                {{ \Carbon\Carbon::parse($job->closing_date)->format('M j, Y') }}</p>
                                        </span>
                                    @endif
                                </div>
                                @php
                                    $skills = $job->required_skills
                                        ? (is_array($job->required_skills)
                                            ? $job->required_skills
                                            : json_decode($job->required_skills, true))
                                        : [];
                                    $skills = $skills ?: ['No skills provided'];
                                    $jobSkillsArray = array_map('trim', explode(',', $skills));
                                @endphp
                                <div class="job-tags">
                                    @foreach ($jobSkillsArray as $tag)
                                        <span class="job-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="job-actions">
                                <form action="{{ route('jobseeker.save-job') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $job->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="saved_updated_at" value="{{ now() }}">
                                    @if ($job->applications()->where('user_id', Auth::user()->id)->where('is_saved', true)->exists())
                                        <button type="submit" class="btn-primary" disabled
                                            style="background: green; display:flex; gap: 6px;"><i
                                                class="fa fa-check-circle" aria-hidden="true"></i>
                                            <p>Saved</p>
                                        </button>
                                    @else
                                        <button type="submit" class="btn-ghost-alt" aria-label="Save job">Save</button>
                                    @endif
                                </form>
                                {{-- @if ($job->application_link) --}}
                                <a href="{{ route('jobseeker.job-detail', $job->slug) }}" class="btn-primary"
                                    rel="noopener">View / Apply</a>
                                {{-- @else --}}
                                {{-- <button type="button" class="btn-primary" aria-label="Apply to job">Apply</button> --}}
                                {{-- @endif --}}
                            </div>
                        </article>
                    @empty
                        <article class="panel job-card">
                            <div class="job-main">
                                <h2 class="job-title">No jobs yet</h2>
                                <p style="color:#c5d1e6;">Check back soon for new opportunities.</p>
                            </div>
                        </article>
                    @endforelse
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('jobseeker.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('jobseeker.all-jobs') }}" class="mobile-nav-item active">
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
        (function() {
            const alertBox = document.getElementById('pageAlert');
            const closeButton = document.getElementById('pageAlertClose');

            if (!alertBox) return;

            const dismiss = () => {
                alertBox.remove();
            };

            if (closeButton) {
                closeButton.addEventListener('click', dismiss);
            }

            window.setTimeout(dismiss, 3000);
        })();
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
