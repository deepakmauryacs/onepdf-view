<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_FILES['pdf'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No file uploaded']);
    exit;
}

$file = $_FILES['pdf'];
if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Upload failed']);
    exit;
}

// Validate file type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file(finfo, $file['tmp_name']);
finfo_close($finfo);
if ($mime !== 'application/pdf') {
    http_response_code(400);
    echo json_encode(['error' => 'Only PDF files are allowed']);
    exit;
}

// Validate file size (<= 50MB)
$maxSize = 50 * 1024 * 1024; // 50MB
if ($file['size'] > $maxSize) {
    http_response_code(400);
    echo json_encode(['error' => 'File exceeds 50MB limit']);
    exit;
}

$uploadDir = __DIR__ . '/../uploads/';
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
$relative = basename($target);
$stmt->bind_param('ssi', $filename, $relative, $file['size']);
$stmt->execute();

echo json_encode(['success' => true]);
