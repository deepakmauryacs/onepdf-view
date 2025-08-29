<?php
require_once __DIR__ . '/../../config.php';

$id = $_POST['id'] ?? null;
// Allow optional permissions.  If none are provided default to an empty JSON
// object so links can still be generated and later viewed.
$permJson = $_POST['permissions'] ?? '{}';
if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

$perms = json_decode($permJson, true);
if ($perms === null) {
    // Malformed JSON – fall back to no permissions instead of failing.
    $permJson = '{}';
}

// Build base URL dynamically for localhost or production
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
// Determine the application's base path (e.g. "/onepdf-view") so generated
// links work whether the project lives in a subdirectory or at the web root.
$basePath = rtrim(dirname(dirname(dirname($_SERVER['SCRIPT_NAME'] ?? ''))), '/');

// Check if a link already exists for this document. If so, simply update
// its permissions and return the existing URL instead of creating a new slug.
$stmt = $mysqli->prepare("SELECT slug FROM links WHERE document_id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($existingSlug);
if ($stmt->fetch()) {
    $stmt->close();

    $stmt = $mysqli->prepare("UPDATE links SET permissions = ? WHERE document_id = ?");
    $stmt->bind_param('si', $permJson, $id);
    $stmt->execute();
    if ($stmt->affected_rows < 0) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update link']);
        exit;
    }

    $url = $scheme . $host . $basePath . '/file/' . $existingSlug;
    echo json_encode(['url' => $url]);
    exit;
}
$stmt->close();

// No existing link: generate a new slug and insert a new row.
$slug = bin2hex(random_bytes(5));
$url  = $scheme . $host . $basePath . '/file/' . $slug;

$stmt = $mysqli->prepare("INSERT INTO links (document_id, slug, permissions) VALUES (?,?,?)");
$stmt->bind_param('iss', $id, $slug, $permJson);
$stmt->execute();

if ($stmt->affected_rows <= 0) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save link']);
    exit;
}

echo json_encode(['url' => $url]);
