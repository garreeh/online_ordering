<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include './connections/connections.php';

// Check if the user is logged in and an admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === "1") {
  // If the user is an admin, redirect them to the admin dashboard
  header("Location: /v2/views/admin/dashboard.php");
  exit();
}


if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];

  // Updated query with LEFT JOIN on `variations` table
  $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Fetch product details and variations
    $product = mysqli_fetch_assoc($result);
    $product_image = basename($product['product_image']);
    $product_image_no_base = $product['product_image'];

    $product_name = $product['product_name'];
    $product_sellingprice = $product['product_sellingprice'];


    $image_url = './uploads/' . $product_image;
?>

    <!DOCTYPE html>

    <html lang="en">

    <head>
      <meta charset="utf-8">
      <title>Sterling | Bookings</title>

      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

      <meta content="Metronic Shop UI description" name="description">
      <meta content="Metronic Shop UI keywords" name="keywords">
      <meta content="keenthemes" name="author">

      <meta property="og:site_name" content="-CUSTOMER VALUE-">
      <meta property="og:title" content="-CUSTOMER VALUE-">
      <meta property="og:description" content="-CUSTOMER VALUE-">
      <meta property="og:type" content="website">
      <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
      <meta property="og:url" content="-CUSTOMER VALUE-">

      <link rel="shortcut icon" href="favicon.ico">

      <!-- Fonts START -->
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
      <!-- Fonts END -->

      <!-- Global styles START -->
      <link href="assets/user/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="assets/user/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Global styles END -->

      <!-- Page level plugin styles START -->
      <link href="assets/user/pages/css/animate.css" rel="stylesheet">
      <link href="assets/user/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
      <link href="assets/user/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
      <!-- Page level plugin styles END -->

      <!-- Theme styles START -->
      <link href="assets/user/pages/css/components.css" rel="stylesheet">
      <link href="assets/user/pages/css/style-shop.css" rel="stylesheet" type="text/css">
      <link href="assets/user/corporate/css/style.css" rel="stylesheet">
      <link href="assets/user/corporate/css/style-responsive.css" rel="stylesheet">
      <link href="assets/user/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
      <link href="assets/user/corporate/css/custom.css" rel="stylesheet">
      <!-- Theme styles END -->
    </head>
    <!-- Head END -->

    <style>
      /* Category Filter styling */
      .category-filter {
        max-width: 250px !important;
        padding: 15px !important;
        border: 1px solid #ddd !important;
        border-radius: 10px !important;
        background-color: #f9f9f9 !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        position: -webkit-sticky;
        /* For Safari */
        position: sticky !important;
        /* Use sticky positioning */
        top: 20px !important;
        /* Distance from the top when sticking */
        z-index: 1000 !important;
      }

      .category-filter h3 {
        color: #555 !important;
        font-weight: bold !important;
        font-size: 24px !important;
      }

      .category-filter ul li a {
        text-decoration: none !important;
        color: #555 !important;
        font-size: 18px !important;
        font-weight: bold !important;
        display: block !important;
        padding: 10px 20px !important;
        margin: 5px auto !important;
        border-radius: 6px !important;
        transition: background-color 0.3s, color 0.3s !important;
      }

      .category-filter ul li a:hover {
        background-color: #4682B4 !important;
        color: #fff !important;
      }

      .product-item:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3) !important;
      }

      .product-item img {
        max-width: 100% !important;
        height: 15rem !important;
        border-radius: 8px !important;
        transition: transform 0.3s !important;
      }

      .product-item img:hover {
        transform: scale(1.05) !important;
      }

      .product-item h3 {
        color: #333 !important;
        font-size: 1.8rem !important;
        font-weight: bold !important;
        margin-top: 15px !important;
        text-align: center !important;
      }

      .pi-price {
        color: #2E8B57 !important;
        font-size: 1.5rem !important;
        font-weight: bold !important;
        margin-top: 10px !important;
        text-align: center !important;
      }

      /* Quantity Controls */
      .quantity-controls {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 10px !important;
        margin: 10px 0 !important;
        padding: 10px !important;
        border-radius: 8px !important;
        border: 1px solid #ccc !important;
        background-color: #f9f9f9 !important;
      }

      .quantity-controls button {
        border: none !important;
        border-radius: 6px !important;
        font-size: 1.5rem !important;
        cursor: pointer !important;
        transition: background-color 0.3s !important;
        padding: 10px 20px !important;
      }

      .minus-btn {
        background-color: #ff6f61 !important;
        color: white !important;
      }

      .minus-btn:hover {
        background-color: #ff4d4d !important;
      }

      .add-btn {
        background-color: #4CAF50 !important;
        color: white !important;
      }

      .add-btn:hover {
        background-color: #45a049 !important;
      }

      .cart_quantity {
        font-size: 1.5rem !important;
        text-align: center !important;
        border: none !important;
        width: 60px !important;
      }

      /* Add to Order Button */
      .add-to-cart {
        position: absolute !important;
        bottom: 1rem !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 90% !important;
        padding: 0.5rem 0 !important;
        background-color: #4682B4 !important;
        color: #fff !important;
        font-weight: bold !important;
        text-align: center !important;
        border-radius: 8px !important;
        transition: background-color 0.3s !important;
      }

      .add-to-cart:hover {
        background-color: #3578A6 !important;
      }



      /* Product item styles */
      .product-item:hover {
        transform: scale(1.02) !important;
      }

      /* Button hover effects */
      .add-btn:hover,
      .minus-btn:hover {
        opacity: 0.8 !important;
      }

      /* Category menu styles */
      #categoryMenu a:hover {
        background-color: #e9ecef !important;
      }

      /* Responsive styling */
    </style>

    <style>
      .carousel-control-prev-icon,
      .carousel-control-next-icon {
        /* Set the arrow background to black */
        background-image: none;
        /* Remove the default icon */
      }

      .carousel-control-prev-icon::after,
      .carousel-control-next-icon::after {
        content: '';
        /* Clear any default content */
        display: inline-block;
        border: solid black;
        /* Set arrow color */
        border-width: 0 5px 5px 0;
        padding: 10px;
      }

      .carousel-control-prev-icon::after {
        transform: rotate(135deg);
        /* Left arrow */
      }

      .carousel-control-next-icon::after {
        transform: rotate(-45deg);
        /* Right arrow */
      }

      #productStyles {
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        height: 100%;
      }

      #mainProductImage {
        width: 100%;
        transition: transform 0.3s ease;
      }

      /* Hidden zoomed image container */
      #zoomedImage {
        position: absolute;
        /* Use absolute positioning */
        width: 150px;
        height: 150px;
        background-color: rgba(255, 255, 255, 0.8);
        display: none;
        background-size: contain;
        background-repeat: no-repeat;
        pointer-events: none;
        /* Prevent zoomed image from blocking clicks */
        border-radius: 40%;
        /* Circular effect */
        border: 3px solid #000;
        /* Border for better visibility */
        transition: transform 0.1s ease;
        z-index: 1000;
        /* Make sure it's above other elements */
      }

      /* Thumbnail Image Styling */
      .product-thumbnails img {
        max-width: 100px;
        margin-right: 10px;
      }

      /* Hover effect for thumbnails */
      .product-thumbnails img:hover {
        border: 2px solid #000;
      }

      .product-section h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #333333;
        margin-bottom: 1rem;
      }

      .product-section .text-muted {
        font-size: 1.2rem;
        color: #666666;
        margin-bottom: 1.5rem;
      }

      .product-section ul li {
        font-size: 1rem;
        color: #555555;
        margin-bottom: 0.5rem;
      }

      .product-section .form-control {
        font-size: 1.2rem;
        border: 1px solid #ddd;
        color: #333333;
      }


      form {
        display: flex;
        gap: 10px;
      }
    </style>

    <!-- Body BEGIN -->

    <body class="ecommerce">

      <!-- This is the Header and navigation -->
      <?php

      include './includes/navigation.php';
      include './connections/connections.php';

      ?>

      <div class="main">
        <div class="container">
          <!-- Flex Container to keep Category Filter on the left -->
          <div class="row margin-bottom-40">
            <h1>Booking Lists</h1>
            <br>

            <div class="row">
              <div class="col-md-6 align-items-stretch">
                <!-- Card for Main Product Image and Thumbnails -->
                <div id="productStyles">
                  <!-- Main Product Image with Zoom Effect -->
                  <div class="zoom-container">
                    <img id="mainProductImage" src="<?php echo $image_url; ?>" class="img-fluid"
                      style="border-radius: 10px; object-fit: cover;">
                    <!-- Optional: Add zoom effect using CSS -->
                    <div id="zoomedImage" class="zoomed-image"></div>
                  </div>
                  <hr>

                  <!-- Thumbnail Images below main image -->
                  <div class="product-thumbnails">
                    <?php
                    // Display the main product image as the first thumbnail
                    echo '<img src="' . $image_url . '" class="img-thumbnail" alt="Product Image" style="cursor: pointer;" onclick="changeMainImage(\'' . $image_url . '\')">';

                    // Fetch all other product images from 'product_image' table
                    $queryImages = "SELECT product_image_path FROM product_image WHERE product_id = $product_id";
                    $resultImages = mysqli_query($conn, $queryImages);

                    if ($resultImages && mysqli_num_rows($resultImages) > 0) {
                      while ($image = mysqli_fetch_assoc($resultImages)) {
                        $productImagePath = './uploads/' . basename($image['product_image_path']);
                        echo '<img src="' . $productImagePath . '" class="img-thumbnail" alt="Product Image" style="cursor: pointer;" onclick="changeMainImage(\'' . $productImagePath . '\')">';
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-md-6 align-items-stretch">
                <!-- Card for Main Product Image and Thumbnails -->
                <?php
                $sql = "SELECT * FROM product WHERE product_id = $product_id";
                $result = $conn->query($sql);

                // Check if there are any products
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $product_image = basename($row['product_image']);
                    $image_url = './uploads/' . $product_image;
                    $product_id = $row['product_id']; // Assuming the product_id is in the 'product_id' column
                ?>
                    <div id="productStyles" class="product-item">
                      <!-- Main Product Image with Zoom Effect -->
                      <br>
                      <h1><?php echo htmlspecialchars($row['product_name']); ?></h1>

                      <hr>
                      <i class="fas fa-box"></i> IN STOCK
                      <hr>

                      <p class="text-muted">₱ <span id="productPrice"><?php echo number_format($row['product_sellingprice'], 2); ?></span></p>
                      <p><?php echo htmlspecialchars($row['product_description']); ?></p>

                      <form id="sizeForm">

                        <input
                          type="hidden"
                          name="product_name"
                          id="product_name"
                          value="<?php echo $product_name; ?>">

                        <input
                          type="hidden"
                          name="product_name"
                          id="product_name"
                          value="<?php echo $product_name; ?>">
                        <input
                          type="hidden"
                          name="product_image"
                          id="product_image"
                          value="<?php echo $product_image_no_base; ?>">
                        <input
                          type="hidden"
                          name="product_sellingprice"
                          id="product_sellingprice"
                          value="<?php echo $product_sellingprice; ?>">
                      </form>

                      <br>

                      <div class="quantity-controls"
                        style="display: flex; justify-content: center; align-items: center; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; padding: 10px; background-color: #f9f9f9; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <button class="minus-btn"
                          style="background-color: #ff6f61; color: white; border: none; border-radius: 5px; width: 50px; height: 50px; cursor: pointer; transition: background-color 0.3s; font-size: 1.5rem; display: flex; align-items: center; justify-content: center;">
                          -
                        </button>
                        <input type="number" class="cart_quantity" value="1" min="1"
                          style="width: 60px; text-align: center; border: none; outline: none; font-size: 1.5rem; margin: 0 10px; border-radius: 5px; height: 50px;" readonly>
                        <button class="add-btn"
                          style="background-color: #4CAF50; color: white; border: none; border-radius: 5px; width: 50px; height: 50px; cursor: pointer; transition: background-color 0.3s; font-size: 1.5rem; display: flex; align-items: center; justify-content: center;">
                          +
                        </button>
                      </div>

                      <br>
                      <br>
                      <!-- Add to Cart Button -->
                      <a href="javascript:void(0)" class="btn btn-default add-to-cart add2cart"
                        data-product-id="<?php echo $row['product_id']; ?>"
                        style="position: absolute; bottom: 1rem; left: 50%; transform: translateX(-50%); width: 90%; text-align: center; padding: 0.5rem 0; background-color: #4682B4; color: #fff; font-weight: bold; border-radius: 5px; transition: background-color 0.3s;">
                        Add to Order
                      </a>

                    </div>

                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include './modals/not_logged_in.php' ?>
      <?php include './includes/footer.php' ?>
      <?php include './modals/modal_fast_view.php' ?>
    </body>
    <!-- END BODY -->

    </html>

    <script src="assets/user/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/user/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/user/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/user/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="assets/user/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/user/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="assets/user/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='assets/user/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="assets/user/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="assets/user/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="assets/user/pages/scripts/bs-carousel.js" type="text/javascript"></script>

    <!-- Add Toastify CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="text/javascript">
      jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        Layout.initImageZoom();
        Layout.initTouchspin();
        Layout.initTwitter();
      });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->

    <script type="text/javascript">
      // Handle quantity increase and decrease buttons
      $(document).on('click', '.add-btn', function() {
        var quantityInput = $(this).siblings('.cart_quantity');
        var currentValue = parseInt(quantityInput.val());
        quantityInput.val(currentValue + 1);
      });

      $(document).on('click', '.minus-btn', function() {
        var quantityInput = $(this).siblings('.cart_quantity');
        var currentValue = parseInt(quantityInput.val());
        if (currentValue > 1) {
          quantityInput.val(currentValue - 1);
        }
      });

      $(document).ready(function() {

        $('.add-to-cart').click(function() {
          var productId = $(this).data('product-id');
          var $button = $(this);
          var quantityInput = $button.closest('.product-item').find('.cart_quantity');
          var quantity = parseInt(quantityInput.val()) || 1; // Default to 1 if no valid quantity

          // Make AJAX call to add_cart_process.php
          $.ajax({
            url: '/v2/controllers/users/add_cart_booking_process.php',
            method: 'POST',
            data: {
              product_id: productId,
              cart_quantity: quantity
            },
            success: function(response) {
              try {
                var res = JSON.parse(response);
                if (res.success) {
                  // Show success message using Toastify
                  Toastify({
                    text: res.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4CAF50", // Green background for success
                  }).showToast();
                } else {
                  if (res.message === 'You are not logged in.') {
                    // Show the modal instead of Toast
                    $('#loginModal').modal('show');
                  } else {
                    // Show error message using Toastify
                    Toastify({
                      text: res.message,
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: "right",
                      backgroundColor: "#FF0000", // Red background for error
                    }).showToast();
                  }
                }
              } catch (e) {
                console.error("Invalid JSON response:", response);
                Toastify({
                  text: "An unexpected error occurred.",
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#FF0000", // Red background for error
                }).showToast();
              }
            },
            error: function(xhr, status, error) {
              console.log('Error: ' + error);
              Toastify({
                text: "An error occurred. Please try again.",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#FF0000", // Red background for error
              }).showToast();
            }
          });
        });
      });

      function changeMainImage(imagePath) {
        document.getElementById('mainProductImage').src = imagePath;
      }
    </script>


<?php
  }
}
?>