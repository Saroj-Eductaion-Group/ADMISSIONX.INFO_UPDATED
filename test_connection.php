<?php
// Test database connection
try {
    $pdo = new PDO(
        "mysql:host=34.72.122.148;dbname=web_admissionx_upgrade", 
        "root", 
        "Adx&Info2@2@!\$eg2025"
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM university");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✅ Found {$result['count']} universities in the database\n";
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}
?>