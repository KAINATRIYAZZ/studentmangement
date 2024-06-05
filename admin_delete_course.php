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

    $sql = "DELETE FROM course WHERE id='$id'";
    if (mysqli_query($data, $sql)) {
        $_SESSION['message'] = "Course deleted successfully.";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($data);
    }

    header("Location: admin_view_courses.php");
    exit();
}

?>
