<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));
if(isset($data->ID_Pelanggan) 
	&& isset($data->Alamat) 
	&& isset($data->Tanggal_Instalasi) 
	&& isset($data->Layanan) 
	&& isset($data->ODP_ID) 
	&& isset($data->User_ID) 
	&& !empty(trim($data->ID_Pelanggan)) 
	&& !empty(trim($data->Alamat))
	&& !empty(trim($data->Tanggal_Instalasi))
	&& !empty(trim($data->Layanan))
	&& !empty(trim($data->ODP_ID))
	&& !empty(trim($data->User_ID))
	){
    
    $IDPelanggan = mysqli_real_escape_string($db_conn, trim($data->ID_Pelanggan));
    $ODPID = mysqli_real_escape_string($db_conn, trim($data->ODP_ID));
    $UserID = mysqli_real_escape_string($db_conn, trim($data->User_ID));


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
    echo json_encode(["success"=>0,"msg"=>"User Not Found!"]);
}