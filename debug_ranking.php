<?php
// Debug script to test the university ranking query
require_once 'bootstrap/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== DEBUGGING IIM BANGALORE IMAGE ===\n\n";

try {
    // Find IIM Bangalore
    $iim = DB::table('university')
        ->where('name', 'LIKE', '%IIM%')
        ->orWhere('name', 'LIKE', '%Indian Institute of Management%')
        ->orWhere('name', 'LIKE', '%Bangalore%')
        ->select('id', 'name', 'pageslug', 'logoimage', 'status')
        ->get();
    
    echo "Found Universities:\n";
    foreach ($iim as $uni) {
        echo "ID: {$uni->id}\n";
        echo "Name: {$uni->name}\n";
        echo "Slug: {$uni->pageslug}\n";
        echo "Logo: {$uni->logoimage}\n";
        echo "Status: {$uni->status}\n";
        
        // Check if image file exists
        $imagePath = "/var/www/admissionx_new/public/common-logo/{$uni->pageslug}/{$uni->logoimage}";
        $imageExists = file_exists($imagePath) ? "YES" : "NO";
        echo "Image Path: {$imagePath}\n";
        echo "Image Exists: {$imageExists}\n";
        
        // Check directory
        $dirPath = "/var/www/admissionx_new/public/common-logo/{$uni->pageslug}";
        $dirExists = is_dir($dirPath) ? "YES" : "NO";
        echo "Directory Exists: {$dirExists}\n";
        
        if (is_dir($dirPath)) {
            $files = scandir($dirPath);
            echo "Files in directory: " . implode(', ', array_diff($files, ['.', '..'])) . "\n";
        }
        
        echo "---\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>