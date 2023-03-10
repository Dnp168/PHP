<?php
include "./config/database.php";
$code = $fname = $lname = $email = $gender = $file = "";
$hobbies = "";

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
    $hobbies = $row["hobbies"];
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

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="View.css">
    <title>PHP CRUD Operations</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2> View User</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <img src="<?= $photo; ?>" height="150px" width="150px" border-radius="60%"><br><br>
                <label><b> Code : <?= $code; ?> </b></label><br>
                <label><b> Firstname : <?= $fname; ?> </b></label><br>
                <label><b> Lastname : <?= $lname; ?> </b></label> <br>
                <label><b>Email : <?= $email; ?></b></label><br>
                <label><b> Gender : <?= $gender; ?></b></label><br>
                <label><b>Hobbies: <?= $hobbies; ?></b></label> <br>
                <label><b> Country : <?= $country; ?> </b></label><br>
                <label><b> Status : <?= $status; ?></b> </label><br>
                <label><b> Date Added : <?= $add; ?> </b></label><br>
                <label><b> Date Updated : <?= $update; ?></b> </label><br>
                <label><b> Date Deleted : <?= $delete; ?></b> </label><br>
                <button type="submit" class="back">Cancel</button>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.back').click(function(){
            window.location.href = "UserData.php";
        })
    })
</script>
</html>