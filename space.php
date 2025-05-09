<?php 
    session_start();
    if(!isset($_SESSION["role"])){
        header("location:login.php");
    }
    require 'php/models.php';
    require 'php/admins.php';
    require 'php/users.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst($_SESSION["role"])?> Space</title>
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
    <link href="css/space.css" rel="stylesheet" />

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
                    <a href="space.php"><?=ucfirst($_SESSION["role"])?> Space</a>
                </nav>
                <div class="userCard">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div class="userCords">
                        <p>Welcome</p>
                        <?php 
                            $db = new Database();
                            $dbconn = $db->connect();
                            if($_SESSION["role"]=="student"){
                                $user = new User($dbconn);
                                $result = $user->user_data($_SESSION["matricule"]);
                                echo "<span>$result[name] $result[surname]</span>";
                            }
                            else if($_SESSION["role"]=="teacher" || $_SESSION["role"]=="admin"){
                                $user = new Admins($dbconn);
                                $result = $user->admin_data($_SESSION["email"]);
                                echo "<span>$result[fullname]</span>";
                            }
                            $dbconn = null;
                        ?>
                    </div>
                    <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
        </div>
    </header>
    
    <main>
        <h2><?=strtoupper($_SESSION["role"]);?> SPACE</h2>
        <div class="container">
            <div onclick="window.location.href='emails.php?path=emails'" class="box">
                <i class="fa-solid fa-envelope fa-4x"></i>
                <h3>Emails</h3>
                <div class="info">
                    <a>View</a>
                </div>
            </div>
            <div onclick="window.location.href='year.php?path=courses'" class="box">
                <i class="fa-solid fa-file-pdf fa-4x"></i>
                <h3>Courses</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <div onclick="window.location.href='year.php?path=notes'" class="box">
                <i class="fa-solid fa-graduation-cap fa-4x"></i>
                <h3>Notes</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <div onclick="window.location.href='year.php?path=edt'" class="box">
                <i class="fa-solid fa-clock fa-4x"></i>
                <h3>EDT</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <div onclick="window.location.href='year.php?path=exams'" class="box">
                <i class="fa-solid fa-calendar-days fa-4x"></i>
                <h3>Exams</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <?php if($_SESSION["role"]=="student"):?>
            <div onclick="window.location.href='index.php'" class="box">
                <i class="fa-solid fa-file-circle-plus fa-4x" ></i>
                <h3>Documents</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <?php endif;?>
            <?php if($_SESSION["role"]=="admin"):?>
            <div onclick="window.location.href='analytics.php'" class="box">
                <i class="fa-solid fa-file-circle-plus fa-4x" ></i>
                <h3>Documents</h3>
                <div class="info">
                    <a href="">View</a>
                </div>
            </div>
            <?php endif;?>
        </div>
    </main>

</body>