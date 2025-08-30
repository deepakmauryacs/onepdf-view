<?php
require_once __DIR__ . '/../../config.php';
header('Content-Type: application/json');

$input = $_POST;
$errors = [];
$required = ['country','first_name','last_name','company','plan_id','email','password'];
foreach ($required as $field) {
    $input[$field] = htmlspecialchars(trim($input[$field]), ENT_QUOTES, 'UTF-8');
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

$allowedPlans = ['1','2','3','4','5'];
if (!empty($input['plan_id']) && !in_array($input['plan_id'], $allowedPlans)) {
    $errors[] = 'Invalid plan selected';
}

// Name validation (only letters, spaces, hyphen, apostrophe)
if (!empty($input['first_name']) && !preg_match("/^[a-zA-Z\s'-]+$/", $input['first_name'])) {
    $errors[] = 'First name contains invalid characters';
}
if (!empty($input['last_name']) && !preg_match("/^[a-zA-Z\s'-]+$/", $input['last_name'])) {
    $errors[] = 'Last name contains invalid characters';
}

// Company validation (letters, numbers, spaces, basic symbols)
if (!empty($input['company']) && !preg_match("/^[a-zA-Z0-9\s&.,'-]+$/", $input['company'])) {
    $errors[] = 'Company name contains invalid characters';
}

if (!hash_equals($_SESSION['csrf_token'], $input['csrf_token'])) {
    $errors[] = "CSRF validation failed";
}

// ✅ Check if Email Already Exists
$stmt1 = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$stmt1->execute([$input['email']]);
if ($stmt1->fetch()) {
    $errors[] = "Email already exists.";
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
    $user_id = $stmt->insert_id;
    $plan_id = (int)$input['plan_id'];
    $start_date = date('Y-m-d');
    $end_date = null;
    if (in_array($plan_id, [2,4])) {
        $end_date = date('Y-m-d', strtotime('+1 month'));
    } elseif (in_array($plan_id, [3,5])) {
        $end_date = date('Y-m-d', strtotime('+1 year'));
    }
    $stmtPlan = $mysqli->prepare('INSERT INTO user_plan (user_id, plan_id, start_date, end_date) VALUES (?,?,?,?)');
    $stmtPlan->bind_param('iiss', $user_id, $plan_id, $start_date, $end_date);
    $stmtPlan->execute();
    unset($_SESSION['csrf_token']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Email already exists']);
}
?>
