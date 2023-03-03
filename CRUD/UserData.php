<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="AddUser.css">
        <title>PHP CRUD Operations</title>
      </head>
    <body>
        <center><h2>User Data</h2></center>
        <div class="container">
            <div class="py-4">
              <a href="./AddUser.php" class="btn btn-secondary">
                <i class="bi bi-plus-circle-fill"></i> Add Employee
              </a>
            </div>
        
        <table class="table table-bordered table-striped align-middle"">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                    <th>Date_Added</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
        
        include "./config/connection.php";

        $sql = "SELECT * FROM user";

        if ($query = mysqli_query($conn,$sql)) {
          if (mysqli_num_rows($query) > 0) {
            $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $count = 1;
            foreach ($rows as $row) { ?>
            <tr>
              <td><?= $count++; ?></td>
              <td><img src="<?= $row["photo"] ?>" height="60px" width="60px" border-radius="60%"></td>
              <td><?= $row["code"]; ?></td>
              <td><?= $row["fname"]." ".$row["lname"]; ?></td>
              <td><?= $row["email"]; ?></td>
              <td><?= $row["gender"]; ?></td>
              <td><?= $row["hobbies"]; ?></td>
              <td><?= $row["dateadded"]; ?></td>
              <td><?= $row["status"]; ?></td>
              <td>
              <a href="view.php?id=<?= $row["recid"]; ?>" class="btn btn-primary btn-sm">
              <i class="bi bi-eye-fill"></i>
                  </a>&nbsp;&nbsp;
                  <a href="EditUser.php?id=<?= $row["recid"]; ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square"></i>
                  </a>&nbsp;&nbsp;
                  <a href="delete.php?id=<?= $row["recid"]; ?>" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash-fill"></i>
                  </a>
              </td>
            </tr>
            <?php
            }
           
            mysqli_free_result($query);
          } else { ?>
            <tr>
              <td class="text-center text-danger fw-bold" colspan="9">** No records were found **</td>
            </tr>
        <?php
          }
        }
        # Close connection
        mysqli_close($conn);
        ?>
            </tbody>
      </div>
    </body>
</html>