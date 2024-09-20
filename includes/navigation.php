<?php 
// if (session_status() == PHP_SESSION_NONE) {
  session_start();
// }

// if (isset($_SESSION['user_id'])) {
//   if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == "1") {
//       // If the user is an admin, redirect to the admin dashboard
//       header("Location: /online_ordering/views/admin/dashboard.php.php");
//   } else {
//       // If the user is not an admin, redirect to the user dashboard
//       header("Location: /online_ordering/index.php");
//   }
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+639264753651</span></li>
                        <!-- BEGIN CURRENCIES -->
                        <li class="shop-currencies">
                            <a href="javascript:void(0);" class="current">₱ Currency</a>
                        </li>
                        <!-- END CURRENCIES -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="/online_ordering/views/user/account_module.php">My Account</a></li>
                            <li><a href="/online_ordering/views/user/checkout_module.php">Checkout</a></li>
                            <li><a href="/online_ordering/views/user/order_module.php">Orders</a></li>
                            <li><a href="/online_ordering/controllers/logout_process.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="views/login.php">Log In</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
        <div class="container">
            <a class="site-logo" href="/online_ordering/index.php">
                <img src="/online_ordering/assets/user/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI">
            </a>

            <!-- BEGIN CART -->
            <div class="top-cart-block">
                <div class="top-cart-info">
                    <a class="top-cart-info-count">0 items</a>
                    <a class="top-cart-info-value">₱ 0.00</a>
                </div>
                <i class="fa fa-shopping-cart"></i>
                        
                <div class="top-cart-content-wrapper">
                    <div class="top-cart-content">
                        <ul class="scroller" style="height: 250px;">
                            <!-- Cart items will be dynamically inserted here -->
                        </ul>
                        <div class="text-right">
                            <a href="/online_ordering/views/user/checkout_module.php" class="btn btn-default">View Cart</a>
                            <a href="#" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>            
            </div>
            <!-- END CART -->

        </div>
    </div>
    <!-- Header END -->



</body>
</html>
<script>
  $(document).ready(function() {
      // Function to update the cart
      function updateCart() {
          $.ajax({
              url: '/online_ordering/controllers/users/fetch_cart_process.php',
              method: 'GET',
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      var cartContent = '';
                      var totalItems = response.total_items;
                      var totalPrice = response.total_price;

                      $('.top-cart-info-count').text(totalItems + ' items');
                      $('.top-cart-info-value').text('₱ ' + totalPrice.toFixed(2));

                      $('.scroller').empty();

                      $.each(response.items, function(index, item) {
                          cartContent += '<li>';
                          cartContent += '<a href="shop-item.html"><img src="/online_ordering/assets/user/pages/img/cart-img.jpg" alt="' + item.product_name + '" width="37" height="34"></a>';
                          cartContent += '<span class="cart-content-count">x ' + item.cart_quantity + '</span>';
                          cartContent += '<strong><a href="shop-item.html">' + item.product_name + '</a></strong>';
                          cartContent += '<em>$' + (item.product_sellingprice * item.cart_quantity).toFixed(2) + '</em>';
                          cartContent += '<a href="#" class="del-goods" data-product-id="' + item.product_id + '">&nbsp;</a>';
                          cartContent += '</li>';
                      });

                      $('.scroller').html(cartContent);
                  } else {
                      console.error('Failed to fetch cart data:', response.message);
                  }
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', error);
              }
          });
      }

      // Function to delete an item from the cart
      function deleteCartItem(productId) {
          $.ajax({
              url: '/online_ordering/controllers/users/delete_cart_process.php',
              method: 'POST',
              data: { product_id: productId },
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      Toastify({
                          text: "Item removed from cart.",
                          backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                          className: "info",
                          duration: 3000
                      }).showToast();
                      updateCart(); // Refresh cart immediately
                  } else {
                      Toastify({
                          text: response.message,
                          backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                          className: "info",
                          duration: 3000
                      }).showToast();
                  }
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', error);
              }
          });
      }

      // Bind click event to delete buttons
      $(document).on('click', '.del-goods', function() {
          var productId = $(this).data('product-id');
          deleteCartItem(productId);
      });

      $(document).on('click', '.add-to-cart', function() {
          var productId = $(this).data('product-id');
          updateCart(productId);
      });
      // Initial cart update
      updateCart();
  });
</script>