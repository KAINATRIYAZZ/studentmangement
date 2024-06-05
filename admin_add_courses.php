<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); 
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Course</title>
     
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
        .message {
            color: green;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>

</head>
<body>
        
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <h1>Add Course</h1>
        
        <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="message">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']); 
            }
        ?>
        
        <div class="form-container">
            <form action="admin_save_course.php" method="POST" enctype="multipart/form-data">
                <label for="name">Course Name</label>
                <input type="text" id="name" name="name" required>
                
                <label for="description">Course Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
                
                <label for="image">Course Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                
                <input type="submit" value="Add Course">
            </form>
        </div>
    </div>
    
</body>
</html>
