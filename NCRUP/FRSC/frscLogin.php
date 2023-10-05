<!DOCTYPE html>
<html>
<head>
    <title>FRSC Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .login-container {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 100px;
            border: 1px solid #ccc;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    $username = "frscadmin";
    $password = "frscpassword";
    $errorMessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputUsername = $_POST["username"];
        $inputPassword = $_POST["password"];

        if ($inputUsername == $username && $inputPassword == $password) {
            header("Location: display.php");
            exit;
        } else {
            $errorMessage = "Invalid username or password!";
        }
    }
    ?>

    <div class="login-container">
        <h2>Federal Road Safety Corps LOGIN</h2>
        <?php if ($errorMessage !== ''): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" value="<?php echo htmlspecialchars($password); ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
