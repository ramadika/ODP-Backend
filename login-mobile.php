<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

$User  = $_POST['Username'];
$Pass  = $_POST['Password'];

// $User  = $data->Username;
// $Pass  = $data->Password;

if(isset($User) 
	&& isset($Pass) 
	&& !empty(trim($User)) 
	&& !empty(trim($Pass))
	){
        $Pass = md5($Pass);
        
        $userLog = mysqli_query($db_conn,"SELECT * FROM `akun` WHERE `Username`='$User' and `Password`='$Pass'");
        $row = mysqli_fetch_array($userLog,MYSQLI_ASSOC);

        if(mysqli_num_rows($userLog) > 0){

            // if ($row['Kode_Pegawai'] == "F0001") {
            //     $idUser = $row['User_ID'];
            //     $userToken = md5($idUser);
            //     echo json_encode(["success"=>1,"msg"=>"Login Successfully","User_ID"=>$userToken]);
            // }
            // else {
            //     echo json_encode(["success"=>0,"msg"=>"Don't have Access"]);
            // }

            $verifikasi = $row['verifikasi'];
            if ($verifikasi == "1" || $verifikasi == '1' || $verifikasi == 1) {
                $idUser = $row['User_ID'];
                $userToken = md5($idUser);
                echo json_encode(["success"=>1,"msg"=>"Login Successfully","User_ID"=>$userToken,"verifikasi"=>$verifikasi]);
            } 
            else if ($verifikasi == "2" || $verifikasi == '2' || $verifikasi == 2) {
                echo json_encode(["success"=>0,"msg"=>"Don't have Access","verifikasi"=>$verifikasi]);
            }
            else {
                echo json_encode(["success"=>0,"msg"=>"Don't have Access","verifikasi"=>$verifikasi]);
            }

        }
        else{
            echo json_encode(["success"=>0,"msg"=>"Incorrect username or password","verifikasi"=>"3"]);
        }
}
else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
