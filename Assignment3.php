<html>

<head>
    <title>Candidate Registration Form</title>
</head>

<body>

    <?php
    session_start();
    // define variables to empty values  
    $nameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr = $agreeErr = "";
    $name = $email = $mobileno = $gender = $website = $agree = "";

    //Input fields validation  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation  
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = input_data($_POST["name"]);
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only alphabets and white space are allowed";
            }
        }

        //Email Validation   
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = input_data($_POST["email"]);
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        //Number Validation  
        if (empty($_POST["mobileno"])) {
            $mobilenoErr = "Mobile no is required";
        } else {
            $mobileno = input_data($_POST["mobileno"]);
            // check if mobile no is well-formed  
            if (!preg_match("/^[0-9]*$/", $mobileno)) {
                $mobilenoErr = "Only numeric value is allowed.";
            }
            //check mobile no length should not be less and greator than 10  
            if (strlen($mobileno) != 10) {
                $mobilenoErr = "Mobile no must contain 10 digits.";
            }
        }

        //URL Validation      
        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = input_data($_POST["website"]);
            // check if URL address syntax is valid  
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteErr = "Invalid URL";   
            }
        }

        //Empty Field Validation  
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
            
        } else {
            $gender = input_data($_POST["gender"]);
        }

        //Checkbox Validation  
        if (!isset($_POST['agree'])) {
            $agreeErr = "Accept terms of services before submit.";
           
        } else {
            $agree = input_data($_POST["agree"]);
            $_SESSION['name'] = $_POST["name"];
            $_SESSION['email'] = $_POST["email"];
            $_SESSION['gender'] = $_POST["gender"];
            $_SESSION['mobileno'] = $_POST["mobileno"];
            $_SESSION['website'] = $_POST["website"];
            header("Location: welcome.php");
        }
       
    }
    function input_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>Registration Form</h2>
    <form  method="POST" >
        Name:
        <input type="text" name="name">
        <span class="error">*
            <?php echo $nameErr; ?>
        </span>
        <br><br>
        E-mail:
        <input type="text" name="email">
        <span class="error">*
            <?php echo $emailErr; ?>
        </span>
        <br><br>
        Mobile No:
        <input type="text" name="mobileno">
        <span class="error">*
            <?php echo $mobilenoErr; ?>
        </span>
        <br><br>
        Website:
        <input type="text" name="website">
        <span class="error">
            <?php echo $websiteErr; ?>
        </span>
        <br><br>
        Gender:
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other
        <span class="error">*
            <?php echo $genderErr; ?>
        </span>
        <br><br>
        Agree to Terms of Service:
        <input type="checkbox" name="agree">
        <span class="error">*
            <?php echo $agreeErr; ?>
        </span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <br><br>
    </form>
</body>

</html>