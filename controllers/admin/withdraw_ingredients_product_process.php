<?php

include '../../connections/connections.php';

if (isset($_POST['withdraw_product'])) {

  $response = array('success' => false, 'message' => '');
  $product_id = $conn->real_escape_string($_POST['product_id']);
  $withdraw_quantity = $conn->real_escape_string($_POST['product_stocks']);

  // Fetch the current stock from the database
  $query = "SELECT product_stocks FROM ingredients_product WHERE product_id='$product_id'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $current_stock = $row['product_stocks'];

    // Ensure stock is not reduced below zero
    if ($current_stock >= $withdraw_quantity) {
      $new_stock = $current_stock - $withdraw_quantity;

      // Update the product stock in the database
      $update_sql = "UPDATE ingredients_product SET product_stocks='$new_stock' WHERE product_id='$product_id'";

      if (mysqli_query($conn, $update_sql)) {
        $response['success'] = true;
        $response['message'] = 'Withdraw Ingredient successfully!';
      } else {
        $response['message'] = 'Error updating Ingredient: ' . mysqli_error($conn);
      }
    } else {
      $response['message'] = 'Your input quantity is greater than the available stock!';
    }
  } else {
    $response['message'] = 'Product not found!';
  }

  echo json_encode($response);
  exit();
}
