<?php
    include "./config/connection.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from `user` where recid=$id";
        $conn->query($sql);
    }
    header('location: UserData.php');
    exit;
?>