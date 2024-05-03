<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); // Stop script execution and redirect
    
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
            <a href="">Admin Dashboard</a>
          
            <div class="logout">

                <a href="logout.php" class="btn btn-primary">logout</a>  
              
            </div>
        </header>   

        <asider>
             
                <ul>

                <li>
                  <a href="">Admission</a>
            </li>

                 <li>
                  <a href="">Add Student</a>
            </li>

                  <li>
                  <a href="">View Student</a>
            </li>

                  <li>
                  <a href="">Add Teacher</a>
            </li>
                   <li>
                  <a href="">View Teacher</a>
            </li>
              
            <li>
                  <a href="">Add Courses</a>
            </li>

                  <li>
                  <a href="">View Courses</a>
            </li>

            </ul>
            </asider>
          
        <div class="content">

            <h1>Sidebar According</h1>

            <p>A sidebar is a brief, self-contained section of text that appears alongside the main content of a webpage, article, or book. It's typically enclosed in a box or visually separated to stand out. Sidebars use short paragraphs, often just one or two sentences, to provide supplemental information, interesting facts, or  further explanations related to the main topic.

               </p>

               <input type="text" name="">
            </div>
    
</body>
</html>
