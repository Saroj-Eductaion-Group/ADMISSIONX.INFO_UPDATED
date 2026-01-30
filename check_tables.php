<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'admissionx';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->exec("USE `$db_name`");
    
    // Check if collegeprofile table exists
    $stmt = $pdo->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'collegeprofile'");
    $stmt->execute([$db_name]);
    $result = $stmt->fetch();
    
    if ($result) {
        echo "✓ collegeprofile table EXISTS\n";
    } else {
        echo "✗ collegeprofile table NOT FOUND\n";
    }
    
    // List all tables
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?");
    $stmt->execute([$db_name]);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "\nTotal tables in database: " . $count['count'] . "\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
