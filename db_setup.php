<?php
require 'Data/config.php';

$conn->query("CREATE TABLE IF NOT EXISTS spaces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    location VARCHAR(100),
    img VARCHAR(255),
    wifi_speed VARCHAR(20),
    has_power_outlets TINYINT(1) DEFAULT 0
)");

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    status ENUM('active','banned') DEFAULT 'active',
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$check = $conn->query("SELECT COUNT(*) as cnt FROM spaces")->fetch_assoc();
if ($check['cnt'] == 0) {
    $spaces = [
        ["Wild Jordan", "Cafe", "Old Amman", "public/WildJordan.jpg", "Fast", 1],
        ["University Library", "Library", "Irbid", "public/UniversityLibrary.jpg", "Medium", 0],
        ["Seven Pennies", "Cafe", "Amman", "public/SevenPennies.jpg", "Excellent", 1],
        ["Darat al Funun", "Cultural Space", "Lweibdeh", "public/darat-al-funun.webp", "Slow", 0],
        ["Blue Fig", "Cafe", "Abdoun", "public/BlueFig.jpg", "Fast", 1],
    ];
    $stmt = $conn->prepare("INSERT INTO spaces (name, type, location, img, wifi_speed, has_power_outlets) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($spaces as $s) {
        $stmt->bind_param("sssssi", $s[0], $s[1], $s[2], $s[3], $s[4], $s[5]);
        $stmt->execute();
    }
}

$check = $conn->query("SELECT COUNT(*) as cnt FROM users WHERE is_admin=1")->fetch_assoc();
if ($check['cnt'] == 0) {
    $hashed = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, is_admin) VALUES ('admin', ?, 1)");
    $stmt->bind_param("s", $hashed);
    $stmt->execute();
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
}

echo "<h2>Setup Complete!</h2>";
echo "<ul>";
echo "<li>Tables created: <strong>spaces</strong>, <strong>users</strong>, <strong>contact_messages</strong></li>";
echo "<li>5 study spaces seeded into the database</li>";
echo "<li>Admin account created: <strong>username: admin</strong> / <strong>password: admin123</strong></li>";
echo "<li>uploads/ directory ready</li>";
echo "</ul>";
echo '<a href="index.php">Go to Home</a>';
?>
