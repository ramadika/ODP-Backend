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

// $ODPID  = $data->ODP_ID;

$ODPSelect = mysqli_query($db_conn,"SELECT * FROM `odp` WHERE `ODP_ID`='$ODPID'");
if(mysqli_num_rows($ODPSelect) > 0){
    $TheODP = mysqli_fetch_all($ODPSelect,MYSQLI_ASSOC);
    echo json_encode($TheODP);
}
else{
    echo json_encode(["success"=>0,"odp"=>$ODPID]);
}


// // Convert ByteArray
// function byteArray2Hex($byteArray) {
//     $chars = array_map("chr", $byteArray);
//     $bin = join($chars);
//     return bin2hex($bin);
// }

// function string2Hex($string) {
//     return bin2hex($string);
// }

// function byteArray2String($byteArray) {
//   $chars = array_map("chr", $byteArray);
//   return join($chars);
// }

// $odpbytearray = [2, 101, 110, 109, 101];
// $odpstring = 'enme';
// $b = byteArray2Hex($odpbytearray);
// $c = string2Hex($odpstring);
// $d = byteArray2String($odpbytearray);

// echo json_encode(["b"=>$b,"c"=>$c,"d"=>$d]);