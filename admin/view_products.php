<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'shopDB');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            overflow: hidden;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        img {
            width: 80px;
            height: auto;
        }
        a.button {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        a.button:hover {
            background-color: #d32f2f;
        }
        td {
            background-color: #f9f9f9;
        }
        td a {
            margin-top: 5px;
            display: inline-block;
        }
        .table-container {
            max-height: 400px;
            overflow-y: auto;
            display: block;
        }

        /* Style for the buttons at the bottom */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .action-buttons a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            text-align: center;
            width: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>All Products</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td><img src='uploads/" . $row['image_path'] . "' alt='Product Image'></td>";
                            echo "<td>
                                    <a class='button' href='delete_product.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Action buttons at the bottom -->
        <div class="action-buttons">
            <a href="add_product.php">Add New Product</a>
            <a href="dashboard.php">Dashboard</a>
        </div>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>
