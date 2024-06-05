<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
        
        html {
            height: 100%;
            background: url('School-children-wearing-school-uniforms.webp') no-repeat center center fixed;
            background-size: cover;
        }
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent; 
        }
        .center-text {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 300px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            margin: 8px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="center-text">
        <h4>Login Form</h4>
        <?php

        
        if (isset($_SESSION['loginMessage'])) {
            echo "<p>" . $_SESSION['loginMessage'] . "</p>";
            unset($_SESSION['loginMessage']); 
        }
        ?>
        <form action="login_check.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
