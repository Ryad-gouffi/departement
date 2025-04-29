<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
session_start();
header("Content-Type: application/json");

require "../models.php";

$db = new Database();
$dbconn = $db->connect();

$jsonData = json_decode(file_get_contents('php://input'), true); 

if(!isset($jsonData["id"])){
    $response = array(
        "code"=>500,
        "message"=>"id is not set."
    );
    echo json_encode($response); 
    die();
}
switch ($jsonData["statu"]) {
    case 1:
        $statu = "ready";
        break;
    case 2:
        $statu = "inprocess";
        break;
    case 3:
        $statu = "refused";
        break;
    
    default:
        break;
}

$sql = $dbconn->prepare("UPDATE demandes SET observation=? , statu=? WHERE id=?");
$sql->bindParam(1,$jsonData['observation'],PDO::PARAM_STR);
$sql->bindParam(2,$statu,PDO::PARAM_STR);
$sql->bindParam(3,$jsonData['id'],PDO::PARAM_INT);
$sql->execute();
$rowCount = $sql->rowCount();
if(!$rowCount){
    $response = array(
        "code"=>200,
        "message"=>"No Rows Affected."
    );
}
else{
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host= 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ryadgouffi@gmail.com';
        $mail->Password= 'wdwf rsjb zxqq verj ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port= 587;

        $mail->setFrom('ryadgouffi@gmail.com');
        $mail->addAddress($jsonData['mail']);
        $mail->isHTML(true);
        $mail->Subject = 'Request Updated!';
        $mail->Body= '<h2>Your request '. $jsonData['type'] .' is <span style="color:#CB3CFF;">' . $statu . " !</span></h2>";

        $mail->send();
        $response = array(
            "code"=>200,
            "message"=>"User Updated successfully",
            "rowsAffected"=>$rowCount
        );
    } catch (Exception $e) {
        $response = array(
            "code"=>400,
            "message"=>"Email not sent and the request has been updated"
        );
    }

}

echo json_encode($response);
?>