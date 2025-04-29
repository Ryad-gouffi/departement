<?php
// download.php

$path = $_GET['path'] ?? '';
$filename = $_GET['file'] ?? '';

$fullPath = __DIR__ . '/uploads/' . $path . '/' . $filename;

if (!empty($filename) && file_exists($fullPath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fullPath));
    readfile($fullPath);
    exit;
} else {
    echo "File not found.";
}
?>
