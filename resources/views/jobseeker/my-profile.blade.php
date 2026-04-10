<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/jobseeker-dashboard.css', 'resources/css/jobseeker-profile.css'])
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
                'active' => true,
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

            <main class="content profile-content">
                <div class="topbar profile-topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>My Profile</h1>
                        <p>Manage your account details and keep your latest resume ready.</p>
                    </div>
                    <div class="top-actions">
                        <a href="{{ route('jobseeker.dashboard') }}" class="icon-btn" aria-label="Go to dashboard">
                            <i class="fas fa-chart-line"></i>
                        </a>
                    </div>
                </div>

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
                @endif

                @if ($errors->any())
                    <div class="alert error-alert" data-auto-dismiss="3000" role="alert" aria-live="assertive">
                        <span class="alert-main">
                            <i class="fas fa-circle-exclamation"></i>
                            <span>{{ $errors->first() }}</span>
                        </span>
                        <button type="button" class="alert-close" aria-label="Close alert">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <section class="profile-grid">
                    <article class="panel profile-card">
                        <h2>Basic Details</h2>
                        <div class="details-grid">
                            <div class="detail-box">
                                <span class="detail-label">Full Name</span>
                                <strong>{{ Auth::user()->name ?? 'Job Seeker' }}</strong>
                            </div>
                            <div class="detail-box">
                                <span class="detail-label">Email</span>
                                <strong>{{ Auth::user()->email ?? 'user@example.com' }}</strong>
                            </div>
                            <div class="detail-box">
                                <span class="detail-label">Role</span>
                                <strong>Job Seeker</strong>
                            </div>
                            <div class="detail-box">
                                <span class="detail-label">Availability</span>
                                <strong>Open to opportunities</strong>
                            </div>
                        </div>
                    </article>

                    <article class="panel profile-card">
                        <h2>Upload Your Resume</h2>
                        <p class="panel-subtext">Accepted formats: PDF, DOC, DOCX (max 3 MB)</p>

                        <form action="{{ route('jobseeker.upload-resume') }}" method="POST"
                            enctype="multipart/form-data" class="resume-form">
                            @csrf
                            <label for="resume" class="file-label">
                                <i class="fas fa-file-arrow-up"></i>
                                <span>Choose Resume File</span>
                            </label>
                            <input id="resume" class="resume-input" name="resume" type="file"
                                accept=".pdf,.doc,.docx" required>
                            <p id="selectedFileName" class="selected-file-name">No file selected</p>

                            <button type="submit" class="btn-primary upload-btn">
                                <i class="fas fa-upload"></i>
                                Upload Resume
                            </button>
                        </form>

                        @if (session('resume_path'))
                            <p class="resume-path">
                                Latest uploaded file: <strong>{{ session('resume_path') }}</strong>
                            </p>
                        @endif
                    </article>

                    <article class="panel profile-card">
                        <h2>Your Resume</h2>
                        <p class="panel-subtext">Preview or download your latest upload.</p>

                        @if (!empty($resume))
                            <div class="resume-path">File: <strong>{{ basename($resume->file_path) }}</strong></div>
                            <div class="resume-actions" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:8px;">
                                <a class="btn-primary" href="{{ Storage::url($resume->file_path) }}" target="_blank"
                                    rel="noopener">View</a>
                                <a class="btn-primary" href="{{ Storage::url($resume->file_path) }}"
                                    download>Download</a>
                            </div>

                            @php
                                $ext = strtolower(pathinfo($resume->file_path, PATHINFO_EXTENSION));
                            @endphp

                            @if ($ext === 'pdf')
                                <div style="margin-top:12px;border-radius:10px;overflow:hidden;">
                                    {{-- <iframe src="{{ Storage::url($resume->file_path) }}" title="Resume preview" style="width:100%;height:360px;border:0;"></iframe> --}}
                                </div>
                            @else
                                <p class="panel-subtext" style="margin-top:10px;">Preview is available for PDF files.
                                </p>
                            @endif
                        @else
                            <p class="panel-subtext">No resume on file yet. Upload a resume to view it here.</p>
                        @endif
                    </article>
                </section>
            </main>
        </div>
    </div>

    <script>
        (function() {
            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('jobseekerSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const resumeInput = document.getElementById('resume');
            const selectedFileName = document.getElementById('selectedFileName');
            const alerts = document.querySelectorAll('.alert');

            const closeMenu = () => {
                document.body.classList.remove('menu-open');
                toggle.setAttribute('aria-expanded', 'false');
            };

            const openMenu = () => {
                document.body.classList.add('menu-open');
                toggle.setAttribute('aria-expanded', 'true');
            };

            if (toggle && sidebar && backdrop) {
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
            }

            if (resumeInput && selectedFileName) {
                resumeInput.addEventListener('change', () => {
                    const fileName = resumeInput.files && resumeInput.files[0] ? resumeInput.files[0].name :
                        'No file selected';
                    selectedFileName.textContent = fileName;
                });
            }

            alerts.forEach((alertElement) => {
                const closeButton = alertElement.querySelector('.alert-close');
                const dismissAfter = Number(alertElement.dataset.autoDismiss || 3000);

                const hideAlert = () => {
                    if (alertElement.classList.contains('is-hiding')) {
                        return;
                    }

                    alertElement.classList.add('is-hiding');
                    window.setTimeout(() => {
                        alertElement.remove();
                    }, 260);
                };

                if (closeButton) {
                    closeButton.addEventListener('click', hideAlert);
                }

                window.setTimeout(hideAlert, dismissAfter);
            });
        })();
    </script>
</body>

</html>
