<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if(isset($data->Username) 
	&& isset($data->Password) 
	&& !empty(trim($data->Username)) 
	&& !empty(trim($data->Password))
	){
    
        $User = mysqli_real_escape_string($db_conn, trim($data->Username));
        $Pass = mysqli_real_escape_string($db_conn, trim($data->Password));

        $userLog = mysqli_query($db_conn,"SELECT * FROM `akun` WHERE `Username`='$User' and `Password`='$Pass'");
        $row = mysqli_fetch_array($userLog,MYSQLI_ASSOC);
        $last_id = mysqli_insert_id($db_conn);

        if(mysqli_num_rows($userLog) > 0){
            $pegCode = $row['Kode_Pegawai'];
            if ($pegCode == "A0001") {
                echo json_encode(["success"=>1,"msg"=>"Login Successfully","Kode_Pegawai"=>$pegCode]);
            }else if ($pegCode == "S0001") {
                echo json_encode(["success"=>1,"msg"=>"Login Successfully","Kode_Pegawai"=>$pegCode]);
            }else if ($pegCode == "F0001") {
                echo json_encode(["success"=>1,"msg"=>"Login Successfully","Kode_Pegawai"=>$pegCode]);
            }else {
                echo json_encode(["success"=>0,"msg"=>"Don't have Access"]);
            }
        }
        else{
            echo json_encode(["success"=>0,"msg"=>"Incorrect username or password"]);
        }
}else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
