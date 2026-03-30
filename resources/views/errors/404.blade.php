<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/error-page.css')
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <!-- Animated Code Symbol -->
            <div class="code-symbol">
                <div class="bracket bracket-left">{</div>
                <div class="error-code">
                    <span class="code-line line-1">404</span>
                </div>
                <div class="bracket bracket-right">}</div>
            </div>

            <!-- Main Message -->
            <h1>Lost in Space?</h1>
            <p class="error-description">
                The page you're looking for has drifted into the digital void. It might have been moved, deleted, or never existed at all.
            </p>

            <!-- Error Details -->
            <div class="error-details">
                <div class="detail-item">
                    <i class="fas fa-search"></i>
                    <span>Page not found</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-link"></i>
                    <span>{{ request()->path() }}</span>
                </div>
            </div>

            <!-- Call to Action Buttons -->
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Back to Home
                </a>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </a>
            </div>

            <!-- Quick Navigation -->
            <div class="quick-links">
                <p>Quick Navigation:</p>
                <div class="links-grid">
                    <a href="/jobseeker/dashboard" class="link-item">
                        <i class="fas fa-briefcase"></i>
                        <span>Job Seeker</span>
                    </a>
                    <a href="/recruiter/dashboard" class="link-item">
                        <i class="fas fa-users"></i>
                        <span>Recruiter</span>
                    </a>
                    <a href="/admin/dashboard" class="link-item">
                        <i class="fas fa-shield-halved"></i>
                        <span>Admin</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="decoration">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="floating-icon icon-1"><i class="fas fa-circle"></i></div>
            <div class="floating-icon icon-2"><i class="fas fa-square"></i></div>
            <div class="floating-icon icon-3"><i class="fas fa-triangle"></i></div>
        </div>
    </div>

    <script>
        // Smooth scroll for back button
        document.querySelectorAll('a[href]').forEach(link => {
            if (link.getAttribute('href') !== 'javascript:history.back()') {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href.startsWith('/')) {
                        e.preventDefault();
                        window.location.href = href;
                    }
                });
            }
        });
    </script>
</body>
</html>
