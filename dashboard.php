<?php
require_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h3 class="mb-4">Dashboard</h3>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                <p>Today: <?php echo date('d-m-Y'); ?></p>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
