<?php
require_once __DIR__ . '/../../config.php';
header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$email = htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars(trim($password), ENT_QUOTES, 'UTF-8');
$errors = [];
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}
if (!$password) {
    $errors[] = 'Password is required';
}
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $errors[] = "CSRF validation failed";
}
if ($errors) {
    echo json_encode(['error' => implode(', ', $errors)]);
    exit;
}

$stmt = $mysqli->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user && password_verify($password, $user['password'])) {
    unset($_SESSION['csrf_token']);
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['first_name'];
    // Store the user's unique folder id for uploads
    $_SESSION['use_id'] = $user['use_id'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Invalid credentials']);
}
?>
