<?php 
session_start();
require 'php/models.php';
require 'php/admins.php';
if(!isset($_SESSION["email"])){
    header("location:admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/analytics.css">
</head>
<body class="d-flex"> 
    <?php
            $db = new Database();
            $dbconn = $db->connect();
            $sql1 = $dbconn->query("SELECT count(*) AS total FROM `demandes`;");
            $sql2 = $dbconn->query("SELECT count(*) AS total FROM `demandes`WHERE demandes.statu!=\"inprocess\";");
            $sql3 = $dbconn->query("SELECT count(*) AS total FROM `demandes`WHERE demandes.statu=\"inprocess\" AND demandes.urgent=1;");
            $total_requests = $sql1->fetch(PDO::FETCH_ASSOC)["total"];
            $total_f_requests = $sql2->fetch(PDO::FETCH_ASSOC)["total"];
            $total_unf_requests = $total_requests - $total_f_requests;
            $total_unf_urgent_requests = $sql3->fetch(PDO::FETCH_ASSOC)["total"];
            $dbconn = null;
    ?>
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
                <a class="active" href="analytics.php">
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
                <a href="adminsgestion.php"><li><i class="fa-solid fa-user"></i><span>Admins</span></li></a>
            </ul>

            <div class="nav-footer">
                <span class="hr"></span>
                <div id="admin" class="admin">
                    <img src="picts/user.png" alt="">
                    <div class="coords">
                    <?php 
                            $dbconn = $db->connect();
                            $admin = new Admins($dbconn);
                            $result = $admin->admin_data($_SESSION["email"]); // current admin data
                            echo "<span>$result[fullname]</span>";
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
            <span>Analytics</span>
            <i id="moon" class="fa-solid fa-moon"></i>
            <i id="sun" class="fa-solid fa-sun active"></i>
        </div>
        <div class="stats">
            <div class="card total">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Total Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo $total_requests;?></span>
            </div>
            <div class="card finished">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <span>Finished Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo $total_f_requests;?></span>
            </div>
            <div class="card unfinished">
                <div class="card-header">
                    <div class="title">
                        <i class="fa-brands fa-square-x-twitter"></i>
                        <span>Unfinished Requests</span>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <span><?php echo "$total_unf_requests <span>$total_unf_urgent_requests Urgent</span>";?></span>
            </div>
        </div>
        <div class="chartscontainer">
            <div class="card pie">
                <div class="charts">
                    <div class="chart-btns">
                        <button class="active" onclick="destroyChart(this); fetchCreateChart('myChart',1,'pie')">By Year</button>
                        <button onclick="destroyChart(this); fetchCreateChart('myChart',2,'pie')">By Type</button>
                        <button onclick="destroyChart(this); fetchCreateChart('myChart',3,'pie')">By Statu</button>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="card line">
                <div class="charts">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</body>

</html>