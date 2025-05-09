<?php 
session_start();
require "../models.php";
require "../news.php";

$db = new Database();
$dbconn = $db->connect();
$news = new News($dbconn);

header("Content-Type: application/json");

if(isset($_SESSION['email'])){
    $result = $news->delete_news($_GET['id']);
}

?>