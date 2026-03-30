<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/error-page.css')
</head>
<body class="error-500">
    <div class="error-container">
        <div class="error-content">
            <!-- Alert Icon Symbol -->
            <div class="code-symbol error-alert">
                <div class="alert-icon">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <div class="error-code">
                    <span class="code-line line-1">500</span>
                </div>
                <div class="alert-icon">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
            </div>

            <!-- Main Message -->
            <h1>Something Went Wrong</h1>
            <p class="error-description">
                Our servers are experiencing an issue. We're working hard to fix it. Please try again in a few moments.
            </p>

            <!-- Error Details -->
            <div class="error-details">
                <div class="detail-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Internal Server Error</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <span>Our team has been notified</span>
                </div>
            </div>

            <!-- Call to Action Buttons -->
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-sync-alt"></i>
                    Try Again
                </a>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </a>
            </div>

            <!-- Quick Navigation -->
            <div class="quick-links">
                <p>What You Can Do:</p>
                <div class="links-grid">
                    <a href="/" class="link-item">
                        <i class="fas fa-home"></i>
                        <span>Go Home</span>
                    </a>
                    <a href="mailto:support@hirist.com" class="link-item">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Support</span>
                    </a>
                    <a href="/status" class="link-item">
                        <i class="fas fa-heartbeat"></i>
                        <span>Status Page</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="decoration">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="floating-icon icon-1"><i class="fas fa-bolt"></i></div>
            <div class="floating-icon icon-2"><i class="fas fa-exclamation"></i></div>
            <div class="floating-icon icon-3"><i class="fas fa-bolt"></i></div>
        </div>
    </div>

    <script>
        // Add error-500 specific animations
        document.body.classList.add('error-500');
    </script>
</body>
</html>
