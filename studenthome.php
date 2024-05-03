<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); // Ensure that the script stops executing after the redirect
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
     <link rel="stylesheet" type="text/css" href="admin.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

</head>
<body>

        <header class="header">
            <a href="">Student Dashboard</a>
          
            <div class="logout">

                <a href="logout.php" class="btn btn-primary">logout</a>  
              
            </div>
        </header>   

        <asider>
             
                <ul>

                <li>
                  <a href="">My Coureses</a>
            </li>

                 <li>
                  <a href="">My result</a>
            </li>

                  

            </ul>
            </asider>
            
</body>
</html>
