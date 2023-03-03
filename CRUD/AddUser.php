<?php
include "./config/connection.php";
$code = $fname = $lname = $email = $gender = $file = "";
$hobbies = "";
$welcome="";
$target_file1="";
$codeErr = $fnameErr = $lnameErr = $emailErr = $hobbiesErr = $genderErr = $countryErr = "";
$target_dir = "/xampp/htdocs/PHP/images/";

$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Code validation
    if (empty($_POST["code"])) {
        $codeErr = "Please enter your code ";
    } else {
        $code = input_data($_POST["code"]);
        if (!preg_match("/^[U][S][R]([0-9]{3})*$/", $code)) {
            $codeErr = "Please enter a valid code ";
        }
    }

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

    //Empty Field Validation  
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = input_data($_POST["gender"]);
    }

    //Checkbox Validation  
    if (!isset($_POST['hobbies'])) {
        $hobbiesErr = "You must select hobbies";
    } else {
        $hobbies =$_POST['hobbies'];
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
       
      } else {
        // Move File Into our Folder
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        //   echo "File is valid, and was successfully uploaded.\n";
        } 
        else {
          echo "Possible file upload attack!\n";
        }
      }
   
    //Country Selection validation
    if (empty($_POST['country'])) {
        $countryErr = "You must select a Country";
    } else {
        $country = input_data($_POST['country']);
    }

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $new = implode(" ",$hobbies);
    $target_file1 = "/PHP/images/" . basename($_FILES["file"]["name"]);
        // $q = " INSERT INTO `user`(`code`,`fname`,`lname`,`email`) VALUES ( '$code', '$fname', '$lname','$email')";
        $q = " INSERT INTO `user`(`code`,`fname`,`lname`,`email`,`gender`,`hobbies`,`photo`,`country`,`status`,`dateadded`) VALUES ( '$code', '$fname', '$lname','$email','$gender','$new','$target_file1','$country','Active','$date')";
        $query = mysqli_query($conn,$q);    
}

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="AddUser.css">
</head>

<body>
    <div class="container">
        <center>
            <h1> Add User</h1>
        </center>
        <?php echo $welcome; ?>
        <form method="POST" action="" enctype="multipart/form-data">

            <label> Code : </label><span class="error"><?php echo $codeErr; ?></span>
            <input type="text" name="code" placeholder="Code" value="<?php echo $code; ?>" />&nbsp;
            <label> Firstname : </label><span class="error"><?php echo $fnameErr; ?></span>
            <input type="text" name="fname" placeholder="Firstname" value="<?php echo $fname; ?>" />
            
            <label> Lastname : </label> <span class="error"><?php echo $lnameErr; ?></span>
            <input type="text" name="lname" placeholder="Lastname" value="<?php echo $lname; ?>" />
           
            <label for="email">Email :</label><span class="error"><?php echo $emailErr; ?></span>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
            

            <div>
                <label>
                    Gender :
                </label>
                <input type="radio" value="Male" name="gender" <?= (isset($gender) && $gender == "Male") ? "checked" : ""; ?>> Male
                <input type="radio" value="Female" name="gender" <?= (isset($gender) && $gender == "Female") ? "checked" : ""; ?>> Female
                <input type="radio" value="Other" name="gender" <?= (isset($gender) && $gender == "Other") ? "checked" : ""; ?>> Other
                <span class="error"><?php echo $genderErr; ?></span>
            </div>
            <div>
                <label htmlFor="hobbies">Hobbies: </label> &nbsp;
                <input id="Reading" type="checkbox" name="hobbies[]" <?php if (isset($_POST['submit']) && isset($_POST['hobbies'][0])) echo "checked" ?> value="Reading" />
                <label htmlFor="Reading">Reading</label> &nbsp;&nbsp;
                <input id="Gaming" type="checkbox" name="hobbies[]" value="Gaming" <?php if (isset($_POST['submit']) && isset($_POST['hobbies'][1])) echo "checked" ?> />
                <label htmlFor="Gaming">Gaming</label> &nbsp;&nbsp;
                <input id="Coding" type="checkbox" name="hobbies[]" value="Coding" <?php if (isset($_POST['submit']) && isset($_POST['hobbies'][2])) echo "checked" ?> />
                <label htmlFor="Coding">Coding</label> &nbsp;&nbsp;
                <input id="Drawing" type="checkbox" name="hobbies[]" value="Drawing" <?php if (isset($_POST['submit']) && isset($_POST['hobbies'][3])) echo "checked" ?> />
                <label htmlFor="Drawing">Drawing</label>
                <span class="error"><?php echo $hobbiesErr; ?></span>
            </div>
            <div>
                <label htmlFor="photo">Select Image :</label>
                <input type="file" name="file" accept='image/*' />
            </div>
            <div>
                <label>
                    Country :
                </label>
                <select name="country">
                    <option value="india" <?= (isset($country) && $country == "india") ? "selected" : ""; ?>>India</option>
                    <option value="usa" <?= (isset($country) && $country == "usa") ? "selected" : ""; ?>>USA</option>
                    <option value="canada" <?= (isset($country) && $country == "canada") ? "selected" : ""; ?>>Canada</option>
                    <option value="UK" <?= (isset($country) && $country == "UK") ? "selected" : ""; ?>>UK</option>
                    <option value="JAPAN" <?= (isset($country) && $country == "JAPAN") ? "selected" : ""; ?>>Japan</option>
                </select>
                <span class="error"><?php echo $countryErr; ?></span>
            </div>
            <button type="submit" class="add">Add User</button>
        </form>
    </div>
</body>

</html>