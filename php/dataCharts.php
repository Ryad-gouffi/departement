<?php
if(!isset($_GET["chart"])){
    die();
}

require "config.php";
$path = "mysql:host=" . dbhost . ";dbname=" . dbname;
$conn = new PDO($path, dbuser,dbpass);
if((int)$_GET["chart"]===1){
    $sql = $conn->prepare("SELECT user_table.styear AS rowname, count(*) AS count FROM demandes JOIN user_table ON demandes.foreign_key = user_table.matricule GROUP BY user_table.styear; ");
}
else if((int)$_GET["chart"]===2){
    $sql = $conn->prepare("SELECT typefichier AS rowname,count(*) AS count FROM `demandes` GROUP BY demandes.typefichier;");
}
else if((int)$_GET["chart"]===3){
    $sql = $conn->prepare("SELECT statu AS rowname, count(*) AS count FROM demandes GROUP BY demandes.statu;");
}
else if((int)$_GET["chart"]===4){
    $sql = $conn->prepare("SELECT addon AS rowname, count(*) AS count FROM `demandes` GROUP BY demandes.addon;");
}
else{
    die();
}

$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

if((int)$_GET["chart"]===1){ // must be after $sql->execute(); that's why i didn't put in the first IF statement ,Ryad
    $studyYearMap = [
        1 => 'L1',
        2 => 'L2',
        3 => 'L3',
        4 => 'M1',
        5 => 'M2'
    ];
    
    $labels = [];
    foreach ($result as $row) {
        $labels[] = $studyYearMap[$row['rowname']];
    }
}
else{
    $labels = array_column($result, 'rowname');
}

$counts = array_column($result, 'count');

$response = [
    "labels"=>$labels,
    "counts"=> $counts
];

header('Content-Type: application/json');
echo json_encode($response);

?>