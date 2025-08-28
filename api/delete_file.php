<?php
require_once __DIR__ . '/../config.php';

$id = $_POST['id'] ?? null;
if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing file id']);
    exit;
}

$stmt = $mysqli->prepare("SELECT filepath FROM documents WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($filepath);
if (!$stmt->fetch()) {
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
}
$stmt->close();

$fullPath = __DIR__ . '/../uploads/' . $filepath;
if (file_exists($fullPath)) {
    unlink($fullPath);
}

$del = $mysqli->prepare("DELETE FROM documents WHERE id=?");
$del->bind_param('i', $id);
$del->execute();

echo json_encode(['success' => true]);
