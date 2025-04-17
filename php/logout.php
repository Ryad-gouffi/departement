<?php
session_start();
if(isset($_GET["admin"]) && (int)$_GET["admin"] === 1){
    $_SESSION["email"] = null;
    header("location:../admin.php");

}
else{
    $_SESSION["matricule"] = null;
    header("location:../login.php");
}
// session_unset();
// session_destroy();
?>