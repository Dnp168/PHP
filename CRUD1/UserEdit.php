<?php
include "./config/database.php";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
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
    $hobbies = explode(',',$row["hobbies"]);
    $photo = $row["photo"];
    $country = $row["country"];
    $add = $row["dateadded"];
    $update = $row["dateupdated"];
    $delete = $row["endeffdt"];
    $status = $row["status"];
} else {
    header("location: UserData.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="AddUser.css">
</head>

<body>
    <div class="container">
        <center>
            <h1> Update User</h1>
        </center>

        <form method='POST' id="formdata" enctype="multipart/form-data">

            <label> Code : </label>
            <input type="text" name="code" id="code" placeholder="Code Format like : USR001" disabled value="<?php echo $code; ?>"/>
            <label> Firstname : </label>
            <input type="text" name="fname" id="fname" placeholder="Firstname" value="<?php echo $fname; ?>" />

            <label> Lastname : </label>
            <input type="text" name="lname" id="lname" placeholder="Lastname" value="<?php echo $lname; ?>"/>
            <label for="email">Email :</label>
            <input type="text" id="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">

            <div>
                <label>
                    Gender :
                </label>
                <input type="radio" value="Male" id="male" name="gender" <?= (isset($gender) && $gender == "Male") ? "checked" : ""; ?>> Male
                <input type="radio" value="Female" id="female" name="gender" <?= (isset($gender) && $gender == "Female") ? "checked" : ""; ?>> Female
                <input type="radio" value="Other" id="other" name="gender" <?= (isset($gender) && $gender == "Other") ? "checked" : ""; ?>> Other
            </div>
            <div>
                <label htmlFor="hobbies">Hobbies: </label> &nbsp;
                <input type="checkbox" class="hobbies" name="hobbies[]" value="Reading" <?= (isset($hobbies) && in_array("Reading", $hobbies)) ? 'checked="checked"' : ""; ?>/>
                <label htmlFor="Reading">Reading</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies[]" value="Gaming" <?= (isset($hobbies) && in_array("Gaming", $hobbies)) ? 'checked="checked"' : ""; ?>/>
                <label htmlFor="Gaming">Gaming</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies[]" value="Coding" <?= (isset($hobbies) && in_array("Coding", $hobbies)) ? 'checked="checked"' : ""; ?>/>
                <label htmlFor="Coding">Coding</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies[]" value="Drawing" <?= (isset($hobbies) && in_array("Drawing", $hobbies)) ? 'checked="checked"' : ""; ?>/>
                <label htmlFor="Drawing">Drawing</label>
            </div>
            <div>
                <label htmlFor="photo">Select Image :</label>
                <input type="file" id="file" name="file" />
            </div>
            <div>
                <label>
                    Country :
                </label>
                <select id="country" name="country">
                    <option value="">Select</option>
                    <option value="india" <?= (isset($country) && $country == "india") ? "selected" : ""; ?>>India</option>
                    <option value="usa" <?= (isset($country) && $country == "usa") ? "selected" : ""; ?>>USA</option>
                    <option value="canada" <?= (isset($country) && $country == "canada") ? "selected" : ""; ?>>Canada</option>
                    <option value="UK" <?= (isset($country) && $country == "UK") ? "selected" : ""; ?>>UK</option>
                    <option value="JAPAN" <?= (isset($country) && $country == "JAPAN") ? "selected" : ""; ?>>Japan</option>
                </select>
            </div>
            <button type="submit" id="submit" class="add">Update User</button>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#formdata").submit(function(e) {
            e.preventDefault();

            var code = $("#code").val();
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var email = $("#email").val();
            var gender = $('input[name="gender"]:checked').val();
            var country = $("#country").val();
            var filename = $('input[type=file]').val().replace(/.*(\/|\\)/, '');
            var pattern = new RegExp(/[A-Za-z]{3}[0-9]{3}/);
            var validate = new RegExp(/\S+@\S+\.\S+/);
            var pattern1 = new RegExp(/\.(gif|jpe?g|tiff?|png|webp|bmp|jfif)$/i);

            if (code == "") {
                console.log(code);
                alert("code is required");
            } else if (!pattern.test(code)) {
                alert("Enter valid code");
            } else if (fname == "") {
                alert("Enter First name");
            } else if (lname == "") {
                alert("Enter Last name");
            } else if (email == "") {
                alert("Enter the email address");
            } else if (!validate.test(email)) {
                alert("Enter valid email address");
            } else if ($('input[type=radio]:checked').length == 0) {
                alert("Please select your gender")
            } else if ($('input[type=checkbox]:checked').length == 0) {
                alert("Please select your hobbies")
            } else if (filename == "") {
                alert("Please select a Image");
            } else if (!pattern1.test(filename)) {
                alert("Please upload a valid image file");
            } else if (country == "") {
                alert("Please select the country");
            } else {
                var hobbies = [];
                $('.hobbies').each(function() {
                    if ($(this).is(":checked")) {
                        hobbies.push($(this).val());
                    }
                });
                hobbies = hobbies.toString();
                var data = {code:code, fname:fname, lname:lname, email:email, gender:gender, hobbies:hobbies, country:country, filename:filename};
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "upload.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            console.log(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

                console.log(data);
                $.ajax({
                    type: "POST",
                    url: "update.php",
                    data: JSON.stringify(data),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            alert("Data Updated Successfully");
                            // header('Location: UserData.php');
                            window.location.href = "UserData.php";
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

                

            }
        })
    })
</script>

</html>