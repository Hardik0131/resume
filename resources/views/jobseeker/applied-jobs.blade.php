<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Jobs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/jobseeker-dashboard.css', 'resources/css/jobseeker-applied.css'])
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
                'active' => true,
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

        //     $appliedJobs = [
        //         [
        //             'title' => 'Senior PHP / Laravel Developer',
        //             'company' => 'NexaSoft Labs',
        //             'location' => 'Remote • GMT+5:30',
        //             'type' => 'Full-time',
        //             'applied_on' => 'Mar 12, 2026',
        //             'status' => 'In Review',
        //             'status_class' => 'status-review',
        //             'salary' => '$80k - $95k',
        //             'ref' => '#APP-1024',
        //         ],
        //         [
        //             'title' => 'Frontend Engineer (React)',
        //             'company' => 'Bright Pixel Studio',
        //             'location' => 'Hybrid • Bengaluru',
        //             'type' => 'Contract',
        //             'applied_on' => 'Mar 08, 2026',
        //             'status' => 'Interview',
        //             'status_class' => 'status-interview',
        //             'salary' => '$60/hr',
        //             'ref' => '#APP-1019',
        //         ],
        //         [
        //             'title' => 'Backend Engineer',
        //             'company' => 'DataForge Inc.',
        //             'location' => 'Remote',
        //             'type' => 'Full-time',
        //             'applied_on' => 'Feb 28, 2026',
        //             'status' => 'Applied',
        //             'status_class' => 'status-applied',
        //             'salary' => '$75k - $90k',
        //             'ref' => '#APP-1012',
        //         ],
        //         [
        //             'title' => 'Product Engineer',
        //             'company' => 'Northwind Systems',
        //             'location' => 'On-site • Pune',
        //             'type' => 'Full-time',
        //             'applied_on' => 'Feb 20, 2026',
        //             'status' => 'Rejected',
        //             'status_class' => 'status-rejected',
        //             'salary' => '$70k - $85k',
        //             'ref' => '#APP-1006',
        //         ],
        //     ];
        //

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

            <main class="content applied-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Applied Jobs</h1>
                        <p>Track your applications, statuses, and upcoming steps.</p>
                    </div>
                    <div class="top-actions">
                        <a href="#" class="icon-btn" aria-label="Filters">
                            <i class="fas fa-sliders"></i>
                        </a>
                        <a href="#" class="icon-btn" aria-label="Saved jobs">
                            <i class="fas fa-bookmark"></i>
                        </a>
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

                <section class="panel filters-panel">
                    <div class="filters-row">
                        <span class="chip active">All</span>
                        <span class="chip">Applied</span>
                        <span class="chip">In Review</span>
                        <span class="chip">Interview</span>
                        <span class="chip">Offer</span>
                        <span class="chip">Rejected</span>
                    </div>
                    <div class="sort-row">
                        <div class="sort-pill">
                            <i class="fas fa-arrow-down-short-wide"></i>
                            <span>Sort: Recent</span>
                        </div>
                        <div class="sort-pill">
                            <i class="fas fa-location-dot"></i>
                            <span>Location: Any</span>
                        </div>
                    </div>
                </section>

                <section class="applied-grid">
                    @forelse ($appliedJobs as $job)
                        <article class="panel job-card">
                            <header class="job-header">
                                <div>
                                    <p class="job-ref">#APP00{{ $job->id }}</p>
                                    <h2>{{ ucfirst($job->job_title) ?? 'Not specified' }}</h2>
                                    <p class="job-company">{{ $job->company ?? 'Not specified' }}</p>
                                </div>
                                <span
                                    class="status-pill {{ $job['status_class'] }}">{{ ucfirst($job->status) ?? 'Not specified' }}</span>
                            </header>

                            <div class="job-meta">
                                <div class="meta-item">
                                    <i class="fas fa-location-dot"></i>
                                    <span>{{ ucfirst($job->location) ?? 'Not specified' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>{{ ucfirst($job->employment_type) ?? 'Not specified' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Applied - {{ ucfirst($job->created_at->format('M j, Y')) }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-money-bill"></i>
                                    @if ($job->currency === 'USD')
                                        <span>{{ ucfirst($job->min_salary) ?? 'Not specified' }} -
                                            {{ ucfirst($job->max_salary) ?? 'Not specified' }} $</span>
                                    @else
                                        <span>{{ ucfirst($job->min_salary) ?? 'Not specified' }} -
                                            {{ ucfirst($job->max_salary) ?? 'Not specified' }}
                                            {{ ucfirst($job->currency) ?? 'N/A' }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="job-actions">
                                <a href="{{ route('jobseeker.job-detail', $job->slug) }}">
                                    <button type="button" class="btn-ghost">View details</button>
                                </a>
                                <form action="{{ route('jobseeker.withdraw-application') }}" method="POST"
                                    class="confirm-action-form" data-confirm-title="Withdraw application?"
                                    data-confirm-message="This application will be withdrawn and removed from your active applications."
                                    data-confirm-button="Yes, withdraw">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="listing_id" value="{{ $job->id }}">
                                    <button type="submit" class="btn-primary">Withdraw</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <article class="panel empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h3>No applications yet</h3>
                            <p>Apply to roles and they will appear here for quick tracking.</p>
                            <a class="btn-primary" href="{{ route('jobseeker.all-jobs') }}">Find jobs</a>
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
            <a href="{{ route('jobseeker.applied-jobs') }}" class="mobile-nav-item active">
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

            // Auto-dismiss flash alerts after a short delay.
            ['pageAlert', 'pageErrorAlert'].forEach((id) => {
                const alertElement = document.getElementById(id);

                if (!alertElement) {
                    return;
                }

                setTimeout(() => {
                    if (alertElement.parentNode) {
                        alertElement.remove();
                    }
                }, 4500);
            });

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
