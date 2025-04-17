<?php 
session_start();
require "../admins.php";
require "../models.php";

$db = new Database();
$dbconn = $db->connect();
$admin = new Admins($dbconn);

header("Content-Type: application/json");

if(!isset($_GET['request_id'])){
    $response = array(
        "code"=>400,
        "message"=>"Request Id isn't provided."
    );
    echo json_encode($response);
    die();
}

if(isset($_SESSION['email'])){
    $result = $admin->delete_admin($_GET['request_id']);
}

if(!$result){
    $response = array(
        "code"=>500,
        "message"=>"Something went Wrong."
    );
}
else{
    $response = array(
        "code"=>200,
        "message"=>"Admin deleted successfully",
        "rowsAffected"=>$result
    );
}


echo json_encode($response);
?>