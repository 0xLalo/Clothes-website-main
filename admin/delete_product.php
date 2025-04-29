<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // الاتصال بقاعدة البيانات
    $conn = mysqli_connect('localhost', 'root', '', 'shopDB');
    if (!$conn) {
        die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
    }

    // حذف المنتج
    $sql = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_products.php");
        exit;
    } else {
        echo "حدث خطأ أثناء حذف المنتج: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "رقم المنتج غير صحيح.";
}
?>
