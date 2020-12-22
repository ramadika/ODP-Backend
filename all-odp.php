<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$ODPAll = mysqli_query($db_conn,"SELECT * FROM `odp`");
if(mysqli_num_rows($ODPAll) > 0){
    $all_ODP = mysqli_fetch_all($ODPAll,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"odp"=>$all_ODP]);
}
else{
    echo json_encode(["success"=>0]);
}