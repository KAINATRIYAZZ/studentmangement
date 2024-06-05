<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); 
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit();
}

$host = "localhost:3307";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM teacher";
$result = mysqli_query($data, $sql);

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql2 = "DELETE FROM teacher WHERE id='$t_id'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        header('location:admin_view_teacher.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
     
    <?php
    include 'admin_css.php';
    ?>
    
    <style type="text/css">
        .table_th {
            padding: 10px;
            font-size: 10px;
        }
        .table_td {
            padding: 10px;
            background-color: skyblue;
        }
        <style type="text/css">
    .table_th {
        padding: 10px; 
        font-size: 16px; 
    }
    .table_td {
        padding: 10px; 
        background-color: lightgreen;
        font-size: 14px; 
    }
</style>

    </style>
</head>
<body>
    <?php
    include 'admin_sidebar.php';
    ?>
          
    <div class="content">
        <center>
            <h1>View All Teacher Data</h1>
            <table border="1px">
                <tr>
                    <th class="table_th">Teacher Name</th>
                    <th class="table_th">About Teacher</th>
                    <th class="table_th">Image</th>
                    <th class="table_th">Delete</th>
                    <th class="table_th">Update</th>
                </tr>  
                <?php
                while ($info = mysqli_fetch_assoc($result)) {
                ?>  
                <tr>
                    <td class="table_td">
                        <?php echo $info['name']; ?>
                    </td>
                    <td class="table_td">
                        <?php echo $info['description']; ?>
                    </td>
                    <td class="table_td">
                        <img height="100px" width="100px" src="<?php echo $info['image']; ?>">
                    </td>
                    <td class="table_td">
                        <a onClick="javascript:return confirm('Are You Sure To Delete This?');" class="btn btn-danger" href="admin_view_teacher.php?teacher_id=<?php echo $info['id']; ?>">
                            Delete
                        </a>
                    </td>
                    <td class="table_td">
                        <a href="admin_update_teacher.php?teacher_id=<?php echo $info['id']; ?>" class="btn btn-primary">Update</a>
                    </td>
                </tr>   
                <?php
                }
                ?>
            </table>
        </center>
    </div>
</body>
</html>
