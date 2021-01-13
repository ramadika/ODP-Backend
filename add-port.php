<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if(isset($data->ID_Pelanggan) 
	&& isset($data->Alamat) 
	&& isset($data->Tanggal_Instalasi) 
	&& isset($data->Layanan) 
	&& isset($data->ODP_ID) 
	&& !empty(trim($data->ID_Pelanggan)) 
	&& !empty(trim($data->Alamat))
	&& !empty(trim($data->Tanggal_Instalasi))
	&& !empty(trim($data->Layanan))
	&& !empty(trim($data->ODP_ID))
	){
    
    $IDPelanggan = mysqli_real_escape_string($db_conn, trim($data->ID_Pelanggan));
    $AlamatPelanggan = mysqli_real_escape_string($db_conn, trim($data->Alamat));
    $TanggalInstalasi = mysqli_real_escape_string($db_conn, trim($data->Tanggal_Instalasi));
    $LayananPelanggan = mysqli_real_escape_string($db_conn, trim($data->Layanan));
    $ODPID = mysqli_real_escape_string($db_conn, trim($data->ODP_ID));
        
    $ODPSelect = mysqli_query($db_conn,"SELECT Kapasitas FROM `odp` WHERE `ODP_ID`='$ODPID'");
    if(mysqli_num_rows($ODPSelect) > 0){
        $row = mysqli_fetch_array($ODPSelect,MYSQLI_ASSOC);

        if ($row['Kapasitas'] > 0) {
        
            $insertUser = mysqli_query($db_conn,"INSERT INTO `port`(`ID_Pelanggan`,`Alamat`,`Tanggal_Instalasi`,`Layanan`,`ODP_ID`) 
                                                    VALUES('$IDPelanggan','$AlamatPelanggan','$TanggalInstalasi','$LayananPelanggan','$ODPID')");
            $last_id = mysqli_insert_id($db_conn);

            if($insertUser){
                $TheODPCapacity = $row['Kapasitas'] - 1;
                $updateCapacityODP = mysqli_query($db_conn,"UPDATE `odp` 
                                                        SET `Kapasitas`='$TheODPCapacity' 
                                                        WHERE `ODP_ID`='$ODPID'");

                echo json_encode(["success"=>1,"msg"=>"Data Created.","Port_ID"=>$last_id]);
            }
            else{
                echo json_encode(["success"=>0,"msg"=>"Data Not Created!"]);
            }
        }
        else{
            echo json_encode(["Success"=>0, "Message"=>"Empty Port"]);
        }

    }
    else{
        echo json_encode(["success"=>0,"Message"=>"Data not Found","odp"=>$ODPID]);
    }

}else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}