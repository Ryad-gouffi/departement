<?php

$currentPath = isset($_GET['path']) ? $_GET['path'] : '';

$breadcrumbParts = explode('/', $currentPath);
$breadcrumbLinks = [];
$tmpPath = '';
$first = true;

foreach ($breadcrumbParts as $part) {
    if ($part === '') continue;

    if ($first) {
        // Link the first part to a specific PHP file
        $breadcrumbLinks[] = "<a href='year.php?path=$part'>" . htmlspecialchars($part) . "</a>";
        $tmpPath = $part;
        $section =  $part;
        $first = false;
    } else {
        $tmpPath .= '/' . $part;
        $breadcrumbLinks[] = "<a href='?path=" . urlencode($tmpPath) . "'>" . htmlspecialchars($part) . "</a>";
    }
}

$breadcrumb = implode(' / ', $breadcrumbLinks);
?>