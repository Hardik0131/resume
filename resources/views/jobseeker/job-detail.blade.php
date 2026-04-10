<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Detail</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/jobseeker-dashboard.css')
    <style>
        .detail-shell {
            max-width: 1100px;
            margin: 0 auto;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: flex-start;
        }

        .eyebrow {
            margin: 0 0 6px;
            color: #9ca8bf;
            letter-spacing: 0.04em;
            font-size: 12px;
            text-transform: uppercase;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
            color: #c5d1e6;
            font-weight: 600;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            background: rgba(15, 23, 42, 0.5);
            color: #d9e4f6;
            font-size: 13px;
        }

        .pill.status-active {
            border-color: rgba(52, 211, 153, 0.25);
            color: #7cf2c6;
            background: rgba(22, 163, 74, 0.14);
        }

        .pill.status-closed {
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            background: rgba(239, 68, 68, 0.14);
        }

        .pill.urgency-high {
            border-color: rgba(250, 204, 21, 0.4);
            color: #fde68a;
            background: rgba(234, 179, 8, 0.15);
        }

        .pill.urgency-urgent {
            border-color: rgba(249, 115, 22, 0.4);
            color: #ffb28a;
            background: rgba(249, 115, 22, 0.18);
        }

        .detail-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-ghost-alt {
            border: 1px solid rgba(148, 163, 184, 0.3);
            background: rgba(15, 23, 42, 0.55);
            color: #dce5f6;
            border-radius: 8px;
            padding: 10px 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1.25fr 0.9fr;
            gap: 12px;
            margin-top: 12px;
        }

        .detail-grid .panel {
            height: 100%;
        }

        .info-list {
            display: grid;
            gap: 10px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            padding-bottom: 8px;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            color: #9ca8bf;
            font-weight: 700;
            font-size: 13px;
        }

        .info-value {
            color: #e2e8f0;
            font-weight: 700;
            font-size: 14px;
            text-align: right;
        }

        .tag-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
        }

        .job-tag {
            background: rgba(59, 130, 246, 0.16);
            color: #cfe1ff;
            border: 1px solid rgba(59, 130, 246, 0.32);
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .job-body {
            color: #d6e1f2;
            line-height: 1.65;
            font-size: 15px;
            white-space: pre-line;
        }

        .panel h2 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
        }

        .panel h2 .icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(148, 163, 184, 0.14);
            color: #e5edff;
        }

        .detail-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .stat-card {
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(9, 14, 28, 0.9);
        }

        .stat-label {
            color: #9ca8bf;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.02em;
        }

        .stat-value {
            color: #f8fafc;
            font-weight: 800;
            font-size: 17px;
            margin-top: 4px;
        }

        .supporting {
            color: #9ca8bf;
            margin-top: 6px;
            font-size: 13px;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.72);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            z-index: 80;
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal {
            width: min(100%, 460px);
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: linear-gradient(180deg, rgba(12, 20, 38, 0.98), rgba(10, 18, 35, 0.98));
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.55);
            padding: 20px;
        }

        .modal-head {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .modal-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(245, 158, 11, 0.14);
            color: #fde68a;
            flex-shrink: 0;
        }

        .modal h3 {
            margin: 0;
            color: #f8fafc;
            font-size: 20px;
        }

        .modal p {
            margin: 6px 0 0;
            color: #c6d2e6;
            line-height: 1.55;
        }

        .modal-actions {
            display: flex;
            gap: 8px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .modal-close {
            margin-left: auto;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid rgba(148, 163, 184, 0.25);
            background: rgba(15, 23, 42, 0.6);
            color: #dce5f6;
            cursor: pointer;
        }

        @media (max-width: 960px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-value {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-shell detail-shell">
        @if (!isset($job))
            <article class="panel" style="text-align:center;">
                <h2>Job not found</h2>
                <p class="supporting">The job you are looking for is unavailable.</p>
                <div style="margin-top:12px;">
                    <a href="{{ route('jobseeker.all-jobs') }}" class="btn-primary">Back to jobs</a>
                </div>
            </article>
        @else
            @php
                $resumes = Auth::user()->resumes;
                $hasResumes = $resumes && $resumes->isNotEmpty();
                $canApply = $hasResumes && $job->status !== 'closed';

                $salaryMin = $job->min_salary;
                $salaryMax = $job->max_salary;
                $currency = $job->currency ?? 'USD';
                $salaryParts = [];
                if ($salaryMin) {
                    $salaryParts[] = $currency . ' ' . number_format($salaryMin, 0);
                }
                if ($salaryMax) {
                    $salaryParts[] = $currency . ' ' . number_format($salaryMax, 0);
                }
                $salaryText = $salaryParts ? implode(' - ', $salaryParts) : 'Not disclosed';

                $skillsRaw = $job->required_skills ?? [];
                if (is_string($skillsRaw)) {
                    $decoded = json_decode($skillsRaw, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $skillsRaw = $decoded;
                    } else {
                        $skillsRaw = explode(',', $skillsRaw);
                    }
                }
                $skills = array_values(array_filter(array_map('trim', is_array($skillsRaw) ? $skillsRaw : [])));
            @endphp
            @if (session('success'))
                <div class="panel" id="pageAlert"
                    style="margin-bottom: 12px; border-color: rgba(34, 197, 94, 0.28); background: linear-gradient(180deg, rgba(10, 28, 22, 0.96), rgba(10, 18, 35, 0.92)); display:flex; align-items:flex-start; justify-content:space-between; gap:12px;">
                    <div style="display:flex; gap:10px; align-items:flex-start;">
                        <div
                            style="width:38px; height:38px; border-radius:11px; display:inline-flex; align-items:center; justify-content:center; background:rgba(34,197,94,0.14); color:#86efac; flex-shrink:0;">
                            <i class="fas fa-circle-check"></i>
                        </div>
                        <div>
                            <strong style="color:#f8fafc; display:block; font-size:15px;">Application submitted</strong>
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

            <article class="panel detail-header">
                <div>
                    <p class="eyebrow">Job Detail</p>
                    <h1 class="job-title" style="margin:0; font-size: clamp(26px, 3vw, 34px);">{{ $job->job_title }}
                    </h1>
                    <div class="meta-row">
                        <span class="pill"><i class="fas fa-location-dot"></i>
                            {{ ucfirst($job->location) ?? 'Remote' }}</span>
                        <span class="pill"><i class="fas fa-briefcase"></i>
                            {{ ucfirst($job->work_type) ?? 'Remote' }}</span>
                        <span class="pill"><i class="fas fa-id-card"></i>
                            {{ ucfirst($job->employment_type) ?? 'Full-time' }}</span>
                        <span class="pill"><i class="fas fa-user-graduate"></i>
                            {{ ucfirst($job->experience_level) ?? 'Junior' }}</span>
                        <span class="pill {{ $job->status === 'closed' ? 'status-closed' : 'status-active' }}"><i
                                class="fas fa-circle"></i> {{ ucfirst($job->status ?? 'active') }}</span>
                        @if ($job->hiring_urgency)
                            <span
                                class="pill {{ $job->hiring_urgency === 'High' ? 'urgency-high' : ($job->hiring_urgency === 'Urgent' ? 'urgency-urgent' : '') }}"><i
                                    class="fas fa-bolt"></i> {{ $job->hiring_urgency }}</span>
                        @endif
                    </div>
                </div>
                <div class="detail-actions">
                    <a href="{{ route('jobseeker.all-jobs') }}" class="btn-ghost-alt"><i class="fas fa-arrow-left"></i>
                        Back to jobs</a>
                    @if ($job->status === 'closed')
                        <button type="button" class="btn-primary" disabled>Required</button>
                    @elseif (!$hasResumes)
                        <button type="button" class="btn-primary" disabled>Upload resume first</button>
                    @else
                        <form action="{{ route('jobseeker.apply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $job->id }}">
                            <input type="hidden" name="resume_id" value="{{ Auth::user()->resumes->first()->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            @if ($job->applications()->where('is_applied', true)->where('resume_id', Auth::user()->resumes->first()->id)->exists())
                                <button type="submit" class="btn-primary" disabled
                                    style="background: green; display:flex; gap: 6px;"><i class="fa fa-check-circle"
                                        aria-hidden="true"></i>
                                    <p>Already applied</p>
                                </button>
                            @else
                                <button type="submit" class="btn-primary">Apply</button>
                            @endif
                        </form>
                    @endif
                </div>
            </article>

            <div class="detail-grid">
                <section class="panel">
                    <h2><span class="icon"><i class="fas fa-list"></i></span> Role overview</h2>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Department</span>
                            <span class="info-value">{{ $job->department ?? 'Not specified' }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Work type</span>
                            <span class="info-value">{{ $job->work_type ?? 'Remote' }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Employment</span>
                            <span class="info-value">{{ $job->employment_type ?? 'Full-time' }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Experience level</span>
                            <span class="info-value">{{ $job->experience_level ?? 'Junior' }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Posted</span>
                            <span
                                class="info-value">{{ optional($job->created_at)->format('M j, Y') ?? 'N/A' }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Closing date</span>
                            <span
                                class="info-value">{{ $job->closing_date ? \Carbon\Carbon::parse($job->closing_date)->format('M j, Y') : 'Not set' }}</span>
                        </li>
                    </ul>
                </section>

                <section class="panel">
                    <h2><span class="icon"><i class="fas fa-sack-dollar"></i></span> Compensation</h2>
                    <div class="detail-stats">
                        <div class="stat-card">
                            <div class="stat-label">Salary range</div>
                            <div class="stat-value">{{ $salaryText }}</div>
                            <div class="supporting">Currency: {{ $currency }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Hiring urgency</div>
                            <div class="stat-value">{{ $job->hiring_urgency ?? 'Normal' }}</div>
                            <div class="supporting">Status: {{ ucfirst($job->status ?? 'active') }}</div>
                        </div>
                    </div>
                </section>

                <section class="panel" style="grid-column: 1 / -1;">
                    <h2><span class="icon"><i class="fas fa-tags"></i></span> Required skills</h2>
                    @php
                        $skills = $job->required_skills
                            ? (is_array($job->required_skills)
                                ? $job->required_skills
                                : json_decode($job->required_skills, true))
                            : [];
                        $skills = $skills ?: ['No skills provided'];
                        $jobSkillsArray = array_map('trim', explode(',', $skills));
                    @endphp
                    @if ($skills)
                        <div class="tag-grid">
                            @foreach ($jobSkillsArray as $skill)
                                <span class="job-tag">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="supporting">No specific skills listed.</p>
                    @endif
                </section>

                <section class="panel" style="grid-column: 1 / -1;">
                    <h2><span class="icon"><i class="fas fa-file-lines"></i></span> Job description</h2>
                    <div class="job-body" style="line-height: 1.6;">
                        {!! nl2br(e($job->job_description ?? 'No description provided.')) !!}
                    </div>
                </section>
            </div>
        @endif
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

            window.setTimeout(dismiss, 5000);
        })();
    </script>
</body>

</html>
