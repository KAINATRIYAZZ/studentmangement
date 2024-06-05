<?php
error_reporting(0);
session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$message');</script>";
    unset($_SESSION['message']); 
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav>
        <label class="logo">W-school</label>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Admission</a></li>
            <li class="nav-item"><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>

    <div class="section1 text-center">
        <label class="img_text">Merit - Quality - Excellence</label>
        <img class="img-responsive center-block" src="desktop-rental-service-500x500.webp" alt="Main Image">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-responsive" src="School-children-wearing-school-uniforms.webp" alt="School Children">
            </div>
            <div class="col-md-8">
                <h1>Welcome to W-School</h1>
                <p>We are thrilled to welcome you to the W-School System Management System! This innovative platform is designed to streamline daily operations, boost efficiency, and empower staff across all departments.</p>
                <p>Whether you're a teacher, administrator, or support staff, this system offers a centralized hub for managing essential tasks. From attendance tracking and grade management to scheduling and communication tools, the W-School System Management System simplifies complex workflows and saves valuable time.</p>
                <p>Our user-friendly interface and comprehensive resources ensure a smooth transition, allowing you to leverage the full potential of this powerful platform.</p>
            </div>
        </div>
    </div>

    <h1 class="center-text">Our Teachers</h1>
    <div class="container">
        <div class="row">

<?php
while ($info = mysqli_fetch_assoc($result)) {
?>
            <div class="col-md-4">
                <img class="img-responsive" src="<?php echo $info['image']; ?>" alt="Teacher Image">
                <h3><?php echo $info['name']; ?></h3>
                <h5><?php echo $info['description']; ?></h5>
            </div>
<?php
}
?>
        </div>
    </div>

    <h1 class="center-text">Our Courses</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-responsive" src="BCA-3.jpg" alt="AI Course">
                <h2>Artificial Intelligence</h2>
            </div>
            <div class="col-md-4">
                <img class="img-responsive" src="operatingsystem.jpg" alt="Network Course">
                <h2>Computer Network</h2>
            </div>
            <div class="col-md-4">
                <img class="img-responsive" src="1687170692648.jpg" alt="Data Science Course">
                <h2>Data Science</h2>
            </div>
        </div>
    </div>

    <h1 class="center-text">Admission Form</h1>
    <div class="container admission_form">
        <form action="data_check.php" method="POST">
            <div class="form-group">
                <label class="label_text">Name</label>
                <input class="form-control input_deg" type="text" name="name" required>
            </div>
            <div class="form-group">
                <label class="label_text">Email</label>
                <input class="form-control input_deg" type="email" name="email" required>
            </div>
            <div class="form-group">
                <label class="label_text">Phone</label>
                <input class="form-control input_deg" type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label class="label_text">Message</label>
                <textarea class="form-control input_txt" name="message" required></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Apply" name="apply">
            </div>
        </form>
    </div>

    <footer>
        <h2 class="footer_text">All copyrights reserved by Web Tech Knowledge</h2>
    </footer>
</body>
</html>
