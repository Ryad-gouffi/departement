<?php

require 'php/models.php';
require 'php/users.php';
require 'php/demandes.php';
$db = new Database();
$dbconn = $db->connect();
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "student") {
    header("location:login.php?stp=true");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document request</title>
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
    <link href="css/index.css" rel="stylesheet" />
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
        <h2>DOCUMENTS</h2>
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-tab="page1">Add a request</button>
                <button class="tab" data-tab="page2">Show Requests</button>
                <div class="userCardss">
                    <div class="userCords">
                        <?php
                        $db = new Database();
                        $dbconn = $db->connect();
                        if ($_SESSION["role"] == "student") {
                            $user = new User($dbconn);
                            $result = $user->user_data($_SESSION["matricule"]);
                            echo "<span>$result[name] $result[surname]</span>";
                        }
                        ?>
                    </div>
                    <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
            <div id="page1" class="page page1 active">
                <form action="php/process.php" method="post">
                    <input type="hidden" name="target" value="demand">
                    <span class="kite">Demande d'un fichier :</span>
                    <?php
                    if (isset($_SESSION["Error"])) {
                        echo "<span id='error-span'>$_SESSION[Error]</span>";
                        unset($_SESSION["Error"]);
                    }
                    ?>
                    <div class="data">
                        <input type="hidden" name="typefichier" id="dropdownval">
                        <div class="dropdown">
                            <div class="select">
                                <span>certificat</span>
                                <div class="arrow"></div>
                            </div>
                            <ul class="">
                                <li class="active" data-val="certificat">certificat</li>
                                <li data-val="attestation">attestation</li>
                                <li data-val="releve">releve</li>
                            </ul>
                        </div>

                        <div class="matriculedata">
                            <input type="email" name="email" id="email" placeholder="Email">
                            <label for="matricule">Email:</label>
                        </div>
                        <div class="matriculedata">
                            <input type="text" name="numerotlfn" id="numerotlfn" placeholder="Numero telephone">
                            <label for="matricule">Numero telephone:</label>
                        </div>


                    </div>
                    <textarea placeholder="Description Here..." name="descriptions" id="" maxlength="1000"></textarea>

                    <div class="remember">
                        <span id="toggler" class="on">
                            <span class="yes">ON</span>
                            <span class="no">OFF</span>
                            <span class="off"></span>
                        </span>
                        <input type="hidden" name="urgent" value="0" id="urgent">
                        <label for="urgent">Demande urgent ?</label>
                    </div>
                    <input type="date" value="2024-01-01" name="urgentdate" id="urgentdate">
                    <input type="submit" name="submit" value="Submit">

                </form>
            </div>
            <div id="page2" class="page page2">
                <table>
                    <thead>
                        <th>Type</th>
                        <th>Add on</th>
                        <th>Urgent</th>
                        <th>Observation</th>
                        <th>status</th>
                        <th>Cancel</th>
                    </thead>
                    <tbody>
                        <?php
                        //reconnecting to db, it is not good to keep connected to db
                        // that's why i keep closing and opening connections
                        $dbconn = $db->connect();
                        $demand = new Demandes($dbconn);

                        $result = $demand->demande_data_foreign_key($_SESSION["matricule"]);
                        foreach ($result as $key => $value) {
                            echo "<tr data-request-id=\"$value[id]\">
                                <td>$value[typefichier]</td>
                                <td>$value[addon]</td>";
                            if ($value['urgent'] === 1) {
                                echo "<td>YES</td>";
                            } else {
                                echo "<td>NO</td>";
                            }
                            echo "<td>$value[observation]</td>";
                            if ($value['statu'] === "ready") {
                                echo "<td><i class=\"fa-solid fa-circle-check\"></i>$value[statu]</td>";
                            } elseif ($value['statu'] === "inprocess") {
                                echo "<td><i class=\"fa-solid fa-arrows-rotate\"></i>In process</td>";
                            } elseif ($value['statu'] === "refused") {
                                echo "<td><i class=\"fa-solid fa-circle-xmark\"></i>Refused</td>";
                            } else {
                                echo "<td>$value[statu]</td>";
                            }
                            echo "<td><i data-bs-toggle=\"modal\" data-bs-target=\"#deleteRequest\" class=\"fa-solid fa-trash-can\"></i></td></tr>";
                        }
                        $dbconn = null;
                        ?>
                    </tbody>
                </table>
                <!-- Delete Request Modal -->
                <div class="modal fade" id="deleteRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header text-danger">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-trash"></i>Delete Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                                Are you sure you want to Cancel the request:
                                <p id="modal-row-fullname"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="modalclosebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="modaldeletebtn" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
</body>

</html>