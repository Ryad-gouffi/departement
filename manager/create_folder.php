<?php
// create_folder.php
$pdo = new PDO("mysql:host=localhost;dbname=users;charset=utf8", "ryad", "ryad", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = $_POST['path'] ?? '';
    $folderName = $_POST['folder_name'] ?? '';
    $author = $_POST['author'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!empty($folderName)) {
        $newFolderPath = __DIR__ . '/uploads/' . ($path ? $path . '/' : '') . $folderName;

        if (!is_dir($newFolderPath)) {
            mkdir($newFolderPath, 0777, true);

            // Insert folder info into database
            $stmt = $pdo->prepare("INSERT INTO files (name, type, path, author, description) VALUES (?, 'folder', ?, ?, ?)");
            $stmt->execute([$folderName, $path, $author, $description]);
        }
    }
}

header("Location: ../browse.php?path=" . urlencode($path));
exit;
