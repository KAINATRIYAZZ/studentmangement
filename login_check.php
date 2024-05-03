<?php

error_reporting(0);
session_start(); // Start the session
error_reporting(0); // Turn off error reporting (note: this is usually not recommended in production)


$host = "localhost:3307"; // Corrected port syntax
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

// Use the correct superglobal variable $_SERVER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to reduce SQL injection risk, but use prepared statements as a best practice
    $name = mysqli_real_escape_string($data, $_POST['username']);
    $pass = mysqli_real_escape_string($data, $_POST['password']);

    // Prepare statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = mysqli_prepare($data, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the user data
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if ($row["usertype"] == "student") {
                
                $_SESSION['username']=$name;

                header("location:studenthome.php");
                exit();
            } else if ($row["usertype"] == "admin") {

                $_SESSION['username']=$name;
                header("location:adminhome.php");
                exit();
            }
        } else {
            $_SESSION['loginMessage'] = "Username or password do not match";
            header("location:login.php");
            exit();
        }
    } else {
        $message="username or password donot match";
        $_SESSION['loginMessage']=$message;
        header("location:login.php");
    }
}
?>
