<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (
    isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === "1" &&
    isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 1
) {
    // Admin and user_type_id 1 → Go to admin dashboard
    header("Location: /online_ordering/views/admin/dashboard.php");
    exit();
} elseif (
    isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 4
) {
    // user_type_id 4 → Go to deliveries module
    header("Location: /online_ordering/views/admin/deliveries_module.php");
    exit();
}



?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>J & J | Showcase</title>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Theme styles END -->
</head>
<!-- Head END -->

<style>
    /* Ensure parent container has position relative */
    .search-bar {
        position: relative;
    }

    #searchResults {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        right: 0 !important;
        background-color: #ffffff !important;
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1) !important;
        max-height: 250px !important;
        overflow-y: auto !important;
        z-index: 1000 !important;
        padding: 0.5rem 0 !important;
    }

    /* Show the dropdown when the "show" class is added */
    #searchResults.show {
        display: block;
    }

    #searchResults .dropdown-item {
        display: block !important;
        padding: 10px 15px !important;
        color: #333 !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        transition: background-color 0.2s ease !important;
        border-bottom: 1px solid #f1f1f1 !important;
    }

    #searchResults .dropdown-item:last-child {
        border-bottom: none !important;
    }

    #searchResults .dropdown-item:hover {
        background-color: #f5f5f5 !important;
        color: #000 !important;
    }

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

    /* Product Card styling */
    .product-item {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        padding: 1rem !important;
        border: 1px solid #ddd !important;
        border-radius: 10px !important;
        background-color: #fff !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2) !important;
        transition: transform 0.3s, box-shadow 0.3s !important;
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
                <!-- Category Filter -->
                <div class="col-md-3 col-sm-6 col-xs-5 category-filter"
                    style="max-width: 250px; padding: 0 10px; flex-shrink: 0;">
                    <div id="categoryMenu" style="border-radius: 8px; padding: 10px 0; background-color: #f9f9f9;">
                        <ul style="list-style: none; padding-left: 0; margin: 0;">
                            <li style="margin: 10px 0; text-align: center;">
                                <a href="javascript:void(0)" onclick="filterProducts('')"
                                    style="text-decoration: none; color: #333; font-weight: bold; font-size: 18px; padding: 10px 15px; display: inline-block; width: 90%; border-radius: 5px; background-color: #fff; transition: background 0.3s;">
                                    All Categories
                                </a>
                            </li>
                            <?php
                            $categoryQuery = "SELECT * FROM category";
                            $categoryResult = $conn->query($categoryQuery);
                            while ($categoryRow = $categoryResult->fetch_assoc()) {
                                echo "<li style='margin: 10px 0; text-align: center;'><a href=\"javascript:void(0)\" onclick=\"filterProducts('" . $categoryRow['category_id'] . "')\" style=\"text-decoration: none; color: #333; font-size: 18px; padding: 10px 15px; display: inline-block; width: 90%; border-radius: 5px; background-color: #fff; transition: background 0.3s;\">" . htmlspecialchars($categoryRow['category_name']) . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <hr>
                    <div id="categoryMenu" style="border-radius: 8px; padding: 10px 0; background-color: #f9f9f9;">
                        <ul style="list-style: none; padding-left: 0; margin: 0;">
                            <li style="margin: 10px 0; text-align: center;">
                                <a href="/online_ordering/bookings.php" target="_blank"
                                    style="text-decoration: none; color: #333; font-weight: bold; font-size: 18px; padding: 10px 15px; display: inline-block; width: 90%; border-radius: 5px; background-color: #fff; transition: background 0.3s;">
                                    Bookings
                                </a>
                            </li>
                            <!-- </?php
                            $categoryQuery = "SELECT * FROM category";
                            $categoryResult = $conn->query($categoryQuery);
                            while ($categoryRow = $categoryResult->fetch_assoc()) {
                                echo "<li style='margin: 10px 0; text-align: center;'><a href=\"javascript:void(0)\" onclick=\"filterProducts('" . $categoryRow['category_id'] . "')\" style=\"text-decoration: none; color: #333; font-size: 18px; padding: 10px 15px; display: inline-block; width: 90%; border-radius: 5px; background-color: #fff; transition: background 0.3s;\">" . htmlspecialchars($categoryRow['category_name']) . "</a></li>";
                            }
                            ?> -->
                        </ul>
                    </div>
                </div>

                <div class="col-md-9 col-sm-8 col-xs-7 special-product">

                    <!-- Dropdown to select a product -->
                    <!-- <div class="search-bar">
                        <select id="productDropdown" class="form-control d-none d-md-block">
                            <option value="">Search Product</option>
                            </?php
                            include '../../connections/connections.php';

                            // Query to get all categories
                            $categoryQuery = "SELECT * FROM category";
                            $categoryResult = $conn->query($categoryQuery);

                            // Loop through categories
                            while ($categoryRow = $categoryResult->fetch_assoc()) {
                                $category_id = $categoryRow['category_id'];
                                $category_name = htmlspecialchars($categoryRow['category_name']);

                                echo "<optgroup label=\"$category_name\">";

                                // Query to get products based on category
                                $productQuery = "SELECT * FROM product WHERE category_id = '$category_id'";
                                $productResult = $conn->query($productQuery);

                                // Loop through products and add them to the dropdown
                                while ($productRow = $productResult->fetch_assoc()) {
                                    $product_id = $productRow['product_id'];
                                    $product_name = htmlspecialchars($productRow['product_name']);
                                    echo "<option value=\"$product_id\" data-category-id=\"$category_id\">$product_name</option>";
                                }

                                echo "</optgroup>";
                            }
                            ?>
                        </select>
                    </div>

                    <div id="filteredProducts"></div> -->

                    <div class="search-bar">
                        <input type="text" id="searchInput" class="form-control d-none d-md-block" placeholder="Search products..." autocomplete="off">
                        <div id="searchResults" class="dropdown-menu"></div>
                    </div>

                    <?php
                    $categoryQuery = "SELECT * FROM category";
                    $categoryResult = $conn->query($categoryQuery);
                    while ($categoryRow = $categoryResult->fetch_assoc()) {
                        $category_id = $categoryRow['category_id'];
                        $category_name = htmlspecialchars($categoryRow['category_name']);
                        $productQuery = "SELECT * FROM product WHERE category_id = '$category_id'";
                        $productResult = $conn->query($productQuery);

                        if ($productResult->num_rows > 0) {
                            echo "<div class='category-products' data-category-id='$category_id'>";
                            echo "<h3 style='font-size: 2rem; color: #800000; margin-top: 30px;'>$category_name:</h3>";
                            echo "<div class='row'>";

                            while ($row = $productResult->fetch_assoc()) {
                                $product_image = basename($row['product_image']);
                                $image_url = './uploads/' . $product_image;
                    ?>
                                <div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom: 2rem;">
                                    <div class="product-item"
                                        style="display: flex; flex-direction: column; padding-bottom: 1rem; border: 1px solid #ddd; border-radius: 10px; position: relative; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: transform 0.3s; overflow: hidden;">
                                        <div class="pi-img-wrapper" style="text-align: center; position: relative;">
                                            <img src="<?php echo $image_url; ?>" class="img-responsive"
                                                alt="<?php echo htmlspecialchars($row['product_name']); ?>"
                                                style="width: 100%; height: auto; border-radius: 8px; transition: transform 0.3s;">
                                        </div>
                                        <h3 style="text-align: center; color: #333; font-size: 1.8rem; font-weight: bold;">
                                            <?php echo htmlspecialchars($row['product_name']); ?>
                                        </h3>
                                        <div class="pi-price" style="text-align: center; color: #2E8B57; font-size: 1.5rem;">
                                            ₱<?php echo number_format($row['product_sellingprice'], 2); ?>
                                        </div>
                                        <hr>

                                        <!-- <div class="pi-price" style="text-align: center; color: #2E8B57; font-size: 1.5rem;">
                                            Stocks: </?php echo $row['product_stocks']; ?>
                                        </div> -->

                                        <br>
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-default add-to-cart add2cart"
                                            data-product-id="<?php echo $row['product_id']; ?>"
                                            style="position: absolute; bottom: 1rem; left: 50%; transform: translateX(-50%); width: 90%; text-align: center; padding: 0.5rem 0; background-color: #4682B4; color: #fff; font-weight: bold; border-radius: 5px; transition: background-color 0.3s;">
                                            Add to Order
                                        </a>
                                    </div>
                                </div>
                    <?php
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
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
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<!-- Add Toastify CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<!-- COPY THESE WHOLE CODE WHEN IMPORT SELECT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />



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
    // AJAX for Search Bar using jQuery
    $('#searchInput').on('input', function() {
        const query = $(this).val().trim();
        if (query.length > 0) {
            $.ajax({
                type: 'POST',
                url: '/online_ordering/controllers/users/search_products.php',
                data: {
                    query: query
                },
                success: function(response) {
                    $('#searchResults').html(response).addClass('show');
                }
            });
        } else {
            $('#searchResults').removeClass('show');
        }
    });

    // Hide search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchInput, #searchResults').length) {
            $('#searchResults').removeClass('show');
        }
    });

    $(document).ready(function() {
        // Initialize Selectize for the product dropdown
        $('#productDropdown').selectize({
            placeholder: 'Search Product...', // Placeholder text
            allowEmptyOption: true, // Allow blank selection
            onInitialize: function() { // Clear the selection on init
                this.clear(true);
            }
        });
    });

    function filterProducts(categoryId) {
        document.querySelectorAll('.category-products').forEach(categoryProducts => {
            categoryProducts.style.display = categoryProducts.getAttribute('data-category-id') === categoryId || categoryId === '' ? 'block' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', () => filterProducts(''));


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
        $('#categorySelect').change(function() {
            var categoryId = $(this).val();
            fetchProducts(categoryId);
            // fetchSpecialProducts(categoryId);
        });

        // Function to fetch regular products based on selected category
        function fetchProducts(categoryId) {
            $.ajax({
                url: '/online_ordering/controllers/users/fetch_products_process.php',
                type: 'GET',
                data: {
                    category_id: categoryId
                },
                success: function(data) {
                    $('#allProducts .row').html(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching products:", error);
                }
            });
        }

        $('.add-to-cart').click(function() {
            var productId = $(this).data('product-id');
            var $button = $(this);
            var quantityInput = $button.closest('.product-item').find('.cart_quantity');
            var quantity = parseInt(quantityInput.val()) || 1; // Default to 1 if no valid quantity

            // Make AJAX call to add_cart_process.php
            $.ajax({
                url: '/online_ordering/controllers/users/add_cart_process.php',
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
</script>

<script>
    $(document).ready(function() {
        // When the dropdown selection changes
        $('#productDropdown').change(function() {
            // Get the selected product ID
            var selectedProductId = $(this).val();

            // If no product is selected, hide the product list
            if (selectedProductId === "") {
                $('#filteredProducts').html('');
                return;
            }

            // Make an AJAX request to fetch the filtered products
            $.ajax({
                url: 'filter_products.php', // PHP file that will handle the filtering logic
                type: 'GET',
                data: {
                    product_id: selectedProductId
                },
                success: function(response) {
                    // Display the filtered products
                    $('#filteredProducts').html(response);
                }
            });
        });
    });
</script>