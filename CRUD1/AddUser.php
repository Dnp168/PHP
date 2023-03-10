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
            <h1> Add User</h1>
        </center>

        <form method='POST' id="formdata" enctype="multipart/form-data">

            <label> Code : </label>
            <input type="text" name="code" id="code" placeholder="Code Format like : USR001" />
            <label> Firstname : </label>
            <input type="text" name="fname" id="fname" placeholder="Firstname" />

            <label> Lastname : </label>
            <input type="text" name="lname" id="lname" placeholder="Lastname" />
            <label for="email">Email :</label>
            <input type="text" id="email" placeholder="Enter Email" name="email">

            <div>
                <label>
                    Gender :
                </label>
                <input type="radio" value="Male" id="male" name="gender" checked> Male
                <input type="radio" value="Female" id="female" name="gender"> Female
                <input type="radio" value="Other" id="other" name="gender"> Other
            </div>
            <div>
                <label htmlFor="hobbies">Hobbies: </label> &nbsp;
                <input type="checkbox" class="hobbies" name="hobbies" value="Reading" />
                <label htmlFor="Reading">Reading</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies" value="Gaming" />
                <label htmlFor="Gaming">Gaming</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies" value="Coding" />
                <label htmlFor="Coding">Coding</label> &nbsp;&nbsp;
                <input type="checkbox" class="hobbies" name="hobbies" value="Drawing" />
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
                    <option value="india">India</option>
                    <option value="usa">USA</option>
                    <option value="canada">Canada</option>
                    <option value="UK">UK</option>
                    <option value="JAPAN">Japan</option>
                </select>
            </div>
            <button type="submit" id="submit" class="add">Add User</button>
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
                    async: false,
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
                    url: "insert.php",
                    async: false,
                    data: JSON.stringify(data),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            alert("Data Added Successfully");
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