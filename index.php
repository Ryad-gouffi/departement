<?php 

require 'php/models.php';
require 'php/users.php';
require 'php/demandes.php';

session_start() ;

if(!isset($_SESSION["matricule"])){
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="container">
            <a href="#"><img src="picts/newlogo.svg" alt=""></a>
            <div class="userCard">
                <i class="fa-solid fa-user-graduate"></i>
                <div class="userCords">
                    <p>Welcome</p>
                    <?php 
                            $db = new Database();
                            $dbconn = $db->connect();
                            $user = new User($dbconn);
                            $result = $user->user_data($_SESSION["matricule"]);
                            echo "<span>$result[name] $result[surname]</span>";
                            $dbconn = null;
                    ?>
                    
                </div>
                <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-tab="page1" >Add a request</button>
                <button class="tab" data-tab="page2" >Show Requests</button>
            </div>
            <div id="page1" class="page page1 active">
                <form action="php/process.php" method="post">
                    <input type="hidden" name="target" value="demand">
                    <span class="kite">Demande d'un fichier :</span>
                    <?php 
                        if(isset($_SESSION["Error"])){
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
                                <li data-val="attestation" >attestation</li>
                                <li data-val="releve">releve</li>
                            </ul>
                        </div>

                        <div class="matriculedata">
                            <input type="email" name ="email" id="email" placeholder="Email">
                            <label for="matricule">Email:</label>
                        </div>
                        <div class="matriculedata">
                            <input type="text" name ="numerotlfn" id="numerotlfn" placeholder="Numero telephone">
                            <label for="matricule">Numero telephone:</label>
                        </div>

                        
                    </div>
                    <textarea  placeholder="Description Here..." name="descriptions" id="" maxlength="1000"></textarea>
                    
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
                                if($value['urgent']===1){
                                    echo "<td>YES</td>";
                                }
                                else{
                                    echo "<td>NO</td>";
                                }
                                echo "<td>$value[observation]</td>";
                                if($value['statu']==="ready"){
                                    echo "<td><i class=\"fa-solid fa-circle-check\"></i>$value[statu]</td>";
                                }
                                elseif($value['statu']==="inprocess"){
                                    echo "<td><i class=\"fa-solid fa-arrows-rotate\"></i>In process</td>";
                                }
                                elseif($value['statu']==="refused")
                                {
                                    echo "<td><i class=\"fa-solid fa-circle-xmark\"></i>Refused</td>";
                                }
                                else{
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
                            <button type="button" id="modaldeletebtn"  class="btn btn-danger">Delete</button>
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