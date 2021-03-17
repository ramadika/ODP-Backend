<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$curr_date = date("Y-m-d");
$yester_date = date('Y-m-d',strtotime("-1 days"));
$AdditionDay1 = mysqli_query($db_conn,"SELECT COUNT(*) AS Installation1 FROM `port` WHERE `Tanggal_Instalasi`='$curr_date'");
$AdditionDay2 = mysqli_query($db_conn,"SELECT COUNT(*) AS Installation2 FROM `port` WHERE `Tanggal_Instalasi`='$yester_date'");

$row1 = mysqli_fetch_array($AdditionDay1,MYSQLI_ASSOC);
$Today = $row1['Installation1'];
$row2 = mysqli_fetch_array($AdditionDay2,MYSQLI_ASSOC);
$Yesterday = $row2['Installation2'];

if ($Today < $Yesterday){
    $count_dismantleDay = $Yesterday - $Today;
}

if ($AdditionDay1 || $AdditionDay2){
    echo json_encode(["success"=>1,"dismantleDay"=>$count_dismantleDay]);
}
else{
    echo json_encode(["success"=>0]);
}