<?php
require_once __DIR__ . '/../../config.php';
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

$use_id = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) .
          str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
$hash = password_hash($input['password'], PASSWORD_DEFAULT);

$stmt = $mysqli->prepare('INSERT INTO users (use_id,country,first_name,last_name,company,email,password,agreed_terms) VALUES (?,?,?,?,?,?,?,?)');
$agreed_terms = 1;
$stmt->bind_param(
    'sssssssi',
    $use_id,
    $input['country'],
    $input['first_name'],
    $input['last_name'],
    $input['company'],
    $input['email'],
    $hash,
    $agreed_terms
);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Email already exists']);
}
?>
