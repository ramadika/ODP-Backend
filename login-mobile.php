<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$User  = $_POST['Username'];
$Pass  = $_POST['Password'];

if(isset($User) 
	&& isset($Pass) 
	&& !empty(trim($User)) 
	&& !empty(trim($Pass))
	){
        
        $userLog = mysqli_query($db_conn,"SELECT * FROM `akun` WHERE `Username`='$User' and `Password`='$Pass'");
        $row = mysqli_fetch_array($userLog,MYSQLI_ASSOC);
        $last_id = mysqli_insert_id($db_conn);

        if(mysqli_num_rows($userLog) > 0){

            if ($row['Kode_Pegawai'] == "F0001") {
                echo json_encode(["success"=>1,"msg"=>"Login Successfully","User_ID"=>$last_id]);
            }
            else {
                echo json_encode(["success"=>0,"msg"=>"Don't have Access"]);
            }

        }
        else{
            echo json_encode(["success"=>0,"msg"=>"Incorrect username or password"]);
        }
}
else{
    echo json_encode(["success"=>0,"msg"=>"Please fill all the required fields!"]);
}
