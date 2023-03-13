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
        <h1 class="login-title">Login</h1>
        <lable>Email *</lable>
        <input type="text" class="login-input" id="email" name="email">
        <lable>Password *</lable>
        <input type="password" class="login-input" id="password" name="password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="registration.php">Already have an account?</a></p>
    </form>
</body>
<script>
    $(document).ready(function() {
        $('#formdata').submit(function(e) {
            e.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();
            var focusSet = false;

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

            var data = {
               email:email,password:password
            }
            $.ajax({
                type: "POST",
                url: "login1.php",
                async: false,
                data: JSON.stringify(data),
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        // alert("Data Added Successfully");
                        window.location.href = "profile.php";
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