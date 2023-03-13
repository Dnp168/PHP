<?php
    include_once "database.php";
    $data=stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $empid =  $mydata['empid'];
    $name = $mydata['name'];
    $deptname = $mydata['deptname'];
    $salary = $mydata['salary'];

    if(!empty($empid)){
        $sql="UPDATE employee SET name='$name',deptname='$deptname',salary='$salary' where empid='$empid'";
        if($conn->query($sql)==true){
            echo 1;
        }
    }
?>