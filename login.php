<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h3 class="mb-4">Login</h3>
                <form id="loginForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div id="loginAlert" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    let errors = [];
    const email = data.get('email');
    if (!email || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) errors.push('Valid email is required');
    if (!data.get('password')) errors.push('Password is required');
    const alertBox = document.getElementById('loginAlert');
    alertBox.innerHTML = '';
    if (errors.length) {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = errors.join(', ');
        return;
    }
    const res = await fetch('api/_login_user.php', {
        method: 'POST',
        body: data
    });
    const result = await res.json();
    if (result.success) {
        alertBox.className = 'alert alert-success';
        alertBox.textContent = 'Login successful. Redirecting...';
        setTimeout(() => window.location = 'dashboard.php', 1000);
    } else {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = result.error || 'Login failed';
    }
});
</script>
</body>
</html>
