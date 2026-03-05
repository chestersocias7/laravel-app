<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'ireply';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    echo "Connected to MySQL successfully\n";
    
    $stmt = $pdo->query("SHOW DATABASES LIKE '$db'");
    if ($stmt->rowCount() > 0) {
        echo "Database '$db' exists\n";
    } else {
        echo "Database '$db' DOES NOT exist\n";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
