<?php
error_reporting(0);
session_start();

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

$sql = "SELECT * FROM user WHERE usertype = 'student'";

$result = mysqli_query($data, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($data));
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
            padding: 20px;
            font-size: 20px;
        }

        .table_td {
            padding: 20px;
            background-color: lightgreen;
        }
    </style>
</head>
<body>

    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
            <h1>Student Data</h1>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>

            <br><br>

            <table border="1px">
                <tr>
                    <th class="table_th">UserName</th>
                    <th class="table_th">Email</th>
                    <th class="table_th">Phone</th>
                    <th class="table_th">Password</th>
                    <th class="table_th">Delete</th>
                    <th class="table_th">Update</th>
                </tr>

                <?php
                while ($info = $result->fetch_assoc()) {
                    ?>

                    <tr>
                        <td class="table_td">
                            <?php echo htmlspecialchars($info['username']); ?>
                        </td>
                        <td class="table_td">
                            <?php echo htmlspecialchars($info['email']); ?>
                        </td>
                        <td class="table_td">
                            <?php echo htmlspecialchars($info['phone']); ?>
                        </td>
                        <td class="table_td">
                            <?php echo htmlspecialchars($info['password']); ?>
                        </td>
                        <td class="table_td">
                            <?php echo "<a onClick=\"javascript: return confirm('Are You Sure To Delete This ?');\" class='btn btn-danger' href='delete.php?student_id={$info['id']}'> Delete </a>"; ?>
                        </td>
                        <td class="table_td">
                            <?php echo "<a class='btn btn-primary' href='update_student.php?student_id={$info['id']}'> Update </a>"; ?>
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
