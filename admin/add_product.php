<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect if admin is not logged in
    exit;
}

// If form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'shopDB');
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Receive data with basic protection
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Handle image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $target_dir = __DIR__ . "/uploads/";

        // Create a unique image name
        $image_name = time() . '_' . basename($_FILES["product_image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Check image type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png'];

        if (!in_array($imageFileType, $allowedTypes)) {
            echo "Please upload an image in jpg, jpeg, or png format.";
            exit;
        }

        // Check image size (maximum 5MB)
        if ($_FILES['product_image']['size'] > 5 * 1024 * 1024) {
            echo "Image size is too large. The maximum allowed size is 5MB.";
            exit;
        }

        // Try to move the uploaded image
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            // Image successfully uploaded, now insert product data into database
            $sql = "INSERT INTO products (name, description, price, image_path) 
                    VALUES ('$name', '$description', '$price', '$image_name')";

            if (mysqli_query($conn, $sql)) {
                echo "✅ Image uploaded and product added successfully!";
            } else {
                echo "❌ Error occurred while adding product: " . mysqli_error($conn);
            }
        } else {
            echo "❌ Failed to upload image.";
        }
    } else {
        echo "❌ No file uploaded or error during upload.";
    }    

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #4CAF50;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
        .header-buttons {
            text-align: right;
            margin-bottom: 20px;
        }
        .header-buttons a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            margin: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .header-buttons a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Header buttons for navigation -->
    <div class="header-buttons">
        <a href="dashboard.php">Dashboard</a>
        <a href="view_products.php">View Products</a>
    </div>

    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>
        
        <label for="description">Product Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Product Price:</label>
        <input type="text" id="price" name="price" required><br><br>

        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image" required><br><br>

        <input type="submit" value="Add Product">
    </form>

</body>
</html>
