<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Billing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/recruiter-dashboard.css', 'resources/css/admin-billing.css'])
</head>

<body>
    @php
        $menuItems = [
            [
                'label' => 'Dashboard',
                'icon' => 'fa-chart-line',
                'active' => false,
                'badge' => null,
                'url' => route('admin.dashboard'),
            ],
            [
                'label' => 'Users',
                'icon' => 'fa-users',
                'active' => false,
                'badge' => null,
                'url' => route('admin.users'),
            ],
            [
                'label' => 'Teams',
                'icon' => 'fa-people-group',
                'active' => false,
                'badge' => null,
                'url' => route('admin.teams'),
            ],
            [
                'label' => 'Companies',
                'icon' => 'fa-building',
                'active' => false,
                'badge' => null,
                'url' => route('admin.companies'),
            ],
            [
                'label' => 'Jobs',
                'icon' => 'fa-briefcase',
                'active' => false,
                'badge' => null,
                'url' => route('admin.jobs'),
            ],
            [
                'label' => 'Moderation',
                'icon' => 'fa-shield-halved',
                'active' => false,
                'badge' => null,
                'url' => route('admin.moderation'),
            ],
            [
                'label' => 'Billing',
                'icon' => 'fa-credit-card',
                'active' => true,
                'badge' => '4',
                'url' => route('admin.billing'),
            ],
            [
                'label' => 'Reports',
                'icon' => 'fa-flag',
                'active' => false,
                'badge' => null,
                'url' => route('admin.reports'),
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-gear',
                'active' => false,
                'badge' => null,
                'url' => route('admin.settings'),
            ],
        ];

        $stats = [
            ['label' => 'MRR', 'value' => '$128,420'],
            ['label' => 'Collections (30d)', 'value' => '$312,900'],
            ['label' => 'Failed charges', 'value' => '27'],
            ['label' => 'Open disputes', 'value' => '4'],
        ];

        $invoices = [
            [
                'invoice' => 'INV-10429',
                'company' => 'TechNova Pvt Ltd',
                'plan' => 'Enterprise Annual',
                'amount' => '$12,000',
                'status' => 'Paid',
                'due' => '2026-04-12',
            ],
            [
                'invoice' => 'INV-10430',
                'company' => 'BuildStack Labs',
                'plan' => 'Growth Monthly',
                'amount' => '$899',
                'status' => 'Pending',
                'due' => '2026-04-05',
            ],
            [
                'invoice' => 'INV-10431',
                'company' => 'Nimbus Retail',
                'plan' => 'Growth Monthly',
                'amount' => '$899',
                'status' => 'Failed',
                'due' => '2026-04-01',
            ],
            [
                'invoice' => 'INV-10432',
                'company' => 'AI Forge Solutions',
                'plan' => 'Enterprise Annual',
                'amount' => '$14,400',
                'status' => 'Paid',
                'due' => '2026-04-18',
            ],
        ];

        $payoutQueue = [
            [
                'title' => 'Affiliate commission batch',
                'meta' => '12 partners | Stripe Connect',
                'submitted' => '35m ago',
                'risk' => 'Low',
            ],
            [
                'title' => 'Refund approval',
                'meta' => 'BuildStack Labs | $899',
                'submitted' => '1h ago',
                'risk' => 'Medium',
            ],
            [
                'title' => 'Chargeback dispute',
                'meta' => 'Nimbus Retail | INV-10431',
                'submitted' => '2h ago',
                'risk' => 'High',
            ],
        ];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-frame">
            <aside class="sidebar" id="adminSidebar">
                <div class="brand">HiRist Admin</div>

                <nav class="menu" aria-label="Admin sidebar">
                    @foreach ($menuItems as $item)
                        <a href="{{ $item['url'] ?? '#' }}" class="menu-item {{ $item['active'] ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fas {{ $item['icon'] }}"></i></span>
                            <span>{{ $item['label'] }}</span>
                            @if ($item['badge'])
                                <span class="badge">{{ $item['badge'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </nav>

                <div class="logout-wrap">
                    <a href="#" class="menu-item">
                        <span class="menu-icon"><i class="fas fa-right-from-bracket"></i></span>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>
            <div class="sidebar-backdrop" id="adminBackdrop"></div>

            <main class="content admin-billing-content">
                <div class="topbar">
                    <div>
                        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open sidebar menu"
                            aria-controls="adminSidebar" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <h1>Billing Dashboard</h1>
                        <p>Track invoices, collections, disputes, and payout approvals.</p>
                    </div>
                    <div class="top-actions">
                        <button type="button" class="icon-btn" aria-label="Notifications"><i
                                class="fas fa-bell"></i></button>
                        <button type="button" class="icon-btn" aria-label="Support"><i
                                class="fas fa-circle-info"></i></button>
                    </div>
                </div>

                <section class="summary-grid">
                    @foreach ($stats as $stat)
                        <article class="summary-card">
                            <p class="muted">{{ $stat['label'] }}</p>
                            <h3>{{ $stat['value'] }}</h3>
                        </article>
                    @endforeach
                </section>

                <section class="filters-panel">
                    <div class="filter-bar">
                        <div class="searchbox">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search invoice, company, or transaction" aria-label="Search billing">
                        </div>
                        <select aria-label="Status filter">
                            <option>All statuses</option>
                            <option>Paid</option>
                            <option>Pending</option>
                            <option>Failed</option>
                        </select>
                        <select aria-label="Plan filter">
                            <option>All plans</option>
                            <option>Enterprise Annual</option>
                            <option>Growth Monthly</option>
                            <option>Starter</option>
                        </select>
                        <select aria-label="Gateway filter">
                            <option>All gateways</option>
                            <option>Stripe</option>
                            <option>Razorpay</option>
                        </select>
                        <div class="filter-actions">
                            <button type="button" class="btn-ghost">Reset</button>
                            <button type="button" class="btn-primary">Filter</button>
                        </div>
                        <div class="action-actions">
                            <button type="button" class="btn-ghost">Export</button>
                            <button type="button" class="btn-primary">Create invoice</button>
                        </div>
                    </div>
                    <div class="filter-chips" aria-label="Quick filters">
                        <span class="filter-chip active"><i class="fas fa-bolt"></i> Failed charges</span>
                        <span class="filter-chip"><i class="fas fa-clock"></i> Due this week</span>
                        <span class="filter-chip"><i class="fas fa-rotate-left"></i> Refunds</span>
                        <span class="filter-chip"><i class="fas fa-shield"></i> Disputes</span>
                    </div>
                </section>

                <section class="panel invoices-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Invoices</h2>
                            <p class="muted" style="margin: 4px 0 0;">Invoice status, plan, due date, and amount.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Bulk actions</button>
                            <button type="button" class="btn-primary">Send reminders</button>
                        </div>
                    </header>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Company</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Due date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td data-label="Invoice">{{ $invoice['invoice'] }}</td>
                                        <td data-label="Company">{{ $invoice['company'] }}</td>
                                        <td data-label="Plan"><span class="tag">{{ $invoice['plan'] }}</span></td>
                                        <td data-label="Amount"><span class="amount">{{ $invoice['amount'] }}</span></td>
                                        <td data-label="Status">
                                            @php
                                                $statusClass = match ($invoice['status']) {
                                                    'Paid' => 'pill green',
                                                    'Pending' => 'pill orange',
                                                    default => 'pill red',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $invoice['status'] }}</span>
                                        </td>
                                        <td data-label="Due date">{{ $invoice['due'] }}</td>
                                        <td data-label="Actions">
                                            <div class="row-actions">
                                                <button class="btn-ghost" type="button">View</button>
                                                <button class="btn-primary" type="button">Collect</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="panel queue-panel">
                    <header class="panel-header">
                        <div>
                            <h2>Payout & dispute queue</h2>
                            <p class="muted" style="margin: 4px 0 0;">Financial actions waiting for review.</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-ghost">Assign</button>
                            <button type="button" class="btn-primary">Open queue</button>
                        </div>
                    </header>

                    <div class="queue-list">
                        @foreach ($payoutQueue as $item)
                            <article class="queue-row">
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p class="muted">{{ $item['meta'] }}</p>
                                </div>
                                <div class="queue-meta">
                                    <span><i class="fas fa-clock"></i> {{ $item['submitted'] }}</span>
                                    <span class="tag">{{ $item['risk'] }} risk</span>
                                </div>
                                <div class="row-actions">
                                    <button class="btn-ghost" type="button">View</button>
                                    <button class="btn-primary" type="button">Approve</button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            </main>
        </div>

        <nav class="mobile-bottom-nav" aria-label="Mobile bottom navigation">
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="mobile-nav-item">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ url('/admin/teams') }}" class="mobile-nav-item">
                <i class="fas fa-people-group"></i>
                <span>Teams</span>
            </a>
            <a href="{{ url('/admin/billing') }}" class="mobile-nav-item active">
                <i class="fas fa-credit-card"></i>
                <span>Billing</span>
            </a>
        </nav>
    </div>

    <script>
        (function() {
            const toggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('adminBackdrop');

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
