

<html>
   <head>
    <title>Form Data</title>
   </head> 
   <body>
    <?php
    session_start();
    
        echo "<h3 color = #FF0001> <b>You have sucessfully registered.</b> </h3>";  
        echo "<h2>Your Input:</h2>";  
        echo "Name: " .$_SESSION['name'];  
        echo "<br>";  
        echo "Email: " .$_SESSION['email'];  
        echo "<br>";  
        echo "Mobile No: " .$_SESSION['mobileno'];  
        echo "<br>";  
        echo "Website: " .$_SESSION['website'];  
        echo "<br>";  
        echo "Gender: " .$_SESSION['gender'];
        session_unset();
        session_destroy();
     ?>
   </body>
</html>