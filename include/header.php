<?php
// Common header
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1%">
    <title><?= isset($page_title) ? $page_title : 'PDFOneLink'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <?php if (!empty($page_css)): ?>
    <link rel="stylesheet" href="<?= $page_css ?>">
    <?php endif; ?>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-link-45deg me-2 text-primary"></i>PDFOneLink
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#how">How it works</a></li>
                <li class="nav-item"><a class="nav-link" href="pricing.php">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#faq">FAQ</a></li>
                <li class="nav-item ms-lg-3"><a class="btn btn-ghost btn-sm" href="/login">Log in</a></li>
                <li class="nav-item ms-2"><a class="btn btn-brand btn-sm" href="/register">Start free</a></li>
            </ul>
        </div>
    </div>
</nav>
