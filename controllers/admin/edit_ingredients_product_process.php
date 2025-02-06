<?php

include '../../connections/connections.php';

if (isset($_POST['edit_product'])) {

  $response = array('success' => false, 'message' => '');
  $product_id = $conn->real_escape_string($_POST['product_id']);


  $product_name = $conn->real_escape_string($_POST['product_name']);
  $product_sku = $conn->real_escape_string($_POST['product_sku']);
  $category_id = $conn->real_escape_string($_POST['category_id']);
  $supplier_id = $conn->real_escape_string($_POST['supplier_id']);


  // Update SQL query with full path
  $sql = "UPDATE ingredients_product SET 
            product_name='$product_name', product_sku='$product_sku',
            category_id='$category_id', supplier_id='$supplier_id'
            WHERE product_id='$product_id'";

  if (mysqli_query($conn, $sql)) {
    $response['success'] = true;
    $response['message'] = 'Ingredient updated successfully!';
  } else {
    $response['message'] = 'Error updating Ingredient: ' . mysqli_error($conn);
  }

  echo json_encode($response);
  exit();
}
