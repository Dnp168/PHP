<?php
    include "database.php";
    
        $id = $_POST['id'];


//   echo $id;
//   die;
        $checkRecord = mysqli_query($conn,"SELECT * FROM employee WHERE recid=".$id);
        $totalrows = mysqli_num_rows($checkRecord);
        if($totalrows>0){
            $sql = "DELETE from `employee` where recid=$id";
        $conn->query($sql);
        echo 1;
        exit;
        } else{
            echo 0;
            exit;
        }
    
?>