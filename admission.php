<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); 
}
$host = "localhost:3307";
$user = "root";
$password = "";
$db= "schoolproject"; 

$data= mysqli_connect($host,$user,$password,$db);

$sql= "SELECT * FROM admission";

$result= mysqli_query($data,$sql); 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
     
    <?php
        include 'admin_css.php';
    ?>

    <style>
        .content {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            margin: 0 auto; 
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50; 
            color: white; 
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; 
        }
        tr:nth-child(odd) {
            background-color: #ffffff; 
        }

        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background-color: lightgreen;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }

    </style>

</head>
<body>
        
    <?php
        include 'admin_sidebar.php';
    ?>
       
    <div class="content">
        <h1>Applied For Admission</h1>
        
          <br></br>
        <table>
            <tr>
                <th style="padding: 20px; font-size: 15px;">Name</th>
                <th style="padding: 20px; font-size: 15px;">Email</th>
                <th style="padding: 20px; font-size: 15px;">Phone</th>
                <th style="padding: 20px; font-size: 15px;">Message</th>
            </tr>

            <?php
                while($info = $result->fetch_assoc())
                {
            ?>

            <tr>
                <td style="padding: 20px;"><?php echo "{$info['name']}"; ?></td>
                <td style="padding: 20px;"><?php echo "{$info['email']}"; ?></td>
                <td style="padding: 20px;"><?php echo "{$info['phone']}"; ?></td>
                <td style="padding: 20px;"><?php echo "{$info['message']}"; ?></td>
            </tr>

            <?php
                }
            ?>
        </table>
    </div>
    
</body>
</html>
