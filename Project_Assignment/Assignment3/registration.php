<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style1.css" />
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <form class="form" id="formdata" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <lable>First Name *</lable>
        <input type="text" class="login-input" id="fname" name="fname" />
        <lable>Last Name </lable>
        <input type="text" class="login-input" id="lname" name="lname" />
        <lable>Contact No *</lable>
        <input type="text" class="login-input" id="mobile" name="mobile" />
        <lable>Date of Birth</lable>
        <input type="text" class="login-input" id="dob" name="dob" />
        <lable>Email *</lable>
        <input type="text" class="login-input" id="email" name="email">
        <lable>Password *</lable>
        <input type="password" class="login-input" id="password" name="password">
        <lable>Confirm Password *</lable>
        <input type="password" class="login-input" id="confirmpassword" name="confirmpassword">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Already have an account?</a></p>
    </form>
</body>
<script>
    $(document).ready(function() {
        $(function() {
            $("#dob").datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    })

    $(document).ready(function() {
        $('#formdata').submit(function(e) {
            e.preventDefault();
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var mobile = $("#mobile").val();
            var dob = $("#dob").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirmpassword = $("#confirmpassword").val();
            var focusSet = false;

            if (fname == "") {
                $("#fname").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter First Name</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#fname').focus();
                }
                focusSet = true;
            } else {
                $("#fname").next(".validation").remove();
            }

            if (mobile == "") {
                $("#mobile").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Contact No.</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#mobile').focus();
                }
                focusSet = true;
            } else if(isNaN(mobile)){
                $("#mobile").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Valid Contact No.</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#mobile').focus();
                }
                focusSet = true;
            } else {
                $("#mobile").next(".validation").remove();
            }

            if (email == "") {
                $("#email").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Email</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#email').focus();
                }
                focusSet = true;
            } else {
                $("#email").next(".validation").remove();
            }

            if (password == "") {
                $("#password").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Password</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#password').focus();
                }
                focusSet = true;
            } else {
                $("#password").next(".validation").remove();
            }

            if (confirmpassword == "") {
                $("#confirmpassword").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter confirmpassword</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#confirmpassword').focus();
                }
                focusSet = true;
            } else if(confirmpassword!=password){
                $("#confirmpassword").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Password does not match</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#confirmpassword').focus();
                }
                focusSet = true;
            } else {
                $("#confirmpassword").next(".validation").remove();
            }

            var data = {
                fname:fname,lname:lname,mobile:mobile,dob:dob,email:email,password:password
            }
            $.ajax({
                type: "POST",
                url: "insert.php",
                async: false,
                data: JSON.stringify(data),
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        // alert("Data Added Successfully");
                        window.location.href = "Login.php";
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
            
        })
    })
</script>

</html>