<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
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

$name = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username='$name' ";
$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);

if (isset($_POST['update_profile'])) {
    $s_email = $_POST['email'];
    $s_phone = $_POST['phone'];
    $s_password = $_POST['password'];

    $sql2 = "UPDATE user SET email='$s_email', phone='$s_phone', password='$s_password' WHERE username='$name'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        header('Location: student_profile.php');
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
    <?php include 'student_css.php'; ?>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background-color: lightgreen;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
    <?php include 'student_sidebar.php'; ?>
    <div class="content">
        <center>
            <h1>Update Profile</h1>
            <br><br>
            <form action="#" method="POST">
                <div class="div_deg">
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $info['email']; ?>">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone" value="<?php echo $info['phone']; ?>">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password" value="<?php echo $info['password']; ?>">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="update_profile" value="submit">
                    </div>
                </div>
            </form>
        </center>
    </div>
</body>
</html>
