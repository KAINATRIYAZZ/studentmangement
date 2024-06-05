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

if (isset($_GET['student_id'])) {
    $user_id = mysqli_real_escape_string($data, $_GET['student_id']);

    $sql = "DELETE FROM user WHERE id='$user_id'";

    $result = mysqli_query($data, $sql);

    if ($result) {
        $_SESSION['message'] = 'Student Deleted Successfully!';
    } else {
        $_SESSION['message'] = 'Error deleting student: ' . mysqli_error($data);
    }
    header("location:view_student.php");
    exit();
} else {
    $_SESSION['message'] = 'No student ID provided.';
    header("location:view_student.php");
    exit();
}
?>
