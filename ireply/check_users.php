<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'ireply';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Users in '$db':\n";
    foreach ($users as $u) {
        echo "- ID: {$u['id']}, Name: {$u['name']}, Email: {$u['email']}, Role: {$u['role']}\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
