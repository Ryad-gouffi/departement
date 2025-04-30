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
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
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
                if($_SESSION["role"]=="teacher"):
                ?>
                <div class="postNews">
                    <div class="info">
                        <img src="picts/person.png"  alt="" class="pfp">
                        <textarea id="postDesctiption" name="postDesctiption" value="Post something..." rows="1" ></textarea>
                        <i class="fa-regular fa-paper-plane"></i>
                    </div>
                </div>
                <?php endif;?>
                <?php 
                    $user = new News($dbconn);
                    $result = $user->get_news();
                    
                    foreach ($result as $key => $value): ?>
                    <div class="newsCard" id=<?=$value['id']?>>
                        <div class="info">
                            <img src="picts/person.png" alt="" class="pfp">
                            <div class="wrapper">
                                <span class="author"><?=$value['news_publisher']?></span>
                                <span class="date"><?=$value['news_date_posted']?></span>
                            </div>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <p class="description"><?=$value['news_content']?></p>
                    </div>
                <?php endforeach;?>
                
            </div>
        </div>
    </main>
    <script>
    const textarea = document.getElementById("postDesctiption");

    textarea.addEventListener("input", () => {
    textarea.style.height = "auto"; // reset height
    textarea.style.height = (textarea.scrollHeight + 4) + "px"; // adjust height
    });
    </script>
</body>