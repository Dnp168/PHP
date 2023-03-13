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
            <h1> Add Employee</h1>
        </center>

        <form method='POST' id="formdata" enctype="multipart/form-data" name="form">

            <div>
                <label> Employee ID : </label>
                <input type="text" name="empid" id="empid" placeholder="Enter Employee ID" />
            </div>
            <div>
                <label> Employee Name : </label>
                <input type="text" name="name" id="name" placeholder="Enter Employee Name" />
            </div>
            <div class="deptname">
                <label>
                    Department Name :
                </label>
                <select class="dname" id="deptname" name="deptname" onchange="newDepartment()">
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
                                <option value=<?= $row["deptname"]; ?>><?= $row["deptname"]; ?></option>
                    <?php
                            }
                            mysqli_free_result($query);
                        }
                    }
                    mysqli_close($conn);
                    ?>
                    <option >NewDepartment</option>
                </select>

            </div>
            <div id="toshow" style="display:none">
                <label>New Department</label>
                <input type="text" name="new" id="new" />
            </div>

            <div><label for="salary">Salary :</label>
                <input type="text" id="salary" placeholder="Enter salary" name="salary">
            </div>
            <button type="submit" id="submit" class="add">Add Employee</button>
        </form>
    </div>
    <!-- <button onclick="newDepartment()">new</button> -->
    <script>
        function newDepartment() {
            var n = document.form.deptname.value;
            var x = document.getElementById("toshow");
            var y = document.getElementById("deptname");
            if(n=="NewDepartment"){
                x.style.display = "block";
                y.style = "disabled";
            } else {
                x.style.display = "none";
            }  
        }
    </script>
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

            

            if (empid == "") {
                $("#empid").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Employee id</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#empid').focus();
                }
                focusSet = true;
            } else {
                $("#empid").next(".validation").remove();
            }

            if (name == "") {
                $("#name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Employee Name</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#name').focus();
                }
                focusSet = true;
            } else if (!isNaN(name)) {
                $("#name").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter Valid Name</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#name').focus();
                }
                focusSet = true;
            } else {
                $("#name").next(".validation").remove();
            }

            if (deptname == "") {
                $("#deptname").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please Select Department</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#deptname').focus();
                }
                focusSet = true;
            } else {
                $("#deptname").next(".validation").remove();
            }

            if(deptname=="NewDepartment"){
                deptname = $("#new").val();
            }

            if (salary == "") {
                $("#salary").after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please Enter Salary</div>");
                e.preventDefault();
                if (!focusSet) {
                    $('#salary').focus();
                }
                focusSet = true;
            } else {
                $("#salary").next(".validation").remove();
            }

            var data = {
                empid: empid,
                name: name,
                deptname: deptname,
                salary: salary
            }
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