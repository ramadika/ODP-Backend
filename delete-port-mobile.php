<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));

$IDPelanggan        = $_POST['ID_Pelanggan'];
$ODPID              = $_POST['ODP_ID'];
$UserID             = $_POST['User_ID'];

if(isset($IDPelanggan) 
	&& isset($ODPID) 
	&& isset($UserID) 
	&& !empty(trim($IDPelanggan)) 
	&& !empty(trim($ODPID))
	&& !empty(trim($UserID))
	){
        
    $ODPSelect = mysqli_query($db_conn,"SELECT Kapasitas, Kapasitas_After FROM `odp` WHERE `ODP_ID`='$ODPID'");
    if(mysqli_num_rows($ODPSelect) > 0){
        $row = mysqli_fetch_array($ODPSelect,MYSQLI_ASSOC);
    
        $deleteCust = mysqli_query($db_conn,"DELETE FROM `port` WHERE `ID_Pelanggan`='$IDPelanggan'");
        if($deleteCust){
            $TheODPCapacity = $row['Kapasitas_After'] + 1;
            $updateCapacityODP = mysqli_query($db_conn,"UPDATE `odp` 
                                                    SET `Kapasitas_After`='$TheODPCapacity' 
                                                    WHERE `ODP_ID`='$ODPID'");
            echo json_encode(["success"=>1,"msg"=>"Data Deleted"]);
        }
        else{
            echo json_encode(["success"=>0,"msg"=>"Data Not Found!"]);
        }
    
    }
}
else{
    echo json_encode(["success"=>0,"msg"=>"Data Not Found!"]);
}