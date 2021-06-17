<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

$ODPID  = $_POST['ODP_ID'];
$Kaps   = $_POST['Kapasitas'];

// $ODPID  = $data->ODP_ID;
// $Kaps  = $data->Kapasitas;

if ($Kaps == 8 || $Kaps == '8' || $Kaps == "8") {
    $PortCheck = mysqli_query($db_conn,"SELECT * FROM `temp_8` WHERE `count_8` NOT IN  (SELECT Port_Number FROM `port` WHERE `ODP_ID` = '$ODPID')");
    if(mysqli_num_rows($PortCheck) > 0){
        $ThePort = mysqli_fetch_all($PortCheck,MYSQLI_ASSOC);
        echo json_encode($ThePort);
    }
    else{
        echo json_encode(["success"=>0,"odp"=>$ODPID]);
    }
}
else if ($Kaps == 16 || $Kaps == '16' || $Kaps == "16") {
    $PortCheck = mysqli_query($db_conn,"SELECT * FROM `temp_16` WHERE `count_16` NOT IN  (SELECT Port_Number FROM `port` WHERE `ODP_ID` = '$ODPID')");
    if(mysqli_num_rows($PortCheck) > 0){
        $ThePort = mysqli_fetch_all($PortCheck,MYSQLI_ASSOC);
        echo json_encode($ThePort);
    }
    else{
        echo json_encode(["success"=>0,"odp"=>$ODPID]);
    }
}