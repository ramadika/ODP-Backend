<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

$IDPelanggan        = $_POST['ID_Pelanggan'];
$AlamatPelanggan    = $_POST['Alamat'];
$TanggalInstalasi   = $_POST['Tanggal_Instalasi'];
$LayananPelanggan   = $_POST['Layanan'];
$ODPID              = $_POST['ODP_ID'];

if(isset($IDPelanggan) 
	&& isset($AlamatPelanggan) 
	&& isset($TanggalInstalasi) 
	&& isset($LayananPelanggan) 
	&& isset($ODPID) 
	&& !empty(trim($IDPelanggan)) 
	&& !empty(trim($AlamatPelanggan))
	&& !empty(trim($TanggalInstalasi))
	&& !empty(trim($LayananPelanggan))
	&& !empty(trim($ODPID))
	&& ($LayananPelanggan != "Pilih Paket")
	){
        
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