<?php

include '../../connections/connections.php';

if (isset($_POST['add_product'])) {

  // Initialize response array
  $response = array('success' => false, 'message' => '');

  // Get form data
  $product_name = $conn->real_escape_string($_POST['product_name']);
  $product_sku = $conn->real_escape_string($_POST['product_sku']);
  $supplier_id = $conn->real_escape_string($_POST['supplier_id']);
  $category_id = $conn->real_escape_string($_POST['category_id']);

  // Construct SQL query
  $sql = "INSERT INTO `ingredients_product` (product_name, product_sku, supplier_id, category_id, product_stocks)
            VALUES ('$product_name', '$product_sku', '$supplier_id', '$category_id', '0')";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {
    $response['success'] = true;
    $response['message'] = 'Ingredients Product added successfully!';
  } else {
    $response['message'] = 'Error adding Ingredients product: ' . mysqli_error($conn);
  }

  echo json_encode($response);
  exit();
}
?>