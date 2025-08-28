<?php
require_once __DIR__ . '/../../config.php';

$result = $mysqli->query("SELECT d.id, d.filename, d.size, d.filepath, l.slug FROM documents d LEFT JOIN links l ON l.document_id = d.id ORDER BY d.uploaded_at DESC");
$files = [];
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
// Ensure links work whether the project lives at the web root or in a
// subdirectory by prepending the detected base path.
$basePath = rtrim(dirname(dirname(dirname($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
while ($row = $result->fetch_assoc()) {
    if (!empty($row['slug'])) {
        $row['url'] = $scheme . $host . $basePath . '/file/' . $row['slug'];
    }
    unset($row['slug']);
    $files[] = $row;
}

echo json_encode(['files' => $files]);
