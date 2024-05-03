<?php

session_start();

$host = "localhost:3307";
$user = "root";
$password = "";
$db = "schoolproject";

// Attempt to establish a connection to the MySQL database
$data = mysqli_connect($host, $user, $password, $db);

// Check if the connection was successful
if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_POST['apply'])) {
    $data_name = mysqli_real_escape_string($data, $_POST['name']);
    $data_email = mysqli_real_escape_string($data, $_POST['email']);
    $data_phone = mysqli_real_escape_string($data, $_POST['phone']);
    $data_message = mysqli_real_escape_string($data, $_POST['message']);

    // SQL query to insert the data
    $sql = "INSERT INTO admission (name, email, phone, message) VALUES (?, ?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($data, $sql);
    if ($stmt === false) {
        die("MySQL prepare error: " . mysqli_error($data));
    }

    // Bind parameters and execute
    mysqli_stmt_bind_param($stmt, 'ssss', $data_name, $data_email, $data_phone, $data_message);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $_SESSION['message'] = "Your application has been sent successfully";
        header("Location: index.php"); // Replace "your_page.php" with the appropriate page
        exit();
    } else {
        echo "Apply Fail: " . mysqli_error($data);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

?>
