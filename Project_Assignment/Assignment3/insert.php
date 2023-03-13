<?php
    include "db.php";
    $data=stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $fname =  $mydata['fname'];
    $lname = $mydata['lname'];
    $mobile = $mydata['mobile'];
    $dob = $mydata['dob'];
    $newDate = date("Y-m-d", strtotime($dob));
    $email = $mydata['email'];
    $password = $mydata['password'];
    date_default_timezone_set('Asia/Kolkata');    
    $date = date('Y-m-d H:i:s');

    if(!empty($fname)){
        $sql="Insert into assignment3(fname,lname,mobile,dob,email,password,dateadd) values('$fname','$lname','$mobile','$newDate','$email','$password','$date')";
        if($conn->query($sql)==true){
            echo 1;
        }
    }
    
?>