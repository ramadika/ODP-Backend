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

        if(!empty($row)){
            $pegCode = $row['Kode_Pegawai'];
            $userToken = md5($pegCode);
        }
        
        if(mysqli_num_rows($userLog) > 0){
            $user = mysqli_fetch_all($userLog,MYSQLI_ASSOC);
            echo json_encode(["success"=>1,"msg"=>"Login Successfully","user"=>$row,"token"=>$userToken]);
        } else {
            $ab = mysqli_num_rows($userLog);
            echo json_encode(["success"=>0,"msg"=>"Incorrect username or password", "a"=>$ab]);
        }

}else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
