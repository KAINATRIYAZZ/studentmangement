<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); 
}

$host = "localhost:3307";
$user = "root";
$password = "";
$db = "schoolproject"; 

$data = mysqli_connect($host, $user, $password, $db);

$sql = "SELECT * FROM course";
$result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Courses</title>
     
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
            background-color: lightgreen;
            width: 70%; 
                }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
        }
        .action-buttons a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            text-align: center;
        }
        .action-buttons a.delete {
            background-color: #f44336;
        }
    </style>

</head>
<body>
        
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <h1>View Courses</h1>
        
        <br></br>
        <table>
            <tr>
                <th style="padding: 10px; font-size: 15px;">Name</th>
                <th style="padding: 10px; font-size: 15px;">Description</th>
                <th style="padding: 10px; font-size: 15px;">Image</th>
                <th style="padding: 10px; font-size: 15px;">Update</th>
                <th style="padding: 10px; font-size: 15px;">Delete</th>
            </tr>

            <?php
                while($info = mysqli_fetch_assoc($result))
                {
            ?>

            <tr>
                <td style="padding: 10px;"><?php echo $info['name']; ?></td>
                <td style="padding: 10px;"><?php echo $info['description']; ?></td>
                <td style="padding: 10px;"><img src="images/<?php echo $info['image']; ?>" alt="<?php echo $info['name']; ?>" width="100"></td>
                <td style="padding: 10px;">
                    <div class="action-buttons">
                        <a href="admin_update_course.php?id=<?php echo $info['id']; ?>">Update</a>
                    </div>
                </td>
                <td style="padding: 10px;">
                    <div class="action-buttons">
                        <a href="admin_delete_course.php?id=<?php echo $info['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                    </div>
                </td>
            </tr>

            <?php
                }
            ?>
        </table>
    </div>
    
</body>
</html>
