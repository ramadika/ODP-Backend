<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$InstallSummary = mysqli_query($db_conn,"SELECT Tanggal_Instalasi, COUNT(*) AS Installation FROM `odp` GROUP BY Tanggal_Instalasi");
if(mysqli_num_rows($InstallSummary) > 0){
    $count_Install = mysqli_fetch_all($InstallSummary,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"installSummary"=>$count_Install]);
}
else{
    echo json_encode(["success"=>0]);
}