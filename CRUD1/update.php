<?php
    include_once "./config/database.php";
    $data=stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $code =  $mydata['code'];
    $fname = $mydata['fname'];
    $lname = $mydata['lname'];
    $email = $mydata['email'];
    $gender = $mydata['gender'];
    $hobbies = $mydata['hobbies'];
    $filename = $mydata['filename'];
    // $tmpname = $_POST['tmpname'];
    $country = $mydata['country'];
    date_default_timezone_set('Asia/Kolkata');    
    $date = date('Y-m-d H:i:s');
    $target_file1 = "/PHP/CRUD1/images/" . $filename;

    if(!empty($code)){
        $sql="UPDATE user SET fname='$fname',lname='$lname',email='$email',gender='$gender',hobbies='$hobbies',photo='$target_file1',country='$country',status='Active',dateupdated='$date' where code='$code'";
        if($conn->query($sql)==true){
            echo 1;
        }
    }

?>