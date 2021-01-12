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

    $insertUser = mysqli_query($db_conn,"INSERT INTO `port`(`ID_Pelanggan`,`Alamat`,`Tanggal_Instalasi`,`Layanan`,`ODP_ID`) 
                                            VALUES('$IDPelanggan','$AlamatPelanggan','$TanggalInstalasi','$LayananPelanggan','$ODPID')");
    if($insertUser){
        $last_id = mysqli_insert_id($db_conn);
        echo json_encode(["success"=>1,"msg"=>"Data Created.","Port_ID"=>$last_id]);
        // echo json_encode($insertUser);
    }
    else{
        echo json_encode(["success"=>0,"msg"=>"Data Not Created!"]);
    }

}else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}