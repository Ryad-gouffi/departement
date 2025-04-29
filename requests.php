<?php 
    session_start();
    if(!isset($_SESSION["email"])){
        header("location:admin.php");
    }

    require 'php/models.php';
    require 'php/demandes.php';
    require 'php/admins.php';
    $db = new Database();
    $dbconn = $db->connect();
    $demandes = new Demandes($dbconn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link href="css/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link rel="stylesheet" href="libs/datatable/dataTables.css">
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/requests.css">
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
                <a class="extend active" data-val="requests">
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
            <span>Requests</span>
            <i id="moon" class="fa-solid fa-moon"></i>
            <i id="sun" class="fa-solid fa-sun active"></i>
        </div>
        <div class="all">
            <table id="tablerequest">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Type</th>
                        <th>Added</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Observation</th>
                        <th>Urgent Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!isset($_GET["level"]) || empty($_GET["level"])){
                            $_GET["level"] = 0;
                        }
                        $result = $demandes->all_demandes($_GET["level"]);

                        foreach($result as $key=>$value){
                            echo "<tr data-request-id='$value[id]'>";
                            foreach($value as $k=>$val){
                                if($k==="id"){
                                    continue;
                                }
                                else if($k==="statu"){
                                    switch ($val) {
                                        case 'ready':
                                            echo "<td class='text-success'><i class=' fa-solid fa-circle-check'></i><span>ready</span></td>";
                                            break;
                                        case 'refused':
                                            echo '<td class=\'text-danger\'><i class=" fa-solid fa-circle-xmark"></i></i><span>refused</span></td>';
                                            break;
                                        default:
                                            echo '<td ><i class=" fa-solid fa-arrows-rotate"></i><span>in process</span></td>';
                                            break;
                                    }
                                }
                                else{
                                    echo "<td>$val</td>";
                                }
                            };
                            echo "<td>
                                    <div class=\"options\">
                                        <i data-bs-toggle=\"modal\" data-bs-target=\"#editRequest\" class=\"fa-solid text-primary fa-pen-to-square\"></i>
                                        <i data-bs-toggle=\"modal\" data-bs-target=\"#deleteRequest\" class=\"fa-solid fa-trash-can\"></i>
                                    </div>
                                </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <!-- Delete Request Modal -->
            <div class="modal fade" id="deleteRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-danger">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-trash"></i>Delete Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        Are you sure you want to delete the request made by : 
                        <p id="modal-row-fullname"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modalclosebtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="modaldeletebtn"  class="btn btn-danger">Delete</button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editRequest" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-danger">
                        <h1 class="modal-title fs-5 text-primary " id="exampleModalLabel1"><i class="fa-solid fa-pen-to-square"></i>Edit Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-fingerprint"></i>
                                <span>Matricule:</span>
                            </div>
                            <input id="editInputMatricule" type="text" readonly>
                        </div>
                        <div class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-user"></i>
                                <span>Full name:</span>
                            </div>
                            <input id="editInputName" type="text"  readonly>
                        </div>
                        <div class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-file-lines"></i>
                                <span>Type:</span>
                            </div>
                            <input id="editInputType" type="text"  readonly>
                        </div>
                        <div class="editRow">
                            <div class="rowname">
                            <i class="fa-solid fa-at"></i>
                                <span>Email:</span>
                            </div>
                            <input id="editInputEmail" type="text"  readonly>
                        </div>
                        <div class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-phone"></i>
                                <span>Phone:</span>
                            </div>
                            <input id="editInputPhone" type="text" readonly>
                        </div>
                        <div class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-bookmark"></i>
                                <span>Observation:</span>
                            </div>
                            <textarea name="observation" id="editObservation" placeholder="Enter your observation here..." ></textarea>
                        </div>
                        <div data-bs-theme="dark"  class="editRow">
                            <div class="rowname">
                                <i class="fa-solid fa-gear"></i>
                                <span>Status:</span>
                            </div>
                            <select id="editSelectOption" class="form-select" aria-label="Default select example">
                                <option class="text-success" value="1">Ready</i></option>
                                <option class="" value="2" >In process</option>
                                <option class="text-danger" value="3">Refused</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modalclosebtn1" class="btn" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="modalupdatebtn"  class="btn">Update</button>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="libs/bootstrapv5/bootstrap.bundle.min.js"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="libs/datatable/dataTables.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/requests.js"></script>
</body>

</html>