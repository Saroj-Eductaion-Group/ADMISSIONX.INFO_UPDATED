<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'admissionx';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->exec("USE `$db_name`");
    
    // Get all migration files
    $migration_dir = 'database/migrations';
    $files = scandir($migration_dir);
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // Get existing migrations from table
    $stmt = $pdo->prepare("SELECT migration FROM migrations");
    $stmt->execute();
    $executed = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $executed = array_flip($executed);
    
    $batch = 1;
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') continue;
        
        // Remove .php extension for the migration name
        $migration_name = pathinfo($file, PATHINFO_FILENAME);
        
        // Check if migration already executed
        if (isset($executed[$migration_name])) {
            echo "Skipping: $migration_name (already executed)\n";
            continue;
        }
        
        // Insert into migrations table
        $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
        $stmt->execute([$migration_name, $batch]);
        
        echo "Marked as executed: $migration_name\n";
    }
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    echo "\nAll migrations marked as executed successfully\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
