<?php
// Test database connection
$conn = mysqli_connect('localhost', 'root', '', 'shopDB');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h2>Database Connection Test</h2>";
echo "Connected to shopDB successfully!<br><br>";

// Test products table
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error querying products table: " . mysqli_error($conn));
}

echo "<h2>Products Table Test</h2>";
echo "Number of products found: " . mysqli_num_rows($result) . "<br><br>";

// Display sample product data
if (mysqli_num_rows($result) > 0) {
    echo "<h3>Sample Product Data:</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Image Path</th></tr>";
    
    $product = mysqli_fetch_assoc($result);
    echo "<tr>";
    echo "<td>" . htmlspecialchars($product['id']) . "</td>";
    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
    echo "<td>$" . number_format($product['price'], 2) . "</td>";
    echo "<td>" . htmlspecialchars($product['image_path']) . "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "No products found in the database.";
}

mysqli_close($conn);
?> 