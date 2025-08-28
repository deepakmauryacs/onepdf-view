<?php
require_once __DIR__ . '/../../config.php';

$id = $_POST['id'] ?? null;
$permJson = $_POST['permissions'] ?? null;
if (!$id || !$permJson) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

$perms = json_decode($permJson, true);
if ($perms === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid permissions']);
    exit;
}

// Generate unique slug
$slug = bin2hex(random_bytes(5));
$url  = 'https://onepdf.io/file/' . $slug;

$stmt = $mysqli->prepare("INSERT INTO links (document_id, slug, permissions) VALUES (?,?,?)");
$stmt->bind_param('iss', $id, $slug, $permJson);
$stmt->execute();

if ($stmt->affected_rows <= 0) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save link']);
    exit;
}

echo json_encode(['url' => $url]);
