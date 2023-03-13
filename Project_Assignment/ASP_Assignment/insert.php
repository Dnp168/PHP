<?php
    include_once "database.php";
    $data=stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $empid =  $mydata['empid'];
    $name = $mydata['name'];
    $deptname = $mydata['deptname'];
    $salary = $mydata['salary'];

    if(!empty($deptname)){
        $checkRecord = mysqli_query($conn,"SELECT * FROM department WHERE deptname='$deptname'");
        // $sql = "Select * from department where deptname='$deptname'";
        $totalrows = mysqli_num_rows($checkRecord);
        if($totalrows==0){
            $sql = "Insert into department(deptname) values('$deptname')";
        $conn->query($sql);
        }
    }

    if(!empty($empid)){
        $sql="Insert into employee(empid,name,deptname,salary) values('$empid','$name','$deptname','$salary')";
        if($conn->query($sql)==true){
            echo 1;
        }
    }
    
?>