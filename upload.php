<?php

    $attachment = basename($_FILES["image"]["name"]);
    $target_dir = "image/";
    $target_file = $target_dir . $attachment;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $desc  = $_POST['desc'];

    if(isset($desc)   
        && isset($attachment) 
        && !empty(trim($desc)) 
        && !empty(trim($attachment))
        ){

        $upload = mysqli_query($db_conn,"UPDATE `odp` 
                                                SET `attachment`='$attachment'
                                                WHERE `ODP_ID`='$ODPID'");
        if($upload){
            echo json_encode(["success"=>1,"message"=>"Data Uploaded.","desc"=>$desc]);
        }
        else{
            echo json_encode(["success"=>0,"message"=>"Data Not Uploaded!"]);
        }
            
    }
    else{
        echo json_encode(["success"=>0,"message"=>"Please fill all the required fields!"]);
    }

?>