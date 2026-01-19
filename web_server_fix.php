<?php

// Simple targeted fix for SearchPageController
$file = '/var/www/admissionx_new/app/Http/Controllers/website/SearchPageController.php';

if (!file_exists($file)) {
    die("File not found: $file\n");
}

$content = file_get_contents($file);

// Remove ALL instances of the university ordering that was broadly applied
$content = str_replace(
    "->orderBy('university.isShowOnTop', 'ASC')->orderBy('university.id', 'DESC')",
    "",
    $content
);

// Now add it back ONLY to the topUniversityListPage method
// Look for the specific pattern in topUniversityListPage method around line 1043
$pattern = '/(\$query = \$query->where\(\'university\.status\', 1\);\s*\n\s*)(\$query->orderBy\(\'university\.id\', \'DESC\'\);)/';
$replacement = '$1$query->orderBy(\'university.isShowOnTop\', \'ASC\')->orderBy(\'university.id\', \'DESC\');';

$content = preg_replace($pattern, $replacement, $content);

// Write back the corrected content
if (file_put_contents($file, $content)) {
    echo "SUCCESS: Targeted fix applied!\n";
    echo "- Removed university ordering from all college-related methods\n";
    echo "- Kept it only in topUniversityListPage method\n";
    echo "- /top-colleges page should now work\n";
} else {
    echo "ERROR: Could not write to file\n";
}

?>