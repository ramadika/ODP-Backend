<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$PortView = mysqli_query($db_conn,"SELECT * FROM `port`");
if(mysqli_num_rows($PortView) > 0){
    $ThePort = mysqli_fetch_all($PortView,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"odp"=>$ThePort]);
    // echo json_encode($ThePort);
}
else{
    echo json_encode(["success"=>0]);
}