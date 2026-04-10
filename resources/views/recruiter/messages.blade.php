<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | Recruiter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/recruiter-messages.css'])
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
                'active' => true,
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

        $conversations = [
            [
                'name' => 'Alex Johnson',
                'role' => 'Senior Laravel Engineer',
                'snippet' => 'Thanks for scheduling. I am ready for the tech screen.',
                'time' => '2m ago',
                'unread' => true,
            ],
            [
                'name' => 'Priya Nair',
                'role' => 'Product Designer',
                'snippet' => 'Sent my portfolio and case study links.',
                'time' => '15m ago',
                'unread' => false,
            ],
            [
                'name' => 'Diego Martinez',
                'role' => 'Data Engineer',
                'snippet' => 'Can we shift the onsite to Thursday?',
                'time' => '1h ago',
                'unread' => true,
            ],
            [
                'name' => 'Sara Lee',
                'role' => 'Customer Success Lead',
                'snippet' => 'Following up on the screening questions.',
                'time' => '3h ago',
                'unread' => false,
            ],
            [
                'name' => 'Kenji Tanaka',
                'role' => 'Frontend Developer (React)',
                'snippet' => 'Here is my GitHub and live demo.',
                'time' => 'Yesterday',
                'unread' => false,
            ],
        ];

        $thread = [
            [
                'from' => 'Alex Johnson',
                'time' => '09:42 AM',
                'message' => 'Thanks for scheduling. I am ready for the tech screen. Happy to do Zoom or Meet.',
            ],
            [
                'from' => 'You',
                'time' => '09:45 AM',
                'message' => 'Great! Let us book for Wednesday 3:00 PM. I will send a calendar invite shortly.',
            ],
            [
                'from' => 'Alex Johnson',
                'time' => '09:48 AM',
                'message' => 'Works for me. Also attaching a link to a recent API project I built.',
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

            <main class="content messages-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="recruiterSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Messages</h1>
                        <p>Coordinate faster with candidates and hiring managers.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Search"><i
                                class="fas fa-magnifying-glass"></i></button>
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                    </div>
                </div>

                <section class="messages-grid">
                    <article class="panel inbox-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Inbox</h2>
                                <p class="muted" style="margin: 4px 0 0;">5 unread • Sorted by recent</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Filters</button>
                                <button type="button" class="btn-primary">New message</button>
                            </div>
                        </header>
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by name, role, or keyword"
                                aria-label="Search inbox">
                        </div>
                        <div class="conversation-list" role="list">
                            @foreach ($conversations as $item)
                                <button type="button" class="conversation {{ $item['unread'] ? 'unread' : '' }}"
                                    role="listitem">
                                    <div class="conversation-main">
                                        <strong>{{ $item['name'] }}</strong>
                                        <span class="muted">{{ $item['role'] }}</span>
                                        <p class="snippet">{{ $item['snippet'] }}</p>
                                    </div>
                                    <div class="conversation-meta">
                                        <span class="muted">{{ $item['time'] }}</span>
                                        @if ($item['unread'])
                                            <span class="pill tiny">New</span>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </article>

                    <article class="panel thread-panel">
                        <header class="panel-header">
                            <div>
                                <h2>Alex Johnson</h2>
                                <p class="muted" style="margin: 4px 0 0;">Senior Laravel Engineer • Remote</p>
                            </div>
                            <div class="panel-actions">
                                <button type="button" class="btn-ghost">Profile</button>
                                <button type="button" class="btn-ghost">Schedule</button>
                            </div>
                        </header>

                        <div class="thread-body">
                            @foreach ($thread as $msg)
                                <div class="bubble {{ $msg['from'] === 'You' ? 'outgoing' : 'incoming' }}">
                                    <div class="bubble-meta">
                                        <strong>{{ $msg['from'] }}</strong>
                                        <span class="muted">{{ $msg['time'] }}</span>
                                    </div>
                                    <p>{{ $msg['message'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="composer">
                            <div class="composer-actions">
                                <button type="button" class="icon-btn" aria-label="Attachment"><i
                                        class="fas fa-paperclip"></i></button>
                                <button type="button" class="icon-btn" aria-label="Template"><i
                                        class="fas fa-file-lines"></i></button>
                                <button type="button" class="icon-btn" aria-label="Emoji"><i
                                        class="fas fa-face-smile"></i></button>
                            </div>
                            <textarea rows="3" placeholder="Type a message..." aria-label="Message input"></textarea>
                            <div class="composer-footer">
                                <label class="muted" style="display:flex; align-items:center; gap:6px;">
                                    <input type="checkbox" style="accent-color:#2563eb;"> Send as email + in-app
                                </label>
                                <button type="button" class="btn-primary">Send</button>
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
            <a href="{{ route('recruiter.messages') }}" class="mobile-nav-item active">
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
