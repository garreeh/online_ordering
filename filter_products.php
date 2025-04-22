<?php
include './connections/connections.php';

// Check if a product ID is passed via the AJAX request
if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];

  // Query to fetch the specific product based on selected product_id
  $productQuery = "SELECT * FROM product WHERE product_id = '$product_id'";
  $productResult = $conn->query($productQuery);

  // Check if products are found
  if ($productResult->num_rows > 0) {
    // Loop through the products and display each
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
          <a href="javascript:void(0)" class="btn btn-default add-to-cart add2cart"
            data-product-id="<?php echo $row['product_id']; ?>"
            style="position: absolute; bottom: 1rem; left: 50%; transform: translateX(-50%); width: 90%; text-align: center; padding: 0.5rem 0; background-color: #4682B4; color: #fff; font-weight: bold; border-radius: 5px; transition: background-color 0.3s;">
            Add to Order
          </a>
        </div>
      </div>
<?php
    }
  } else {
    // If no products found
    echo "<p>No products found.</p>";
  }
}
?>