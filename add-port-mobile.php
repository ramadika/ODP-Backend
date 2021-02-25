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
$LayananPelanggan   = $_POST['Layanan'];
$PowerSignal        = $_POST['Power_Signal'];
$SNModem            = $_POST['SN_Modem'];
$ODPID              = $_POST['ODP_ID'];
$UserID             = $_POST['User_ID'];

// $IDPelanggan  = $data->ID_Pelanggan;
// $AlamatPelanggan  = $data->Alamat;
// $LayananPelanggan  = $data->Layanan;
// $PowerSignal  = $data->Power_Signal;
// $SNModem  = $data->SN_Modem;
// $ODPID  = $data->ODP_ID;
// $UserID  = $data->User_ID;

if(isset($IDPelanggan) 
	&& isset($AlamatPelanggan) 
	&& isset($LayananPelanggan) 
	&& isset($PowerSignal) 
	&& isset($SNModem) 
	&& isset($ODPID) 
	&& isset($UserID) 
	&& !empty(trim($IDPelanggan)) 
	&& !empty(trim($AlamatPelanggan))
	&& !empty(trim($LayananPelanggan))
	&& !empty(trim($PowerSignal))
	&& !empty(trim($SNModem))
	&& !empty(trim($ODPID))
	&& !empty(trim($UserID))
	&& ($LayananPelanggan != "Pilih Paket")
	){
        
    $ODPSelect = mysqli_query($db_conn,"SELECT Kapasitas, Kapasitas_After FROM `odp` WHERE `ODP_ID`='$ODPID'");
    if(mysqli_num_rows($ODPSelect) > 0){
        $row = mysqli_fetch_array($ODPSelect,MYSQLI_ASSOC);

        if ($row['Kapasitas_After'] > 0) {
            $TanggalInstalasi = date("Y-m-d H:i:s");
            $insertUser = mysqli_query($db_conn,"INSERT INTO `port`(`ID_Pelanggan`,`Alamat`,`Tanggal_Instalasi`,`Layanan`,`Power_Signal`,`SN_Modem`,`ODP_ID`,`User_ID`) 
                                                    VALUES('$IDPelanggan','$AlamatPelanggan','$TanggalInstalasi','$LayananPelanggan','$PowerSignal','$SNModem','$ODPID','$UserID')");
            $last_id = mysqli_insert_id($db_conn);

            if($insertUser){
                $TheODPCapacity = $row['Kapasitas_After'] - 1;
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
                                                            `KlasifikasiODP_ID`='$KlasifikasiODP_ID' 
                                                        WHERE `ODP_ID`='$ODPID'");

                echo json_encode(["success"=>1,"msg"=>"Data Created.","Port_ID"=>$last_id]);
            }
            else{
                echo json_encode(["success"=>0,"msg"=>"Data Not Created!"]);
            }
        }
        else{
            echo json_encode(["Success"=>0, "msg"=>"Full Port"]);
        }

    }
    else{
        echo json_encode(["success"=>0,"Message"=>"Data not Found","odp"=>$ODPID]);
    }

}else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}