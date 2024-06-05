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

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql = "SELECT * FROM teacher WHERE id='$t_id'";
    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_teacher'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $target = "upload/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $info['image'];
    }

    $sql = "UPDATE teacher SET name='$name', description='$description', image='$image' WHERE id='$id'";
    if (mysqli_query($data, $sql)) {
        $_SESSION['message'] = "Teacher data updated successfully!";
        header("location:admin_view_teacher.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($data);
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
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
       
        .form_deg {
            background-color: skyblue;
            width: 600px;
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
        <center> 
            <h1>Update Teacher Data</h1>
            <form class="form_deg" action="admin_update_teacher.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                <div>
                    <label>Teacher Name</label>
                    <input type="text" name="name" value="<?php echo $info['name']; ?>" required>
                </div>   
                <div>
                    <label>About Teacher</label>
                    <textarea name="description" rows="4" required><?php echo $info['description']; ?></textarea>
                </div>   
                <div>
                    <label>Teacher Old Image</label>
                    <img width="100px" height="100px" src="<?php echo $info['image']; ?>">
                </div>   
                <div>
                    <label>Teacher New Image</label>
                    <input type="file" name="image">
                </div>   
                <div>
                    <input type="submit" name="update_teacher" value="Update" class="btn btn-success">
                </div> 
            </form>
        </center>
    </div>
</body>
</html>
