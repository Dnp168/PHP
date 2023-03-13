<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: UserData.php");
        exit;
    }
    $id = $_GET['id'];
    $sql = "select * from employee where recid=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while (!$row) {
        header("location: UserData.php");
        exit;
    }
    $empid = $row["empid"];
    $name = $row["name"];
    $deptname = $row["deptname"];
    $salary = $row["salary"];
} else {
    header("location: UserData.php");
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <center>
            <h1> Update Employee</h1>
        </center>

        <form method='POST' id="formdata" enctype="multipart/form-data">
            <div>
            <label> Employee ID : </label>
            <input type="text" name="empid" id="empid" placeholder="Enter Employee ID" disabled value="<?php echo $empid; ?>"/>
            </div>
            <div>
            <label> Employee Name : </label>
            <input type="text" name="name" id="name" placeholder="Enter Employee Name" value="<?php echo $name; ?>"/>
            </div>
            <div class="deptname">
                <label>
                    Department Name :
                </label>
                <select class="dname" id="deptname" name="deptname">
                    <option value="">Select</option>
                  <?php 
                  include "database.php";
                  $sql = "SELECT * FROM department";
                  if ($query = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        $count = 1;
                        foreach ($rows as $row) {
                            $id = $row['recid'];
                  ?> 
                  <option value=<?= $row["deptname"]; ?> <?= (isset($deptname) && $deptname ==  $row["deptname"] ) ? "selected" : ""; ?>><?= $row["deptname"]; ?></option> 
                  <?php
                  }
                  mysqli_free_result($query);
              }
            }
            mysqli_close($conn);
                   ?>
                </select>
            </div>
            <div><label for="salary">Salary :</label>
            <input type="text" id="salary" placeholder="Enter salary" name="salary" value="<?php echo $salary; ?>" /></div>
            <button type="submit" id="submit" class="add">Update Employee</button>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#formdata").submit(function(e) {
            e.preventDefault();
            var empid = $("#empid").val();
            var name = $("#name").val();
            var deptname = $("#deptname").val();
            var salary = $("#salary").val();
            var focusSet = false;

            if(name==""){
                $("#name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Employee Name</div>"); 
                e.preventDefault();
                if (!focusSet) {
                    $('#name').focus();
                }
                focusSet = true;  
            }else if(!isNaN(name)){
                $("#name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Valid Name</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#name').focus();
                }
                focusSet = true;   
            }else {
                $("#name").next(".validation").remove();
            }
            
            if(deptname==""){
                $("#deptname").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please Select Department</div>"); 
                e.preventDefault();
                if (!focusSet) {
                    $('#deptname').focus();
                }
                focusSet = true;  
            }else {
                $("#deptname").next(".validation").remove();
            }

            if(salary==""){
                $("#salary").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please Enter Salary</div>"); 
                e.preventDefault();
                if (!focusSet) {
                    $('#salary').focus();
                }
                focusSet = true;  
            }else {
                $("#salary").next(".validation").remove();
            }

            var data={empid:empid, name:name, deptname:deptname, salary:salary}
            $.ajax({
                    type: "POST",
                    url: "edit.php",
                    async: false,
                    data: JSON.stringify(data),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 1) {
                            alert("Data Updated Successfully");
                            window.location.href = "EmployeeData.php";
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