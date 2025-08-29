<?php
// Database connection using MySQLi
$host = '127.0.0.1';
$db   = 'onepdf';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
$mysqli->set_charset($charset);

$mysqli->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    use_id CHAR(16) NOT NULL,
    country VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    agreed_terms TINYINT(1) NOT NULL DEFAULT 0
)");

// Table for uploaded documents
$mysqli->query("CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    size BIGINT NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Table for generated links
$mysqli->query("CREATE TABLE IF NOT EXISTS links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    document_id INT NOT NULL,
    slug VARCHAR(20) NOT NULL UNIQUE,
    permissions JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (document_id) REFERENCES documents(id) ON DELETE CASCADE
)");

// Analytics for link views
$mysqli->query("CREATE TABLE IF NOT EXISTS link_analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    link_id INT NOT NULL,
    event VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (link_id) REFERENCES links(id) ON DELETE CASCADE
)");

// Ensure created_at exists for installations created before this column
$colRes = $mysqli->query("SHOW COLUMNS FROM link_analytics LIKE 'created_at'");
if ($colRes && $colRes->num_rows === 0) {
    $mysqli->query("ALTER TABLE link_analytics ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
}
?>
