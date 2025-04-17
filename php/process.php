<?php
session_start();

if(!($_SERVER["REQUEST_METHOD"]==="POST")){
    echo "NO POST REQUEST SENT";
    die();
}

require 'models.php';
require 'users.php';
require 'admins.php';
require 'demandes.php';

try {
    $db = new Database();
    $dbconn = $db->connect();
    $user = new User($dbconn);
    $demand = new Demandes($dbconn);
    $admin = new Admins($dbconn);
    $target = $_POST['target'] ?? '';
    switch ($target) {
        case 'login':
            if (isset($_POST['submit'])) {
                if (!empty($_POST['matricule']) && !empty($_POST['password'])) {
                    if(!ctype_digit($_POST["matricule"])){
                        $_SESSION["Error"] = "matricule incorrect";
                        header("location:../login.php");
                        die();
                    }
        
                    $result = $user->user_data($_POST["matricule"]);  // check if user exists, and fetch all the data
        
                    if ($result) {
                        if ($_POST["password"] === $result["password"]) {
                            $_SESSION["matricule"] = $result["matricule"];
                            header("location:../index.php");
                            die();
                        } else {
                            $_SESSION["Error"] = "wrong password";
                        }
                    }
                    else{
                        $_SESSION["Error"] = "matricule doesn't exist";
                    }
                } else {
                    $_SESSION["Error"] = "please fill in all the informations";
                }
            } else {
                $_SESSION["Error"] = "Submit Button was not pressed";
            }
            header("location:../login.php");
            break;

        case 'demand':
            if(isset($_POST["submit"]) && isset($_POST["typefichier"])){
                if(empty(trim($_POST["typefichier"]))){
                    $_SESSION["Error"] = "Type of Dropdown is empty";
                    header("location:../index.php");
                    die();
                }
                if(!empty($_POST["numerotlfn"]) && !ctype_digit($_POST["numerotlfn"])){
                    $_SESSION["Error"] = "Try a valid phone number!";
                    header("location:../index.php");
                    die();
                }
                $date = date('Y-m-d');
                $statu = "inprocess";
                
                if((int)$_POST["urgent"]===1){
                    $p = $_POST["urgentdate"];
                }
                else{
                    $p = null;
                }
                $check = $demand->demande_data_foreign_key($_SESSION["matricule"]);
                foreach($check as $key=>$value){
                    if($value["typefichier"] === $_POST["typefichier"]){
                        $_SESSION["Error"] = "You already requested this Type!";
                        header("location:../index.php");
                        die();
                    }
                }
                $result = $demand->insert_demand($_POST["typefichier"],$date,$_POST["email"],$_POST["numerotlfn"],$_POST["descriptions"],$_POST["urgent"],$p,$statu,$_SESSION["matricule"]);
                if($result>0){
                    // successfully inserted
                }
                else{
                    // err
                }
            }
            header("location:../index.php");
            
            break;
        case 'addAdmin':
            $fullname = trim($_POST["fullname"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $confirmpassword = $_POST["confirm-pass"];
            
            if(isset($_POST["submit"]) && isset($fullname) && isset($email) && isset($password) && isset($confirmpassword)){
                if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword)) {
                    $_SESSION["Error"] = "All fields are required.";
                    header("location:../adminsgestion.php");
                    die();
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["Error"] = "Invalid email format.";
                    header("location:../adminsgestion.php");
                    die();
                }
                if ($password !== $confirmpassword) {
                    $_SESSION["Error"] = "Passwords do not match.";
                    header("location:../adminsgestion.php");
                    die();
                }
                // check if email exists
                $result = $admin->admin_data($email);
                if($result){
                    $_SESSION["Error"] = "Email already Exists!";
                    header("location:../adminsgestion.php");
                    die();
                }
                $result2 = $admin->add_admin($fullname,$email,$password);
                if($result2 == 0){
                    $_SESSION["Error"] = "something went wrong and the admin wasn't added!";
                    header("location:../adminsgestion.php");
                    die();
                }
                header("location:../analytics.php");
            }
            break;
        case 'loginAsAdmin':
            if (isset($_POST['submit'])) {
                if ($_POST["email"] && $_POST["password"]) {
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        $_SESSION["Error"] = "Invalid email format.";
                        header("location:../admin.php");
                        die();
                    }
        
                    $result = $admin->admin_data($_POST["email"]);  // check if admin exists, and fetch all the data
        
                    if ($result) {
                        if ($_POST["password"] === $result["password"]) {
                            $_SESSION["email"] = $result["email"];
                            header("location:../analytics.php");
                        } else {
                            $_SESSION["Error"] = "wrong password";
                            header("location:../admin.php");
                            die();
                        }
                    }
                    else{
                        $_SESSION["Error"] = "Email doesn't exist";
                        header("location:../admin.php");
                        die();
                    }
                } else {
                    $_SESSION["Error"] = "please fill in all the informations";
                    header("location:../admin.php");
                    die();
                }
            } else {
                die("Submit Button was not pressed");
            }
            break;
        case 'sign-up':
            $matricule = $_POST["matricule"];
            $styear = (int)$_POST["styear"];
            $name = trim($_POST["susername"]);
            $surname = trim($_POST["surname"]);
            $password = $_POST["password"];
            $confirmpassword = $_POST["confirm-password"];
            
            if(isset($_POST["submit"]) && isset($matricule) && isset($styear) && isset($name) && isset($surname) && isset($password) && isset($confirmpassword)){
                if (empty($matricule) || empty($name) || empty($surname) || empty($password) || empty($confirmpassword)) {
                    $_SESSION["Error"] = "All fields are required.";
                    header("location:../signup.php");
                    die();
                }
                if (!ctype_digit($matricule)) {
                    $_SESSION["Error"] = "Invalid matricule format.";
                    header("location:../signup.php");
                    die();
                }
                if ($password !== $confirmpassword) {
                    $_SESSION["Error"] = "Passwords do not match.";
                    header("location:../signup.php");
                    die();
                }
                if($styear>5 || $styear < 1){
                    $_SESSION["Error"] = "Invalid study year.";
                    header("location:../signup.php");
                    die();
                }
                // check if matricule exists
                $result = $user->user_data($matricule);
                if($result){
                    $_SESSION["Error"] = "Matricule already Exists!";
                    header("location:../signup.php");
                    die();
                }
                $result2 = $user->add_user($matricule,$password,$name,$surname,$styear);
                if($result2 == 0){
                    $_SESSION["Error"] = "something went wrong and the User wasn't added!";
                    header("location:../signup.php");
                    die();
                }
                header("location:../login.php");
            }
            break;
        default:
            die("No action.");
    }

} catch (PDOException $error) {
    echo "ERROR<br>";
    print_r($error->errorInfo);
} finally {
    $dbconn = null;
}
