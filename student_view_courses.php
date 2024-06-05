<?php
session_start();

$host = "localhost:3307";
$user = "root";
$password = "";
$db = "schoolproject"; 

$data = mysqli_connect($host, $user, $password, $db);


if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM course";
$result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Courses</title>
     
    <?php
        include 'student_css.php';
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
    </style>
</head>
<body>

<?php
        include 'student_sidebar.php';
    ?>

    <div class="content">
        <h1>View Courses</h1>
        <br>
        <table>
            <tr>
                <th style="padding: 10px; font-size: 15px;">Name</th>
                <th style="padding: 10px; font-size: 15px;">Description</th>
                <th style="padding: 10px; font-size: 15px;">Image</th>
            </tr>

            <?php
                while($info = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td style="padding: 10px;"><?php echo $info['name']; ?></td>
                <td style="padding: 10px;"><?php echo $info['description']; ?></td>
                <td style="padding: 10px;"><img src="images/<?php echo $info['image']; ?>" alt="<?php echo $info['name']; ?>" width="100"></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>
</html>

<?php

mysqli_close($data);
?>
