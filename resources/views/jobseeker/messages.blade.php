<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/jobseeker-dashboard.css')
    <style>
        .messages-layout { display: grid; grid-template-columns: 300px 1fr; gap: 12px; }
        .threads { border: 1px solid rgba(148, 163, 184, 0.2); border-radius: 12px; background: rgba(8, 15, 31, 0.9); overflow: hidden; }
        .thread-item { display: flex; gap: 10px; padding: 12px; border-bottom: 1px solid rgba(148, 163, 184, 0.14); color: #d6e1f2; text-decoration: none; }
        .thread-item:last-child { border-bottom: none; }
        .thread-item.active { background: rgba(37, 99, 235, 0.18); border-color: rgba(59, 130, 246, 0.32); }
        .thread-meta { flex: 1; }
        .thread-title { margin: 0; font-weight: 800; }
        .thread-sub { margin: 2px 0 0; color: #9ca8bf; font-size: 13px; }
        .thread-time { color: #9ca8bf; font-size: 12px; }
        .chat { border: 1px solid rgba(148, 163, 184, 0.2); border-radius: 12px; background: rgba(9, 14, 28, 0.92); display: grid; grid-template-rows: auto 1fr auto; min-height: 520px; }
        .chat-header { padding: 12px 14px; border-bottom: 1px solid rgba(148, 163, 184, 0.14); display: flex; justify-content: space-between; align-items: center; }
        .chat-title { margin: 0; font-size: 18px; font-weight: 800; }
        .chat-status { color: #9ca8bf; font-size: 13px; }
        .chat-log { padding: 14px; overflow-y: auto; display: grid; gap: 10px; }
        .msg { max-width: 72%; padding: 10px 12px; border-radius: 12px; font-weight: 600; line-height: 1.4; }
        .msg.them { background: rgba(148, 163, 184, 0.12); color: #e2e8f0; }
        .msg.me { margin-left: auto; background: linear-gradient(90deg, #2563eb, #1d4ed8); color: #ffffff; box-shadow: 0 8px 16px rgba(37, 99, 235, 0.35); }
        .chat-input { display: flex; gap: 8px; padding: 12px 14px; border-top: 1px solid rgba(148, 163, 184, 0.14); }
        .chat-input input { flex: 1; border-radius: 10px; border: 1px solid rgba(148, 163, 184, 0.25); background: rgba(15, 23, 42, 0.72); color: #e5edff; padding: 11px 12px; }
        .chat-input button { min-width: 110px; border: none; border-radius: 10px; background: linear-gradient(90deg, #2563eb, #1d4ed8); color: #ffffff; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; gap: 6px; }
        @media (max-width: 960px) { .messages-layout { grid-template-columns: 1fr; } .chat { min-height: 420px; } }
    </style>
</head>
<body>
    @php
        $menuItems = [
            ['label' => 'Dashboard', 'icon' => 'fa-chart-line', 'active' => false, 'badge' => null, 'url' => route('jobseeker.dashboard')],
            ['label' => 'All Jobs', 'icon' => 'fa-list', 'active' => false, 'badge' => null, 'url' => route('jobseeker.all-jobs')],
            ['label' => 'My Profile', 'icon' => 'fa-user', 'active' => false, 'badge' => null, 'url' => route('jobseeker.profile')],
            ['label' => 'Applied Jobs', 'icon' => 'fa-briefcase', 'active' => false, 'badge' => null, 'url' => route('jobseeker.applied-jobs')],
            ['label' => 'Saved Jobs', 'icon' => 'fa-bookmark', 'active' => false, 'badge' => null, 'url' => route('jobseeker.saved-jobs')],
            ['label' => 'Messages', 'icon' => 'fa-envelope', 'active' => true, 'badge' => '3', 'url' => route('jobseeker.messages')],
            ['label' => 'Settings', 'icon' => 'fa-gear', 'active' => false, 'badge' => null, 'url' => route('jobseeker.settings')],
        ];

        $threads = [
            ['title' => 'Acme Corp', 'role' => 'Frontend Engineer', 'time' => '2m', 'active' => true],
            ['title' => 'Globex', 'role' => 'Product Designer', 'time' => '1h', 'active' => false],
            ['title' => 'Initech', 'role' => 'Backend Developer', 'time' => 'Yesterday', 'active' => false],
        ];

        $messages = [
            ['from' => 'them', 'text' => 'Hi, thanks for applying. Are you available for a quick call tomorrow?'],
            ['from' => 'me', 'text' => 'Yes, I’m available after 2pm. Does 3pm work?'],
            ['from' => 'them', 'text' => '3pm works. I’ll send a calendar invite. Also, please confirm your current notice period.'],
            ['from' => 'me', 'text' => 'Notice period is 30 days.'],
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
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu" aria-controls="jobseekerSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Messages</h1>
                        <p>Chat with recruiters and track your conversations.</p>
                    </div>
                </div>

                <section class="messages-layout">
                    <div class="threads" aria-label="Conversation list">
                        @foreach ($threads as $thread)
                            <a href="#" class="thread-item {{ $thread['active'] ? 'active' : '' }}">
                                <div class="thread-meta">
                                    <p class="thread-title">{{ $thread['title'] }}</p>
                                    <p class="thread-sub">{{ $thread['role'] }}</p>
                                </div>
                                <span class="thread-time">{{ $thread['time'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="chat" aria-label="Active conversation">
                        <div class="chat-header">
                            <div>
                                <p class="chat-title">Acme Corp</p>
                                <p class="chat-status">Frontend Engineer • Responds within a day</p>
                            </div>
                            <span class="pill status-active" style="font-size:12px;">Active</span>
                        </div>
                        <div class="chat-log">
                            @foreach ($messages as $msg)
                                <div class="msg {{ $msg['from'] === 'me' ? 'me' : 'them' }}">{{ $msg['text'] }}</div>
                            @endforeach
                        </div>
                        <div class="chat-input">
                            <input type="text" placeholder="Type a message…" aria-label="Message input">
                            <button type="button"><i class="fas fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('jobseeker.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('jobseeker.all-jobs') }}" class="mobile-nav-item">
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
        (function () {
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
