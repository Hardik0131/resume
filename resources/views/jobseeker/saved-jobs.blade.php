<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Jobs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/jobseeker-dashboard.css', 'resources/css/jobseeker-saved.css'])
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
                'active' => true,
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

        // $savedJobs = [
        //     [
        //         'title' => 'Lead Laravel Engineer',
        //         'company' => 'Skyline Apps',
        //         'location' => 'Remote • GMT+5:30',
        //         'type' => 'Full-time',
        //         'tags' => ['Laravel', 'API', 'PostgreSQL'],
        //         'saved_on' => 'Mar 15, 2026',
        //         'salary' => '$90k - $110k',
        //     ],
        //     [
        //         'title' => 'Frontend Developer (Vue)',
        //         'company' => 'Citrus Digital',
        //         'location' => 'Hybrid • Mumbai',
        //         'type' => 'Hybrid',
        //         'tags' => ['Vue', 'Tailwind', 'UX'],
        //         'saved_on' => 'Mar 10, 2026',
        //         'salary' => '$70k - $85k',
        //     ],
        //     [
        //         'title' => 'Data Engineer',
        //         'company' => 'Northwind Analytics',
        //         'location' => 'On-site • Pune',
        //         'type' => 'Full-time',
        //         'tags' => ['Python', 'Airflow', 'ETL'],
        //         'saved_on' => 'Feb 28, 2026',
        //         'salary' => '$95k - $120k',
        //     ],
        //     [
        //         'title' => 'Product Designer',
        //         'company' => 'Bright Pixel Studio',
        //         'location' => 'Remote',
        //         'type' => 'Contract',
        //         'tags' => ['Figma', 'Design Systems'],
        //         'saved_on' => 'Feb 22, 2026',
        //         'salary' => '$60/hr',
        //     ],
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

            <main class="content saved-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Saved Jobs</h1>
                        <p>Revisit the roles you bookmarked and apply when ready.</p>
                    </div>
                    <form class="search-wrap" role="search">
                        <i class="fas fa-magnifying-glass"></i>
                        <input type="search" placeholder="Search saved jobs" aria-label="Search saved jobs">
                        <button type="button" class="ghost-btn"><i class="fas fa-sliders"></i> Filters</button>
                    </form>
                </div>

                <section class="panel filters-panel">
                    <div class="filters-row">
                        <span class="chip active">All</span>
                        <span class="chip">Remote</span>
                        <span class="chip">Full-time</span>
                        <span class="chip">Contract</span>
                        <span class="chip">Design</span>
                        <span class="chip">Engineering</span>
                    </div>
                    <div class="sort-row">
                        <div class="sort-pill">
                            <i class="fas fa-arrow-down-short-wide"></i>
                            <span>Sort: Recently saved</span>
                        </div>
                        <div class="sort-pill">
                            <i class="fas fa-location-dot"></i>
                            <span>Location: Any</span>
                        </div>
                        <div class="sort-pill subtle">{{ $savedJobCount }} Saved jobs</div>
                    </div>
                </section>

                @if (session('success'))
                    <div class="panel" id="pageAlert"
                        style="margin-bottom: 12px; border-color: rgba(34, 197, 94, 0.28); background: linear-gradient(180deg, rgba(10, 28, 22, 0.96), rgba(10, 18, 35, 0.92)); display:flex; align-items:flex-start; justify-content:space-between; gap:12px;">
                        <div style="display:flex; gap:10px; align-items:flex-start;">
                            <div
                                style="width:38px; height:38px; border-radius:11px; display:inline-flex; align-items:center; justify-content:center; background:rgba(34,197,94,0.14); color:#86efac; flex-shrink:0;">
                                <i class="fas fa-circle-check"></i>
                            </div>
                            <div>
                                <strong style="color:#f8fafc; display:block; font-size:15px;">Success</strong>
                                <span
                                    style="color:#c6d2e6; display:block; margin-top:4px; line-height:1.5;">{{ session('success') }}</span>
                            </div>
                        </div>
                        <button type="button" class="page-alert-close" data-alert-target="pageAlert"
                            aria-label="Dismiss alert"
                            style="width:32px; height:32px; border-radius:9px; border:1px solid rgba(148,163,184,0.24); background:rgba(15,23,42,0.6); color:#dce5f6; cursor:pointer; flex-shrink:0;">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if (session('error') || $errors->any())
                    <div class="panel" id="pageErrorAlert"
                        style="margin-bottom: 12px; border-color: rgba(239, 68, 68, 0.35); background: linear-gradient(180deg, rgba(45, 12, 12, 0.96), rgba(22, 14, 32, 0.92)); display:flex; align-items:flex-start; justify-content:space-between; gap:12px;">
                        <div style="display:flex; gap:10px; align-items:flex-start;">
                            <div
                                style="width:38px; height:38px; border-radius:11px; display:inline-flex; align-items:center; justify-content:center; background:rgba(239,68,68,0.16); color:#fca5a5; flex-shrink:0;">
                                <i class="fas fa-triangle-exclamation"></i>
                            </div>
                            <div>
                                <strong style="color:#fee2e2; display:block; font-size:15px;">Something went
                                    wrong</strong>
                                @if (session('error'))
                                    <span
                                        style="color:#fecaca; display:block; margin-top:4px; line-height:1.5;">{{ session('error') }}</span>
                                @elseif ($errors->any())
                                    <span style="color:#fecaca; display:block; margin-top:4px; line-height:1.5;">
                                        {{ $errors->first() }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="button" class="page-alert-close" data-alert-target="pageErrorAlert"
                            aria-label="Dismiss error alert"
                            style="width:32px; height:32px; border-radius:9px; border:1px solid rgba(248,113,113,0.35); background:rgba(38,18,18,0.7); color:#fee2e2; cursor:pointer; flex-shrink:0;">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <section class="saved-grid">
                    @forelse ($savedJobs as $job)
                        <article class="panel saved-card">
                            <header class="saved-header">
                                <div>
                                    <h2>{{ ucfirst($job->job_title) }}</h2>
                                    <p class="company">{{ ucfirst($job->company_name) ?: 'Fix it after saving' }}</p>
                                    <p class="meta">{{ ucfirst($job->location) ?: 'Location not specified' }} •
                                        {{ ucfirst($job->type) ?: 'Type not specified' }}</p>
                                </div>
                                <div class="pill">Saved
                                    {{ \Carbon\Carbon::parse($job->applications->first()->saved_updated_at)->format('M j, Y') }}
                                </div>
                            </header>

                            <div class="tag-row">
                                @php
                                    $skills = $job->required_skills
                                        ? (is_array($job->required_skills)
                                            ? $job->required_skills
                                            : json_decode($job->required_skills, true))
                                        : [];
                                    $skills = $skills ?: ['No skills specified'];
                                    $jobSkillsArray = array_map('trim', explode(',', $skills));
                                @endphp
                                @foreach ($jobSkillsArray as $tag)
                                    <span class="tag">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="saved-footer">
                                <div class="salary">
                                    <i class="fas fa-money-bill"></i>
                                    <span>
                                        @if ($job->currency === 'USD')
                                            $
                                        @elseif($job->currency === 'INR')
                                            ₹
                                        @else
                                            {{ $job->currency }}
                                        @endif
                                        {{ $job->min_salary }} - {{ $job->max_salary }}
                                    </span>
                                </div>
                                <div class="actions">
                                    <form action="{{ route('jobseeker.remove-saved-job') }}" method="POST"
                                        class="confirm-action-form" data-confirm-title="Remove saved job?"
                                        data-confirm-message="This job will be removed from your saved list."
                                        data-confirm-button="Yes, remove">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="listing_id" value="{{ $job->id }}">
                                        <button type="submit" class="btn-ghost">Remove</button>
                                    </form>
                                    <a href="{{ route('jobseeker.job-detail', $job->slug) }}">
                                        <button type="button" class="btn-primary">Apply Now</button>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <article class="panel empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <h3>No saved jobs yet</h3>
                            <p>Save interesting roles to compare and apply later.</p>
                            <a class="btn-primary" href="{{ route('jobseeker.all-jobs') }}">Browse jobs</a>
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
            <a href="{{ route('jobseeker.applied-jobs') }}" class="mobile-nav-item">
                <i class="fas fa-briefcase"></i>
                <span>Applied Jobs</span>
            </a>
            <a href="{{ route('jobseeker.saved-jobs') }}" class="mobile-nav-item active">
                <i class="fas fa-bookmark"></i>
                <span>Saved Jobs</span>
            </a>
            <a href="#" class="mobile-nav-item">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
        </nav>

        <div class="confirm-modal" id="actionConfirmModal" aria-hidden="true" role="dialog" aria-modal="true"
            aria-labelledby="confirmModalTitle">
            <div class="confirm-modal-card">
                <div class="confirm-modal-icon" aria-hidden="true">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <h3 id="confirmModalTitle">Confirm action</h3>
                <p id="confirmModalMessage">Are you sure you want to continue?</p>
                <div class="confirm-modal-actions">
                    <button type="button" class="btn-ghost confirm-modal-close">Cancel</button>
                    <button type="button" class="btn-primary" id="confirmModalSubmit">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const confirmModal = document.getElementById('actionConfirmModal');
            const confirmModalTitle = document.getElementById('confirmModalTitle');
            const confirmModalMessage = document.getElementById('confirmModalMessage');
            const confirmModalSubmit = document.getElementById('confirmModalSubmit');
            const confirmModalCloseButtons = document.querySelectorAll('.confirm-modal-close');
            const confirmActionForms = document.querySelectorAll('.confirm-action-form');
            let pendingForm = null;

            const closeConfirmModal = () => {
                if (!confirmModal) return;
                confirmModal.classList.remove('open');
                confirmModal.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('modal-open');
                pendingForm = null;
            };

            const openConfirmModal = (form) => {
                if (!confirmModal || !confirmModalTitle || !confirmModalMessage || !confirmModalSubmit) {
                    form.submit();
                    return;
                }

                pendingForm = form;
                confirmModalTitle.textContent = form.dataset.confirmTitle || 'Confirm action';
                confirmModalMessage.textContent = form.dataset.confirmMessage || 'Are you sure you want to continue?';
                confirmModalSubmit.textContent = form.dataset.confirmButton || 'Confirm';
                confirmModal.classList.add('open');
                confirmModal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('modal-open');
            };

            confirmActionForms.forEach((form) => {
                form.addEventListener('submit', (event) => {
                    event.preventDefault();
                    openConfirmModal(form);
                });
            });

            if (confirmModalSubmit) {
                confirmModalSubmit.addEventListener('click', () => {
                    if (!pendingForm) return;
                    const formToSubmit = pendingForm;
                    closeConfirmModal();
                    formToSubmit.submit();
                });
            }

            confirmModalCloseButtons.forEach((button) => {
                button.addEventListener('click', closeConfirmModal);
            });

            if (confirmModal) {
                confirmModal.addEventListener('click', (event) => {
                    if (event.target === confirmModal) {
                        closeConfirmModal();
                    }
                });
            }

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && confirmModal && confirmModal.classList.contains('open')) {
                    closeConfirmModal();
                }
            });

            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('jobseekerSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            const alertCloseButtons = document.querySelectorAll('.page-alert-close');

            alertCloseButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-alert-target');
                    const alertElement = targetId ? document.getElementById(targetId) : null;

                    if (alertElement) {
                        alertElement.remove();
                    }
                });
            });

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
