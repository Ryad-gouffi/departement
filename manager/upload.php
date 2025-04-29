<?php
// upload.php
$pdo = new PDO("mysql:host=localhost;dbname=users;charset=utf8", "ryad", "ryad", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = $_POST['path'] ?? '';
    $author = $_POST['author'] ?? '';
    $description = $_POST['description'] ?? '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/' . ($path ? $path . '/' : '');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $stmt = $pdo->prepare("INSERT INTO files (name, type, path, author, description) VALUES (?, 'file', ?, ?, ?)");
            $stmt->execute([$fileName, $path, $author, $description]);
        }
    }
}

header("Location: ../browse.php?path=" . urlencode($path));
exit;
