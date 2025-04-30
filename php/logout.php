<?php
session_start();
$_SESSION["role"] = null;
$_SESSION["email"] = null;
$_SESSION["matricule"] = null;
header("location:../login.php");
// session_unset();
// session_destroy();
?>