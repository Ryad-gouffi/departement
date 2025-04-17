<?php 
session_start();
header("Content-Type: application/json");

require "../models.php";

$db = new Database();
$dbconn = $db->connect();


if(!isset($_GET['request_id'])){
    $response = array(
        "code"=>400,
        "message"=>"Request Id isn't provided."
    );
    echo json_encode($response);
    die();
}

if(isset($_SESSION['email'])){
    $sql = $dbconn->prepare("DELETE FROM demandes WHERE id= ?");
}
else{
    $sql = $dbconn->prepare("DELETE FROM demandes WHERE id= ? and  foreign_key = ?");
    $sql->bindParam(2,$_SESSION["matricule"],PDO::PARAM_INT);
}
$sql->bindParam(1,$_GET['request_id'],PDO::PARAM_INT);

$sql->execute();
$rowCount = $sql->rowCount();
if(!$rowCount){
    $response = array(
        "code"=>500,
        "message"=>"Something went Wrong."
    );
}
else{
    $response = array(
        "code"=>200,
        "message"=>"Request deleted successfully",
        "rowsAffected"=>$rowCount
    );
}


echo json_encode($response);
?>