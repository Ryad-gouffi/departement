<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:admin.php");
}
require 'php/models.php';
require 'php/admins.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/admingestion.css">
</head>
<body class="d-flex">
    <div class="side-menu" id="side-menu">
        <div class="header">
            <div class="logo">
                <a href=""><img src="picts/newlogo.svg" alt=""></a>
                <span>ZED</span>
            </div>
            <div class="minimize" id="minimize">
                <i class="fa-solid fa-angle-left"></i>
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
        <nav>
            <ul class="nav-header">
                <a  href="analytics.php">
                    <li>
                        <i class="fa-solid fa-chart-pie"></i><span>Analytics</span>
                    </li>
                </a>
                <a class="extend" data-val="requests">
                    <li>
                        <i class="fa-solid fa-inbox"></i><span>Requests</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                </a>
                <ul class="submenu" id="requests">
                        <div class="LXV">
                            <a href="requests.php?level=0"><li class="active">All</li></a>
                            <a href="requests.php?level=1"><li>L1</li></a>
                            <a href="requests.php?level=2"><li>L2</li></a>
                            <a href="requests.php?level=3"><li>L3</li></a>
                            <a href="requests.php?level=4"><li>M1</li></a>
                            <a href="requests.php?level=5"><li>M2</li></a>
                    </div>
                </ul>
                <a class="active" href="adminsgestion.php"><li><i class="fa-solid fa-user"></i><span>Admins</span></li></a>
            </ul>

            <div class="nav-footer">
                <span class="hr"></span>
                <div id="admin" class="admin">
                    <img src="picts/user.png" alt="">
                    <div class="coords">
                    <?php 
                            $db = new Database();
                            $dbconn = $db->connect();
                            $admin = new Admins($dbconn);
                            $result = $admin->admin_data($_SESSION["email"]); // current admin data
                            echo "<span>$result[fullname]</span>";
                            $dbconn = null;
                        ?>
                        <span>Admin</span>
                    </div>
                </div>
                
                <a class="logout" href="php/logout.php?admin=1"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </nav>
    </div>

    <main>

        <div class="header">
            <span>Requests</span>
            <i id="moon" class="fa-solid fa-moon"></i>
            <i id="sun" class="fa-solid fa-sun active"></i>
        </div>
        <div class="parent">
            <div class="management">
                <span>Credentals</span>
                <ul id="managementul">
                    <li  class="active" data-page="page1"><i class="fa-solid fa-user-plus"></i><button>New admin</button></li>
                    <li data-page="page2"><i class="fa-solid fa-lock"></i><button>Admins</button></li>
                </ul>
            </div>
            <div class="output">
                <div class="page page1 active" id="page1">
                    <span><i class="fa-solid fa-plus"></i>Add a new admin</span>
                    <form action="php/process.php" method="post">
                        <?php 
                            if(isset($_SESSION['Error'])){
                                echo "<span id='error-span'>$_SESSION[Error]</span>";
                                unset($_SESSION["Error"]); 
                            }
                        ?>
                        <input type="hidden" name="target" value="addAdmin">
                        <div class="fullname">
                            <div class="field">
                                <i class="fa-solid fa-user"></i>
                                <span>Full name</span>
                            </div>
                            <input type="text" name="fullname" required placeholder="john doe">
                        </div>
                        <span class="hr"></span>
                        <div class="email">
                            <div class="field">
                                <i class="fa-solid fa-at"></i>
                                <span>Email</span>
                            </div>
                            <input type="email" name="email" required placeholder="john@example.dz">
                        </div>
                        <span class="hr"></span>
                        <div class="password">
                            <div class="field">
                                <i class="fa-solid fa-key"></i>
                                <span>Password</span>
                            </div>
                            <input type="password" name="password" required placeholder="******">
                        </div>
                        <span class="hr"></span>
                        <div class="confirm-pass">
                            <div class="field">
                                <i class="fa-solid fa-lock"></i>
                                <span>Confirm password</span>
                            </div>
                            <input type="password" name="confirm-pass" required placeholder="******">
                        </div>
                        <input type="submit" name="submit" value="Add admin">
                    </form>
                </div>
                <div class="page page2" id="page2">
                    <span><i class="fa-solid fa-user-group"></i>Current admins</span>
                    <div class="admins">
                        <?php 
                            $dbconn = $db->connect();
                            $admin = new Admins($dbconn);

                            $result = $admin->all_admins();
                            foreach ($result as $key => $value) {
                                echo '<div class="admin"><div class="info"><img src="picts/user.png" alt=""><div class="coords">';
                                echo "<span class=\"admin-name\">$value[fullname]</span>";
                                echo "<p class=\"admin-email\">$value[email]</p>";
                                echo "</div></div><i data-bs-toggle=\"modal\" data-bs-target=\"#deleteRequest\" class=\"fa-solid fa-trash-can\"></i></div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            <!-- Delete Request Modal -->
    <div class="modal fade" id="deleteRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-danger">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-trash"></i>Delete Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    Are you sure you want to delete Admin!
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalclosebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="modaldeletebtn"  class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/admingestion.js"></script>
</body>

</html>