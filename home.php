<?php 
    session_start();
    if(!isset($_SESSION["role"])){
        $_SESSION["role"] = "default";
    }
    require 'php/models.php';
    require 'php/admins.php';
    require 'php/users.php';
    $db = new Database();
    $dbconn = $db->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <link href="css/home.css" rel="stylesheet" />

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
        <div class="container">
            <div class="description">
                <h1><span class="typewriter">Computer Science</span></h1>
                <p>Welcome to the Computer Science Department at UMBB. Access course materials, announcements, and key resources all in one place.</p>
            </div>
            <div class="land-img">
                <img src="picts/departement/landing3.png" class="landing">
            </div>
            
        </div>

    </main>

</body>