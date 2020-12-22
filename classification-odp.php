<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$clPort = mysqli_query($db_conn,"SELECT klasifikasiodp.Klasifikasi_Nama, klasifikasiodp.KlasifikasiODP_ID, COUNT(odp.KlasifikasiODP_ID) as Jumlah
                                    FROM `klasifikasiodp`
                                    LEFT JOIN `odp` USING(KlasifikasiODP_ID)
                                    GROUP BY klasifikasiodp.KlasifikasiODP_ID");
if(mysqli_num_rows($clPort) > 0){
    $port_cl = mysqli_fetch_all($clPort,MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"port"=>$port_cl]);
}
else{
    echo json_encode(["success"=>0]);
}