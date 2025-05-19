<?php
session_start();
if(!isset($_SESSION["role"])){
    $_SESSION["role"] = "default";
}
require 'php/models.php';
require 'php/admins.php';
require 'php/users.php';

// browse.php
$db = new Database();
$dbconn = $db->connect();

$currentPath = isset($_GET['path']) ? $_GET['path'] : '';
// Get current folder contents from DB
$stmt = $dbconn->prepare("SELECT * FROM files WHERE path = ?");
$stmt->execute([$currentPath]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


$breadcrumbParts = explode('/', $currentPath);
$breadcrumbLinks = [];
$tmpPath = '';
$first = true;
$section = '';
foreach ($breadcrumbParts as $part) {
    if ($part === '') continue;

    if ($first) {
        // Link the first part to a specific PHP file
        $section = $part;
        $breadcrumbLinks[] = "<a href='year.php?path=$part'>" . htmlspecialchars($part) . "</a>";
        $tmpPath = $part;
        $first = false;
    } else {
        $tmpPath .= '/' . $part;
        $breadcrumbLinks[] = "<a href='?path=" . urlencode($tmpPath) . "'>" . htmlspecialchars($part) . "</a>";
    }
}

$breadcrumb = implode(' / ', $breadcrumbLinks);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=strtoupper($section)?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="picts/departement/logo1removed.png" type="image/x-icon">
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/global2.css" rel="stylesheet" />
    <link href="css/header.css" rel="stylesheet" />
    <style>
        .containerbtns{
            display: flex;
            justify-content: flex-end;
            margin-bottom: 18px;
            align-items: center;
            font-size: 14px;
        }
        .containerbtns span{
            margin-left: 12px;
        }
        .createfolder{
            margin-left: 8px;
            display: flex;
            border: solid 1px var(--paragraph);
            padding: 4px 8px;
            border-radius: 6px;
            align-items: center;
            cursor: pointer;
        }
        .uploadbtn{
            display: inline-block;
            background-color: var(--main-color-alt);
            color: white;
            padding: 5px 9px;
            border-radius: 6px;
            cursor: pointer;
        }
        i.fa-folder-plus{
            color: var(--paragraph);
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border-bottom: 1px solid #ccc; }
        th { text-align: left; background: #f2f2f2; }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <a href="home.php" class="logo"><img src="picts/departement/logo1removed.png" alt=""></a>
            <div class="wrapper">
                <nav>
                    <a href="home.php">Home</a>
                    <a href="news.php">News</a>
                    <a href="events.php">Events</a>
                    <a href="space.php"><?= $_SESSION["role"]=="default" ? "Gestion" : ucfirst($_SESSION["role"]) . "Space"?></a>
                    <?php if($_SESSION["role"]=="default" || $_SESSION["role"]=="student"):?>
                    <a href="index.php">Document Request</a>
                </nav>
                <div class="auth">
                <i class="fa-solid fa-user-graduate"></i>
                    <a href="login.php">Teacher Space</a>
                </div>
                <?php else:?>
                </nav>
                <div class="userCard">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div class="userCords">
                        <p>Welcome</p>
                        <?php
                        if ($_SESSION["role"] == "teacher" || $_SESSION["role"] == "admin") {
                            $user = new Admins($dbconn);
                            $result = $user->admin_data($_SESSION["email"]);
                            echo "<span>$result[fullname]</span>";
                        }
                        ?>
                    </div>
                    <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
                <?php endif;?>
            </div>
        </div>
    </header>
    <main>
    <h2><?=strtoupper($section)?></h2>
        <div class="container">

            
            <p>Path: <?= $breadcrumb ?: '/' ?></p>
            <?php if($_SESSION["role"]=="teacher" && $section=="grades" || $_SESSION["role"]=="admin" && $section!="grades"):?>
                <div class="containerbtns">
                    <div class="uploadbtn" data-bs-toggle="modal" data-bs-target="#uploadFile">
                        <i class="fa-solid fa-upload"></i>
                        <span>Upload</span>
                    </div>
                    <div class="createfolder" data-bs-toggle="modal" data-bs-target="#createFolder">
                        <i class="fa-solid fa-folder-plus"></i>
                        <span>New folder</span>
                    </div>
                </div>
            <?php endif;?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($items as $item): ?>
                    <tr>
                        
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?php echo $item['type'] == 'folder' ? '📁 Folder' :'<i class="fa-solid fa-file-pdf"></i> File' ?></td>
                        <td><?= htmlspecialchars($item['author']) ?></td>
                        <td><?= htmlspecialchars($item['description']) ?></td>
                        <td>
                            <?php if ($item['type'] == 'folder'): ?>
                                <a href="?path=<?= urlencode($currentPath ? $currentPath . '/' . $item['name'] : $item['name']) ?>">Open</a>
                            <?php else: ?>
                                <a href="manager/download.php?file=<?= urlencode($currentPath . '/' . $item['name']) ?>">⬇ Download</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="modal fade" id="createFolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Folder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="manager/create_folder.php" method="post" style="margin-top:10px;">
                        <div class="modal-body">
                            <p>Give this folder a name</p>
                            <input type="hidden" name="path" value="<?= htmlspecialchars($currentPath) ?>">
                            <input type="text" name="folder_name" placeholder="Folder name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="uploadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Folder</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="manager/upload.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="path" value="<?= htmlspecialchars($currentPath) ?>">
                            <input type="hidden" name="author" value="<?= $result["fullname"] ?>">
                            <input type="text" name="description" placeholder="Description">
                            <input type="file" name="file" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary">UPLOAD</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

    </main>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
</body>

</html>