<?php 
// if (session_status() == PHP_SESSION_NONE) {
  session_start();
// }

// if (isset($_SESSION['user_id'])) {
//   if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == "1") {
//       // If the user is an admin, redirect to the admin dashboard
//       header("Location: /online_ordering/index.php");
//   } else {
//       // If the user is not an admin, redirect to the user dashboard
//       header("Location: /online_ordering/index.php");
//   }
//   exit();
// }

?>

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
                        <li><a href="shop-account.html">My Account</a></li>
                        <li><a href="shop-wishlist.html">My Wishlist</a></li>
                        <li><a href="shop-checkout.html">Checkout</a></li>
                        <li><a href="./controllers/logout_process.php">Logout</a></li>
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
    <a class="site-logo" href="shop-index.html"><img src="assets/user/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI"></a>

    <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

    <!-- BEGIN CART -->
    <div class="top-cart-block">
      <div class="top-cart-info">
        <a class="top-cart-info-count">3 items</a>
        <a class="top-cart-info-value">$1260</a>
      </div>
      <i class="fa fa-shopping-cart"></i>
                    
      <div class="top-cart-content-wrapper">
        <div class="top-cart-content">
          <ul class="scroller" style="height: 250px;">
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
            <li>
              <a href="shop-item.html"><img src="assets/user/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
              <span class="cart-content-count">x 1</span>
              <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
              <em>$1230</em>
              <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
            </li>
          </ul>
          <div class="text-right">
            <a href="shop-shopping-cart.html" class="btn btn-default">View Cart</a>
            <a href="shop-checkout.html" class="btn btn-primary">Checkout</a>
          </div>
        </div>
      </div>            
    </div>
    <!--END CART -->


  </div>
</div>
<!-- Header END -->