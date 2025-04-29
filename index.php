<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: start/php/index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header("Location: start/php/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="./swiper-bundle.min.css">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="./style.css">

        <title>Clothes website</title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
              <a href="#" class="nav__logo">
                Shop.
              </a>

               <div class="nav__menu" id="nav__menu">
                 <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">
                            <i class="ri-home-line"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#new" class="nav__link">
                            <i class="ri-price-tag-3-line"></i>
                            <span>New</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#collection" class="nav__link">
                            <i class="ri-compass-line"></i>
                            <span>Collection</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#products" class="nav__link">
                            <i class="ri-t-shirt-line"></i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="start/php/index.php?logout=1" class="nav__link logout-btn">
                            <i class="ri-logout-box-line"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                 </ul>
               </div>
               <!-- الليل والنهار -->
               <i class="ri-moon-line change-theme" id="theme-button"></i> 
            </nav>
        </header>

        <!--==================== PRODUCTS ====================-->
        <section class="products section" id="products">
            <h2 class="section__title">
                Best Products
            </h2>

            <div class="products__container container swiper">
               <div class="swiper-wrapper">
                  <?php
                  $conn = mysqli_connect('localhost', 'root', '', 'shopDB');
                  if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                  }

                  $sql = "SELECT * FROM products";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while($product = mysqli_fetch_assoc($result)) {
                          echo '<article class="products__card swiper-slide">
                                  <img src="' . htmlspecialchars($product['image_path']) . '" alt="' . htmlspecialchars($product['name']) . '" class="products__img">
                                  <h2 class="products__title">' . htmlspecialchars($product['name']) . '</h2>
                                  <p class="products__description">' . htmlspecialchars($product['description']) . '</p>
                                  <span class="products__price">$' . number_format($product['price'], 2) . '</span>
                                </article>';
                      }
                  } else {
                      echo '<p>No products found</p>';
                  }
                  mysqli_close($conn);
                  ?>
               </div>
               <div class="swiper-button-next">
                  <i class="ri-arrow-right-line"></i>
               </div>
               <div class="swiper-button-prev">
                  <i class="ri-arrow-left-line"></i>
               </div>
            </div>
        </section>
    </body>
</html> 