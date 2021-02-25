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

// $IDPelanggan        = $data->ID_Pelanggan;
// $ODPID              = $data->ODP_ID;
// $UserID             = $data->User_ID;

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
            if($row['Kapasitas'] == 8){
                if ($TheODPCapacity == 0){
                    $KlasifikasiODP_ID = 1;
                } else if ($TheODPCapacity >= 1 && $TheODPCapacity <= 4){
                    $KlasifikasiODP_ID = 2;
                } else if ($TheODPCapacity >= 5 && $TheODPCapacity <= 7){
                    $KlasifikasiODP_ID = 3;
                } else if ($TheODPCapacity == 8){
                    $KlasifikasiODP_ID = 4;
                }
            } else if ($row['Kapasitas'] == 16){
                if ($TheODPCapacity == 0){
                    $KlasifikasiODP_ID = 1;
                } else if ($TheODPCapacity >= 1 && $TheODPCapacity <= 8){
                    $KlasifikasiODP_ID = 2;
                } else if ($TheODPCapacity >= 9 && $TheODPCapacity <= 15){
                    $KlasifikasiODP_ID = 3;
                } else if ($TheODPCapacity == 16){
                    $KlasifikasiODP_ID = 4;
                }
            }
            $updateCapacityODP = mysqli_query($db_conn,"UPDATE `odp` 
                                                    SET `Kapasitas_After`='$TheODPCapacity',
                                                        `User_ID`='$UserID',
                                                        `KlasifikasiODP_ID`='$KlasifikasiODP_ID'   
                                                    WHERE `ODP_ID`='$ODPID'");
            echo json_encode(["success"=>1,"msg"=>"Data Deleted"]);
        }
        else{
            echo json_encode(["success"=>0,"msg"=>"Data Not Found!"]);
        }
    
    }
}
else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}