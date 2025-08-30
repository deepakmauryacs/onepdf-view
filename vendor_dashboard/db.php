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

$mysqli->query("CREATE TABLE IF NOT EXISTS user_plan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    plan_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

// Table for uploaded documents
$mysqli->query("CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    size BIGINT NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

// Ensure user_id column exists for older installations
$colResDocs = $mysqli->query("SHOW COLUMNS FROM documents LIKE 'user_id'");
if ($colResDocs && $colResDocs->num_rows === 0) {
    $mysqli->query("ALTER TABLE documents ADD COLUMN user_id INT NOT NULL AFTER id");
    $mysqli->query("ALTER TABLE documents ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE");
}

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

// Table for contact form submissions
$mysqli->query("CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    company VARCHAR(100),
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Table for newsletter subscriptions
$mysqli->query("CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
?>
