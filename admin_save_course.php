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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $description = mysqli_real_escape_string($data, $_POST['description']);
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    
    if (!is_dir('images')) {
        mkdir('images', 0777, true);
    }

    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO course (name, description, image) VALUES ('$name', '$description', '$image')";
        if (mysqli_query($data, $sql)) {
            
        } else {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($data);
        }
    } else {
        $_SESSION['message'] = "Failed to upload image.";
    }
    header("Location: admin_add_courses.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    header("Location: admin_add_course.php");
    exit();
}

?>
