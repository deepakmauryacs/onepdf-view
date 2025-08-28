<?php
require_once __DIR__ . '/../config.php';

$result = $mysqli->query("SELECT id, filename, size, filepath FROM documents ORDER BY uploaded_at DESC");
$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

echo json_encode(['files' => $files]);
