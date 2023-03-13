<?php
    include "db.php";
    $data=stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $email = $mydata['email'];
    $password = $mydata['password'];

    if(!empty($email)){
        $sql="select * from assignment3 where email='$email' and password='$password'";
        if($conn->query($sql)==true){
            echo 1;
        }
    }
    
?>