

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="AddUser.css">
</head>

<body>
    <div class="container">
       
        <?php echo $welcome; ?>
        <form method="POST" action="" enctype="multipart/form-data">

            <label> Code : </label><span class="error"><?php echo $codeErr; ?></span>
            <input type="text" name="code" placeholder="Code" value="<?php echo $code; ?>" disabled/>&nbsp;
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
                <input id="Reading" type="checkbox" name="hobbies[]"  <?= (isset($hobbies) && in_array("Reading", $hobbies)) ? "checked" : "unchecked"; ?> value="Reading" />
                <label htmlFor="Reading">Reading</label> &nbsp;&nbsp;
                <input id="Gaming" type="checkbox" value="Gaming" name="hobbies[]" <?= (isset($hobbies) && in_array("Gaming", $hobbies)) ? "checked" : ""; ?> />
                <label htmlFor="Gaming">Gaming</label> &nbsp;&nbsp;
                <input id="Coding" type="checkbox"  value="Coding" name="hobbies[]" <?= (isset($hobbies) && in_array("Coding", $hobbies)) ? "checked" : ""; ?> />
                <label htmlFor="Coding">Coding</label> &nbsp;&nbsp;
                <input id="Drawing" type="checkbox" n value="Drawing" name="hobbies[]" <?= (isset($hobbies) && in_array("Drawing", $hobbies)) ? "checked" : ""; ?> />
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
            <button type="submit" class="add">Update User</button>
           
        </form>
    </div>
</body>

</html>