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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM course WHERE id='$id'";
    $result = mysqli_query($data, $sql);
    $course = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $description = mysqli_real_escape_string($data, $_POST['description']);
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE course SET name='$name', description='$description', image='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE course SET name='$name', description='$description' WHERE id='$id'";
    }

    if (mysqli_query($data, $sql)) {
        $_SESSION['message'] = "Course updated successfully.";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($data);
    }

    header("Location: admin_view_courses.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Course</title>
     
    <?php
        include 'admin_css.php';
    ?>

    <style>
        .content {
            text-align: center; 
        }
        .form-container {
            background-color: lightgreen;
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
        }
        input[type="file"] {
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>

</head>
<body>
        
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <h1>Update Course</h1>
        
        <div class="form-container">
            <form action="admin_update_course.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                
                <label for="name">Course Name</label>
                <input type="text" id="name" name="name" value="<?php echo $course['name']; ?>" required>
                
                <label for="description">Course Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo $course['description']; ?></textarea>
                
                <label for="image">Course Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                
                <input type="submit" value="Update Course">
            </form>
        </div>
    </div>
    
</body>
</html>
