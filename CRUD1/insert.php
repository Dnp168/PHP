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
        $sql="Insert into user(code,fname,lname,email,gender,hobbies,photo,country,status,dateadded) values('$code','$fname','$lname','$email','$gender','$hobbies','$target_file1','$country','Active','$date')";
        if($conn->query($sql)==true){
            echo 1;
        }
    }
    
//     $result = mysqli_query($conn,"Insert into user(code,fname,lname,email,gender,hobbies,photo,country,status,dateadded) 
//     values('" . $code . "','" . $fname . "','" . $lname . "','" . $email . "','" . $gender . "','" . $hobbies . "','" . $target_file. "','" . $country . "','Active','$date')");

//   if($result){
//       echo 1;
//       exit;
//   }else{
//       echo 0;
//       exit;
//   }
    
   // rename('downloads/$filename')
   
    //  header('Location: UserData.php')
     

    // if(mysqli_query($conn, "INSERT INTO customers(name, email, message) VALUES('" . $name . "', '" . $email . "', '" . $message . "')")) {
    //  echo '1';
    // } else {
    //    echo "Error: " . $sql . "" . mysqli_error($conn);
    // }
 
    // mysqli_close($conn);
 
?>