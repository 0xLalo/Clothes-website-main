<?php 
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'shopDB');

if (!$conn) {
    echo 'Error: ' . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // تشفير الباسورد باستخدام MD5

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && $password == $admin['password']) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Username or Password is not valid</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- تضمين الـ CSS داخل الصفحة -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        form p {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="index.php" method="POST">
            <h2>Admin Login</h2>
            <input type="text" name="username" id="username" placeholder="Username" required><br><br>
            <input type="password" name="password" id="password" placeholder="Password" required><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <br>
        <a href="../start/php/index.php" style="display: inline-block; padding: 10px 20px; background-color: #2a2a2a; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;">Go to Store</a>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>
