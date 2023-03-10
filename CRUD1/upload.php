<?php
if (isset($_FILES["file"]["name"])) {
   if ($_FILES["file"]["name"] != '') {

      $filename = $_FILES["file"]["name"];
      $target_file = "/xampp/htdocs/PHP/CRUD1/images/" . $filename;
      // $target_file1 = "/PHP/CRUD1/images/" . $filename;

      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
         echo 1;
         exit;
      } else {
         echo 0;
         exit;
      }
   }
}
    ?>
