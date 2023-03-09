<?php
include "./config/connection.php";
$code = $fname = $lname = $email = $gender = $file = $id="";
// $hobbies=[];
$welcome="";
$target_file1="";
$codeErr = $fnameErr = $lnameErr = $emailErr = $hobbiesErr = $genderErr = $countryErr = "";
$target_dir = "/xampp/htdocs/PHP/images/";

$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Firstname Validation
    if (empty($_POST["fname"])) {
        $fnameErr = "Please enter your first name";
    } else {
        $fname = input_data($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $fnameErr = "Please enter a valid name";
        }
    }

    // last name validation
    if (empty($_POST["lname"])) {
        $lnameErr = "Please enter your last name";
    } else {
        $lname = input_data($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "Please enter a valid name";
        }
    }

    //Email Validation   
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email=input_data($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

   // Empty Field Validation  
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = input_data($_POST["gender"]);
    }

    // Checkbox Validation  
    // if (!isset($_POST['hobbies'])) {
    //     $hobbiesErr = "You must select hobbies";
    // } else {
    //     $hobbies =$_POST['hobbies'];
    // }

    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif" ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
       
    //   } else {
    //     // Move File Into our Folder
    
    //     if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
    //     //   echo "File is valid, and was successfully uploaded.\n";
    //     } 
    //     else {
    //       echo "Possible file upload attack!\n";
    //     }
    //   }
   
    //Country Selection validation
    // if (!isset($_POST['country'])) {
    //     $countryErr = "You must select a Country";
    // } else {
    //     $country = input_data($_POST['country']);
    // }


    // date_default_timezone_set('Asia/Kolkata');
    // $date = date('Y-m-d H:i:s');
    // // $new = implode(" ",$hobbies);
    // $target_file1 = "/PHP/images/" . basename($_FILES["file"]["name"]);
    //     // $q = " INSERT INTO `user`(`code`,`fname`,`lname`,`email`) VALUES ( '$code', '$fname', '$lname','$email')";
    //     $q = "UPDATE `user` SET `fname`='$fname', `lname`='$lname',`email`='$email',`gender`='$gender',`photo`='$target_file1',`country`='$country',`dateupdated`='$date' where `recid`='$id' ";
    //     // $q = "UPDATE `user` SET `fname`='$fname', `lname`='$lname',`email`='$email' where `recid`='$id' ";

    //     $query = mysqli_query($conn,$q); 
        // header("location: UserData.php");   
        $emailErr="welcome";
} else {
    if (!isset($_GET['id'])) {
        header("location: UserData.php");
        exit;
    }
    $id = $_GET['id'];
    $sql = "select * from user where recid=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while (!$row) {
        header("location: UserData.php");
        exit;
    }
    $code = $row["code"];
    $email = $row["email"];
    $fname = $row["fname"];
    $lname = $row["lname"];
    $gender = $row["gender"];
    $hobbies = explode(' ',$row["hobbies"]);
    $photo = $row["photo"];
    $country = $row["country"];
    $add = $row["dateadded"];
    $update = $row["dateupdated"];
    $delete = $row["endeffdt"];
    $status = $row["status"];
}
    function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// if ($_SERVER["REQUEST_METHOD"] == 'GET') {
//     if (!isset($_GET['id'])) {
//         header("location: UserData.php");
//         exit;
//     }
//     $id = $_GET['id'];
//     $sql = "select * from user where recid=$id";
//     $result = $conn->query($sql);
//     $row = $result->fetch_assoc();
//     while (!$row) {
//         header("location: UserData.php");
//         exit;
//     }
//     $code = $row["code"];
//     $email = $row["email"];
//     $fname = $row["fname"];
//     $lname = $row["lname"];
//     $gender = $row["gender"];
//     $hobbies = explode(' ',$row["hobbies"]);
//     $photo = $row["photo"];
//     $country = $row["country"];
//     $add = $row["dateadded"];
//     $update = $row["dateupdated"];
//     $delete = $row["endeffdt"];
//     $status = $row["status"];
// } 
