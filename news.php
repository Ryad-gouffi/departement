<?php 
    session_start();
    if(!isset($_SESSION["role"])){
        header("location:login.php");
    }
    require 'php/models.php';
    require 'php/users.php';
    require 'php/admins.php';
    require 'php/news.php';
    $db = new Database();
    $dbconn = $db->connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
    <link href="css/news.css" rel="stylesheet" />

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
                        ?>
                    </div>
                    <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>NEWS</h2>
        <div class="container">
            <div class="news">
                <?php
                if($_SESSION["role"]!="teacher"):
                ?>
                <ul id="categories" class="coffee">
                <a href="news.php?level=all"><li class="bbtn" id="all">ALL</li></a>
                    <a href="news.php?level=l1"><li data-val="l1">L1</li></a>
                    <a href="news.php?level=l2"><li data-val="l2">L2</li></a>
                    <a href="news.php?level=l3"><li data-val="l3">L3</li></a>
                    <a href="news.php?level=m1"><li data-val="m1">M1</li></a>
                    <a href="news.php?level=m2"><li data-val="m2">M2</li></a>
                </ul>
                <?php
                endif;
                if($_SESSION["role"]=="teacher"):
                ?>
                <div class="postNews">
                    <form action="php/process.php" method="post" id="news">
                        <input type="hidden" name="categories" value="all" id="catval">
                        <ul id="categories">
                            <li class="bbtn" id="all">ALL</li>
                            <li data-val="l1">L1</li>
                            <li data-val="l2">L2</li>
                            <li data-val="l3">L3</li>
                            <li data-val="m1">M1</li>
                            <li data-val="m2">M2</li>
                        </ul>
                        <div class="info">
                                <input type="hidden" name="target" value="addnews">
                                <img src="picts/person.png"  alt="" class="pfp">
                                <textarea required id="postDesctiption" name="postDesctiption" placeholder="Post something..." rows="1" ></textarea>
                                <i class="fa-regular fa-paper-plane" id="addnews"></i>
                        </div>
                    </form>
                </div>
                <?php endif;?>
                <?php 
                    $user = new News($dbconn);
                    $level = isset($_GET["level"])? $_GET["level"] : "all";
                    $result = $user->get_news($level);
                    
                    foreach ($result as $key => $value): ?>
                    <div class="newsCard" id=news<?=$value['id']?>>
                        <div class="info">
                            <img src="picts/person.png" alt="" class="pfp">
                            <div class="wrapper">
                                <span class="author"><?=$value['fullname']?></span>
                                <span class="date"><?=$value['news_date_posted']?></span>
                            </div>
                            
                            <?php if($_SESSION["email"] == $value["email"]):?>
                                <i class="fa-solid fa-x" style="font-size: 18px;" onclick="deletenews(<?=$value['id']?>)"></i>
                            <?php else:?>
                                <i class="fa-solid fa-ellipsis"></i>
                            <?php endif;?>
                        </div>
                        <p class="description"><?=$value['news_content']?></p>
                    </div>
                <?php endforeach;?>
                
            </div>
        </div>
    </main>
    <script src="js/news.js"></script>
</body>