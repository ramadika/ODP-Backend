<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

// $ODPID  = $_POST['ODP_ID'];

$ODPID  = $data->ODP_ID;

$ODPSelect = mysqli_query($db_conn,"SELECT * FROM `port` WHERE `ODP_ID`='$ODPID'");
if(mysqli_num_rows($ODPSelect) > 0){
    $TheODP = mysqli_fetch_all($ODPSelect,MYSQLI_ASSOC);
    echo json_encode($TheODP);
}
else{
    echo json_encode(["success"=>0,"odp"=>$ODPID]);
}