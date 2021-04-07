<?php

$attachment = basename($_FILES["image"]["name"]);
$target_dir = "image/";
$target_file = $target_dir . $attachment;
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$desc  = $_POST['desc'];

if(isset($desc)   
	&& !empty(trim($desc)) 
	){
        
    echo json_encode(["success"=>1,"message"=>"Data Updated.","desc"=>$desc]);
}
else{
    echo json_encode(["success"=>0,"message"=>"Please fill all the required fields!"]);
}

?>