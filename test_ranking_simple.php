<?php
// Simple database test without Laravel
$host = 'localhost';
$dbname = 'web_admissionx_upgrade';
$username = 'root';
$password = 'Adx&Info2@2@!$eg2025';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== TESTING RANKING SYSTEM ===\n\n";
    
    // Test 1: Check university rankings
    echo "1. Top 10 Universities with Rankings:\n";
    $stmt = $pdo->query("
        SELECT u.name as university_name, u.ranking, COUNT(cp.id) as college_count
        FROM university u
        LEFT JOIN collegeprofile cp ON u.id = cp.university_id
        WHERE u.ranking <= 10
        GROUP BY u.id, u.name, u.ranking
        ORDER BY u.ranking
    ");
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  Rank {$row['ranking']}: {$row['university_name']} ({$row['college_count']} colleges)\n";
    }
    
    echo "\n=== TEST COMPLETED ===\n";
    
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
?>