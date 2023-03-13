<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="AddUser.css">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <title>PHP CRUD Operations</title>
</head>

<body>
    <center>
        <h2>Department Data</h2>
    </center>
    <div class="container">
        <div class="py-4">
            <a href="./EmployeeData.php" class="btn btn-secondary">
                <i class="bi bi-eye-fill"></i> Employee
            </a>
        </div>
        <table id='tblDept' class="table table-bordered table-striped align-middle"">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Department Name</th>
                    <th>No of Employee</th>
                    <th>Total Salary</th>
                </tr>
            </thead>
            
            <tbody>
            
                <?php
                include "database.php";
                $sql = "SELECT deptname,count(empid) as empno,sum(salary) as total from employee GROUP by deptname;";
                if ($query = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        $count = 1;
                        foreach ($rows as $row) {
                ?>
                <tr>
                <td><?= $count++; ?></td>
            <td><?= $row["deptname"]; ?></td>
            <td><?= $row["empno"]; ?></td>
            <td><?= $row["total"]; ?></td>
            <tr>
            <?php
                        }
                        mysqli_free_result($query);
                    }
                }
                mysqli_close($conn);
            ?>
</tbody>
        </table>
    </div>
</body>
<script>
            jQuery(document).ready(function($) {
              $('#tblDept').DataTable({

              });
             }); </script>

</html>