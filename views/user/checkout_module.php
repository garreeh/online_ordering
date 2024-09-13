<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Shopping cart | Metronic Shop UI</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-">
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"> 
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="./../../assets/user/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="./../../assets/user/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="./../../assets/user/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">

  <link href="./../../assets/user/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <link href="./../../assets/user/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
  <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
  <link href="./../../assets/user/plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="./../../assets/user/pages/css/components.css" rel="stylesheet">
  <link href="./../../assets/user/corporate/css/style.css" rel="stylesheet">
  <link href="./../../assets/user/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="./../../assets/user/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="./../../assets/user/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="./../../assets/user/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">
  <?php include './../../includes/navigation.php'?>



    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                  <table summary="Shopping cart">
                    <thead>
                      <tr>
                        <th class="goods-page-image">Image</th>
                        <th class="goods-page-description">Description</th>
                        <th class="goods-page-ref-no">SKU</th>
                        <th class="goods-page-quantity">Quantity</th>
                        <th class="goods-page-price">Unit price</th>
                        <th class="goods-page-total" colspan="2">Total</th>
                      </tr>
                    </thead>
                    <tbody id="cart-items">
                      <!-- Cart items will be inserted here by JavaScript -->
                    </tbody>
                  </table>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li>
                      <em>Sub total</em>
                      <strong class="price" id="cart-subtotal"><span>₱ </span>0.00</strong>
                    </li>
                    <li>
                      <em>Shipping cost</em>
                      <strong class="price" id="cart-shipping"><span>₱ </span>35.00</strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>Total</em>
                      <strong class="price" id="cart-total"><span>₱ </span>0.00</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <a href="/online_ordering/index.php" class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></a>
              <button class="btn btn-primary" type="submit">Checkout <i class="fa fa-check"></i></button>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
    </div>

    <?php include './../../includes/footer.php'?>


    <script src="./../../assets/user/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="./../../assets/user/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="./../../assets/user/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="./../../assets/user/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="./../../assets/user/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="./../../assets/user/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="./../../assets/user/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    <script src="./../../assets/user/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="./../../assets/user/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>

    <script src="./../../assets/user/corporate/scripts/layout.js" type="text/javascript"></script>

    <!-- Add Toastify CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
            Layout.initSliderRange();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

<script type="text/javascript">
  $(document).ready(function() {
      function updateCart() {
        $.ajax({
            url: '/online_ordering/controllers/users/fetch_cart_process.php', // Ensure this path is correct
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Cart Data:', response); // Debugging: Check the console for the data structure

                if (response.success) {

                    var cartContent = '';
                    var totalItems = response.total_items;
                    var totalPrice = response.total_price;


                    $('#cart-items').empty();

                    $.each(response.items, function(index, item) {
                        var productPrice = parseFloat(item.product_sellingprice) || 0; // Default to 0 if undefined or not a number
                        var cartQuantity = parseInt(item.cart_quantity, 10) || 0; // Default to 0 if undefined or not an integer

                        cartContent += '<tr>';
                        cartContent += '<td class="goods-page-image"><a href="javascript:;"><img src="./../../assets/user/pages/img/products/model3.jpg" alt="' + item.product_name + '" /></a></td>';
                        cartContent += '<td class="goods-page-description"><h3><a href="javascript:;"></a></h3><p><strong>' + item.product_name + '</strong></p><em>' + item.product_description + '</em></td>';
                        cartContent += '<td class="goods-page-ref-no">' + item.product_sku + '</td>';
                        cartContent += '<td class="goods-page-quantity"><div class="product-quantity"><input type="text" value="' + cartQuantity + '" readonly class="form-control input-sm"></div></td>';
                        cartContent += '<td class="goods-page-price"><strong><span>₱ </span>' + productPrice.toFixed(2) + '</strong></td>';
                        cartContent += '<td class="goods-page-total"><strong><span>₱ </span>' + (productPrice * cartQuantity).toFixed(2) + '</strong></td>';
                        cartContent += '<td class="del-goods-col"><a class="del-goods" href="javascript:;" data-product-id="' + item.product_id + '">&nbsp;</a></td>';
                        cartContent += '</tr>';
                    });

                    $('#cart-items').html(cartContent);
                    $('#cart-subtotal').text('₱ ' + response.total_price.toFixed(2));
                    $('#cart-total').text('₱ ' + (response.total_price + 3).toFixed(2)); // Adding shipping cost
                } else {
                    console.error('Failed to fetch cart data:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
      }

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

      // Initial cart update
      updateCart();
  });
</script>


