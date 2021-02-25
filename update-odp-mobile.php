<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$ODPID  = $_POST['ODP_ID'];
$ODPName    = $_POST['ODP_Name'];
$ODCName   = $_POST['ODC_Name'];
$COName   = $_POST['CO_Name'];
$PowerSignal = $_POST['Power_Signal'];
$Lat    = $_POST['Latitude'];
$Long   = $_POST['Longitude'];
$Kaps   = $_POST['Kapasitas'];
$UserID = $_POST['User_ID'];

// $ODPID  = $data->ODP_ID;
// $ODPName  = $data->ODP_Name;
// $ODCName  = $data->ODC_Name;
// $COName  = $data->CO_Name;
// $PowerSignal  = $data->Power_Signal;
// $Lat  = $data->Latitude;
// $Long  = $data->Longitude;
// $Kaps  = $data->Kapasitas;
// $UserID  = $data->User_ID;

if(isset($ODPID) 
    && isset($ODPName) 
    && isset($ODCName)   
    && isset($COName)    
    && isset($PowerSignal) 
	&& isset($Lat) 
	&& isset($Long)   
	&& isset($Kaps)    
	&& isset($UserID)    
	&& !empty(trim($ODPID)) 
	&& !empty(trim($ODPName))
	&& !empty(trim($ODCName))
	&& !empty(trim($COName))
	&& !empty(trim($PowerSignal))
	&& !empty(trim($Lat))
	&& !empty(trim($Long))
	&& !empty(trim($Kaps))
	&& !empty(trim($UserID))
	){
        
    $ODPSelect = mysqli_query($db_conn,"SELECT Kapasitas, Kapasitas_After FROM `odp` WHERE `ODP_ID`='$ODPID'");
    $row = mysqli_fetch_array($ODPSelect,MYSQLI_ASSOC);
    $usedKaps = $row['Kapasitas'] - $row['Kapasitas_After'];
    $oldKaps = (is_string($_POST['Kapasitas']) ? (int)$_POST['Kapasitas'] : 0);
    $currKaps = $oldKaps - $usedKaps;

    $GISHref = 'https://www.google.com/maps/?q='.$Lat.','.$Long;
    $TanggalInstalasi = date("Y-m-d H:i:s");
    
    if($Kaps == 8){
        if ($currKaps == 0){
            $KlasifikasiODP_ID = 1;
        } else if ($currKaps >= 1 && $currKaps <= 4){
            $KlasifikasiODP_ID = 2;
        } else if ($currKaps >= 5 && $currKaps <= 7){
            $KlasifikasiODP_ID = 3;
        } else if ($currKaps == 8){
            $KlasifikasiODP_ID = 4;
        }
    } else if ($Kaps == 16){
        if ($currKaps == 0){
            $KlasifikasiODP_ID = 1;
        } else if ($currKaps >= 1 && $currKaps <= 4){
            $KlasifikasiODP_ID = 2;
        } else if ($currKaps >= 9 && $currKaps <= 15){
            $KlasifikasiODP_ID = 3;
        } else if ($currKaps == 16){
            $KlasifikasiODP_ID = 4;
        }
    }

    $updateUser = mysqli_query($db_conn,"UPDATE `odp` 
                                            SET `GIS_href`='$GISHref', 
                                            `ODP_Name`='$ODPName', 
                                            `ODC_Name`='$ODCName', 
                                            `CO_Name`='$COName', 
                                            `Power_Signal`='$PowerSignal',
                                            `Latitude`='$Lat', 
                                            `Longitude`='$Long', 
                                            `Tanggal_Instalasi`='$TanggalInstalasi', 
                                            `Kapasitas`='$Kaps',
                                            `Kapasitas_After`='$currKaps',
                                            `KlasifikasiODP_ID`='$KlasifikasiODP_ID',
                                            `User_ID`='$UserID' 
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