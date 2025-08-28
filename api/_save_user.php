<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');

$input = $_POST;
$errors = [];
$required = ['country','first_name','last_name','company','email','password'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        $errors[] = "$field is required";
    }
}
if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
}
if (!empty($input['password']) && strlen($input['password']) < 6) {
    $errors[] = 'Password must be at least 6 characters';
}
if (empty($input['agreed_terms'])) {
    $errors[] = 'Terms must be accepted';
}

if ($errors) {
    echo json_encode(['error' => implode(', ', $errors)]);
    exit;
}

$use_id = sprintf('%016d', random_int(0, 9999999999999999));
$hash = password_hash($input['password'], PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare('INSERT INTO users (use_id,country,first_name,last_name,company,email,password,agreed_terms) VALUES (?,?,?,?,?,?,?,?)');
    $stmt->execute([
        $use_id,
        $input['country'],
        $input['first_name'],
        $input['last_name'],
        $input['company'],
        $input['email'],
        $hash,
        1
    ]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Email already exists']);
}
?>
