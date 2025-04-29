<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
        }
        .dashboard-links {
            margin-top: 30px;
        }
        .dashboard-links a {
            display: block;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .dashboard-links a:hover {
            background-color: #45a049;
        }
        .logout-button {
            display: block;
            margin: 10px 0;
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo $_SESSION["admin"]; ?> 👋</h2>

        <div class="dashboard-links">
            <a href="add_product.php">➕ Add New Product</a>
            <a href="view_products.php">📋 View All Products</a>
        </div>

        <!-- Logout Button -->
        <a href="index.php" class="logout-button">🔓 Logout</a>
    </div>

</body>
</html>
