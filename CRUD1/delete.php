<?php
    include "./config/database.php";
    
        $id = $_POST['id'];


//   echo $id;
//   die;
        $checkRecord = mysqli_query($conn,"SELECT * FROM user WHERE recid=".$id);
        $totalrows = mysqli_num_rows($checkRecord);
        if($totalrows>0){
            $sql = "DELETE from `user` where recid=$id";
        $conn->query($sql);
        echo 1;
        exit;
        } else{
            echo 0;
            exit;
        }
    
?>