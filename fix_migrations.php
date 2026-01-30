<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'admissionx';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    
    // Drop migrations table
    $pdo->exec("USE `$db_name`");
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    $pdo->exec("DROP TABLE IF EXISTS migrations");
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    
    echo "Migrations table dropped successfully\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
