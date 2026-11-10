<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "student_portal";

// Create connection using PDO for secure database operations
if (!class_exists('\PDO')) {
    die("PDO is not available. Enable the PDO and pdo_mysql extensions in your PHP configuration.");
}

try {
    $pdo = new \PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    // Set PDO error mode to exception for better debugging
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>