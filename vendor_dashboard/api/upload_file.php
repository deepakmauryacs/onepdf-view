<?php
require_once __DIR__ . '/../../config.php';

// Support uploads sent as either `file` or `pdf`
$key = isset($_FILES['file']) ? 'file' : (isset($_FILES['pdf']) ? 'pdf' : null);
if ($key === null) {
    http_response_code(400);
    echo json_encode(['error' => 'No file uploaded']);
    exit;
}

$file = $_FILES[$key];
if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Upload failed']);
    exit;
}

// Validate file type (PDF or image)
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
if (strpos($mime, 'application/pdf') !== 0 && strpos($mime, 'image/') !== 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Only PDF or image files are allowed']);
    exit;
}

// Validate file size (<= 50MB)
$maxSize = 50 * 1024 * 1024; // 50MB
if ($file['size'] > $maxSize) {
    http_response_code(400);
    echo json_encode(['error' => 'File exceeds 50MB limit']);
    exit;
}

$uploadDir = dirname(__DIR__, 2) . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = basename($file['name']);
$target = $uploadDir . $filename;
$index = 1;
while (file_exists($target)) {
    $target = $uploadDir . $index . '_' . $filename;
    $index++;
}

if (!move_uploaded_file($file['tmp_name'], $target)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save file']);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO documents (filename, filepath, size) VALUES (?,?,?)");
$relative = 'uploads/' . basename($target);
$stmt->bind_param('ssi', $filename, $relative, $file['size']);
$stmt->execute();

echo json_encode(['success' => true]);
