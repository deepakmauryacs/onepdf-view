<?php
// Common header
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= isset($page_title) ? $page_title : 'PDFOneLink'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/webapp/css/layout.css">
    <?php if (!empty($page_css)): ?>
    <link rel="stylesheet" href="<?= $page_css ?>">
    <?php endif; ?>
</head>
<body>
<!-- Top bar -->
<nav class="topbar py-2 text-white">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="small">
            <i class="bi bi-envelope me-2"></i>support@invena.com
            <span class="ms-3"><i class="bi bi-clock me-2"></i>Working: 08:00am - 5:00pm</span>
        </div>
        <ul class="list-inline mb-0 small top-links">
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Company news</a></li>
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Faq</a></li>
            <li class="list-inline-item"><a href="#" class="text-white text-decoration-none">Contact</a></li>
            <li class="list-inline-item ms-2"><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-linkedin"></i></a></li>
        </ul>
    </div>
</nav>

<!-- Main navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm navbar-main">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <i class="bi bi-graph-up-arrow fs-2 me-2 text-dark"></i>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold fs-4">Invena</span>
                <small class="text-muted">Business Solution</small>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Service</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Project</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="#" class="btn btn-dark me-3">Get Quote</a>
                <button class="btn btn-outline-secondary rounded-circle border-0 fs-4" type="button">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
