<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$curr_date = date("Y-m-d");
$InstallDay = mysqli_query($db_conn,"SELECT COUNT(*) AS Installation FROM `odp` WHERE `Tanggal_Instalasi`='$curr_date'");
if(mysqli_num_rows($InstallDay) > 0){
    $count_InstallDay = mysqli_fetch_all($InstallDay,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"installDay"=>$count_InstallDay]);
}
else{
    echo json_encode(["success"=>0]);
}