<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->ODP_ID) 
	&& isset($data->Latitude) 
	&& isset($data->Longitude)  
	&& isset($data->Kapasitas)      
	&& !empty(trim($data->ODP_ID)) 
	&& !empty(trim($data->Latitude))
	&& !empty(trim($data->Longitude))
	&& !empty(trim($data->Kapasitas))
	){
    $ODPID = mysqli_real_escape_string($db_conn, trim($data->ODP_ID));
    $Lat = mysqli_real_escape_string($db_conn, trim($data->Latitude));
    $Long = mysqli_real_escape_string($db_conn, trim($data->Longitude));
    $Kaps = mysqli_real_escape_string($db_conn, trim($data->Kapasitas));
    
    $ODPSelect = mysqli_query($db_conn,"SELECT * FROM `odp` WHERE `ODP_ID`='$ODPID'");
    $row = mysqli_fetch_array($ODPSelect,MYSQLI_ASSOC);
    $usedKaps = $row['Kapasitas'] - $row['Kapasitas_After'];
    $currentKaps = $Kaps - $usedKaps;


    $GISHref = 'https://www.google.com/maps/?q='.$Lat.','.$Long;
    $TanggalInstalasi = date("Y-m-d H:i:s");
    
    $updateUser = mysqli_query($db_conn,"UPDATE `odp` 
                                            SET `GIS_href`='$GISHref', 
                                            `Latitude`='$Lat', 
                                            `Longitude`='$Long', 
                                            `Tanggal_Instalasi`='$TanggalInstalasi', 
                                            `Kapasitas`='$Kaps',
                                            `Kapasitas_After`='$currentKaps'  
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