<?php
session_start();
if (!isset($_SESSION["role"])) {
    header("location:login.php");
}
require 'php/models.php';
require 'php/users.php';
require 'php/admins.php';
require 'php/events.php';
$db = new Database();
$dbconn = $db->connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
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
    <link href="css/events.css" rel="stylesheet" />

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
                    <a href="space.php"><?= ucfirst($_SESSION["role"]) ?> Space</a>
                </nav>
                <div class="userCard">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div class="userCords">
                        <p>Welcome</p>
                        <?php
                        if ($_SESSION["role"] == "student") {
                            $user = new User($dbconn);
                            $result = $user->user_data($_SESSION["matricule"]);
                            echo "<span>$result[name] $result[surname]</span>";
                        } else if ($_SESSION["role"] == "teacher" || $_SESSION["role"] == "admin") {
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
        <h2>EVENTS</h2>
        <?php
        $user = new Events($dbconn);
        $result = $user->get_events();
        if (isset($_GET["postid"])):
            echo '<div class="container showoff">';
            $targetevent = $user->get_event($_GET["postid"]);
        ?>
            <div class="blog">
                <span><?= $targetevent['event_title'] ?></span>
                <img src="php/uploads/eventspict/<?= $targetevent['image_path'] ?>" alt="">
                <p><?= $targetevent['event_content'] ?></p>
            </div>
            <div class="eventsblock">
                <?php foreach ($result as $key => $value):
                    if ($value['id'] != $_GET['postid']):
                ?>
                        <div class="recent" id=<?= $value['id'] ?>>
                            <img src="php/uploads/eventspict/<?= $value['image_path'] ?>" alt="">
                            <div class="wrapper">
                                <span><?= $value['event_title'] ?></span>
                                <p><?= $value['event_content'] ?></p>
                            </div>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
        <?php else: ?>
            <div class="container">
                <?php if ($_SESSION["role"] == "admin"): ?>
                    <div class="addEvent" data-bs-toggle="modal" data-bs-target="#addEvent">
                        <img src="picts/event.png" alt="">
                        <div class="wrappers">
                            <span>New event</span>
                            <p>here you can post new event ...</p>
                            <button>Post</button>
                        </div>
                    </div>
                <?php endif;
                foreach ($result as $key => $value): ?>
                    <div class="event" onclick="" id=<?= $value['id'] ?>>
                        <img src="php/uploads/eventspict/<?= $value['image_path'] ?>" alt="">
                        <div class="wrapper">
                            <span><?= $value['event_title'] ?></span>
                            <div class="unique">
                                <p><?= $value['event_content'] ?></p>
                            </div>
                            <div class="footer">
                                <a>Read More</a>
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach;

                ?>
            <?php endif; ?>
            <!-- MODAL -->
            <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-danger">
                            <h1 class="modal-title fs-5 text-primary " id="exampleModalLabel1"><i class="fa-solid fa-pen-to-square"></i>Add event</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="php/process.php" method="post" id="postevents" enctype="multipart/form-data">
                            <input type="hidden" name="target" value="addEvents">
                            <div class="modal-body ">
                                <div class="editRow">
                                    <div class="imgrow rowss">
                                        <i class="fa-solid fa-image"></i>
                                        <span>Select an image :</span>
                                        <label for="eventimg" class="custom-file-upload">Browse</label>
                                    </div>
                                    <input type="file" id="eventimg" name="eventimg" accept="image/*" required style="display: none;">
                                    <img id="preview" src="#" alt="Image preview" style="display: none;max-width: 50%;margin-top: 15px;margin-left: auto;margin-right: auto;" />
                                </div>
                                <div class="editRow">
                                    <div class="titlerow rowss">
                                        <i class="fa-solid fa-header"></i>
                                        <span>Title :</span>
                                    </div>
                                    <input id="eventtitle" name="eventtitle" type="text" required placeholder="Your title here...">
                                </div>
                                <div class="editRow">
                                    <div class="descrow rowss">
                                        <i class="fa-solid fa-paragraph"></i>
                                        <span>Description :</span>
                                    </div>
                                    <textarea name="eventdesc" id="eventdesc" required placeholder="Describe your event"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="modalclosebtn1" class="btn" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="submit" id="modalupdatebtn" value="Post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </main>
    <script>
        const ev = Array.from(document.getElementsByClassName("event"));
        const re = Array.from(document.getElementsByClassName("recent"));
        ev.forEach(element => {
            element.addEventListener("click", () => {
                window.location.href = "events.php?postid=" + encodeURIComponent(element.id);
            });
        });
        re.forEach(element => {
            element.addEventListener("click", () => {
                window.location.href = "events.php?postid=" + encodeURIComponent(element.id);
            });
        });

        document.getElementById('eventimg').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
</body>