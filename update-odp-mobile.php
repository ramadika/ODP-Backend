<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$ODPID  = $_POST['ODP_ID'];
$Lat    = $_POST['Latitude'];
$Long   = $_POST['Longitude'];

if(isset($ODPID) 
	&& isset($Lat) 
	&& isset($Long)    
	&& !empty(trim($ODPID)) 
	&& !empty(trim($Lat))
	&& !empty(trim($Long))
	){

    $GISHref = 'https://www.google.com/maps/?q='.$Lat.','.$Long;
    $TanggalInstalasi = date("Y-m-d H:i:s");
    

    $updateUser = mysqli_query($db_conn,"UPDATE `odp` 
                                            SET `GIS_href`='$GISHref', `Latitude`='$Lat', `Longitude`='$Long', `Tanggal_Instalasi`='$TanggalInstalasi' 
                                            WHERE `ODP_ID`='$ODPID'");
    if($updateUser){
        echo json_encode(["success"=>1,"msg"=>"Data Updated.","href"=>$GISHref]);
    }
    else{
        echo json_encode(["success"=>0,"msg"=>"Data Not Updated!"]);
    }
}
else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}