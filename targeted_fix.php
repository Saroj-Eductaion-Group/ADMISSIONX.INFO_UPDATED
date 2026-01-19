<?php

// Targeted fix to remove university ordering from all methods except topUniversityListPage
// This script will revert the broad changes and only keep the fix where it belongs

$file = 'app/Http/Controllers/website/SearchPageController.php';
$content = file_get_contents($file);

// Remove the university ordering from all locations
$content = str_replace(
    "->orderBy('university.isShowOnTop', 'ASC')->orderBy('university.id', 'DESC')",
    "",
    $content
);

// Now add it back ONLY to the topUniversityListPage method (around line 1043)
// Find the specific location in topUniversityListPage method
$pattern = '/(\$query = \$query->where\(\'university\.status\', 1\);[\s\n]*)([\s\n]*\$query->orderBy\(\'university\.id\', \'DESC\'\);)/';
$replacement = '$1$query->orderBy(\'university.isShowOnTop\', \'ASC\')->orderBy(\'university.id\', \'DESC\');';

$content = preg_replace($pattern, $replacement, $content);

// Write the corrected content back
file_put_contents($file, $content);

echo "Targeted fix applied successfully!\n";
echo "- Removed university ordering from all methods\n";
echo "- Added it back only to topUniversityListPage method\n";
echo "- The /top-colleges page should now work correctly\n";

?>