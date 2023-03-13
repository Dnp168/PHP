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
        <h2>Employee Data</h2>
    </center>
    <div class="container">
        <div class="py-4">
            <a href="./AddEmployee.php" class="btn btn-secondary">
                <i class="bi bi-plus-circle-fill"></i> Add Employee
            </a>&nbsp;
            <a href="./Department.php" class="btn btn-secondary">
                <i class="bi bi-eye-fill"></i> Department
            </a>
        </div>

        <table id='tblUser' class="table table-bordered table-striped align-middle"">
            <thead>
                <tr>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Department Name</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "database.php";
                $sql = "SELECT * FROM employee";
                if ($query = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        $count = 1;
                        foreach ($rows as $row) {
                            $id = $row['recid'];
                ?>
            <tr>
            <td><?= $row["empid"]; ?></td>
            <td><?= $row["name"]; ?></td>
            <td><?= $row["deptname"]; ?></td>
            <td><?= $row["salary"]; ?></td>
            <td>
                <a href="UpdateEmployee.php?id=<?= $row["recid"]; ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <span class='delete' data-id='<?= $id; ?>'><a href="#" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i> </a></span>
            </td>
            </tr>
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
                $('#tblUser').DataTable({
                    "order":[[1,"asc"]],
                    "pageLength": 5,
                    rowReorder: true,
                    columnDefs: [{
                            orderable: true,
                            className: 'reorder',
                            targets: [2, 1]
                        },
                        {
                            orderable: false,
                            targets: '_all'
                        },
                        {
                            searchable: true,
                            targets: [1, 2]
                        },
                        {
                            searchable: false,
                            targets: '_all'
                        }
                    ]
                });
            });

            $(document).ready(function() { 
                $('.delete').click(function() {
                    var el = this;
                    var deleteid = $(this).attr("data-id");

                    var confirmalert = confirm("Are you sure?");
                    if (confirmalert == true) {
                        $.ajax({
                            url: 'delete.php',
                            async: false,
                            type: 'POST',
                            data: {
                                id: deleteid
                            },
                            success: function(response) {
                                if (response == 1) {
                                    $(el).closest('tr').fadeOut(500, function() {
                                        $(this).remove();
                                        alert("Data Deleted Successfully");
                                    });
                                } else {
                                    alert('Invalid ID.');
                                }
                            }
                        });
                    }
                });
            });
        </script>
</html>