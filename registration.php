<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h3 class="mb-4">Register</h3>
                <form id="registerForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="agreed_terms" id="terms">
                        <label class="form-check-label" for="terms">
                            Agree to terms and conditions
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div id="regAlert" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    let errors = [];
    if (!data.get('country')) errors.push('Country is required');
    if (!data.get('first_name')) errors.push('First name is required');
    if (!data.get('last_name')) errors.push('Last name is required');
    if (!data.get('company')) errors.push('Company is required');
    const email = data.get('email');
    if (!email || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) errors.push('Valid email is required');
    const password = data.get('password');
    if (!password || password.length < 6) errors.push('Password must be at least 6 characters');
    if (!data.get('agreed_terms')) errors.push('You must agree to terms');
    const alertBox = document.getElementById('regAlert');
    alertBox.innerHTML = '';
    if (errors.length) {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = errors.join(', ');
        return;
    }
    const res = await fetch('api/_save_user.php', {
        method: 'POST',
        body: data
    });
    const result = await res.json();
    if (result.success) {
        alertBox.className = 'alert alert-success';
        alertBox.textContent = 'Registration successful. Redirecting to login...';
        setTimeout(() => window.location = 'login.php', 1500);
    } else {
        alertBox.className = 'alert alert-danger';
        alertBox.textContent = result.error || 'Registration failed';
    }
});
</script>
</body>
</html>
