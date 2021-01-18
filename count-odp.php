<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$ODPCount = mysqli_query($db_conn,"SELECT COUNT(*) as JumlahODP, SUM(Kapasitas_After) as StandbyPort FROM `odp`");
if(mysqli_num_rows($ODPCount) > 0){
    $count_ODP = mysqli_fetch_all($ODPCount,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"countodp"=>$count_ODP]);
}
else{
    echo json_encode(["success"=>0]);
}