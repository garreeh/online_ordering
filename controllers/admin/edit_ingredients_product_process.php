<?php

include '../../connections/connections.php';

if (isset($_POST['edit_product'])) {

  $response = array('success' => false, 'message' => '');
  $product_id = $conn->real_escape_string($_POST['product_id']);


  $product_name = $conn->real_escape_string($_POST['product_name']);
  $product_sku = $conn->real_escape_string($_POST['product_sku']);
  $category_id = $conn->real_escape_string($_POST['category_id']);


  // Update SQL query with full path
  $sql = "UPDATE ingredients_product SET 
            product_name='$product_name', product_sku='$product_sku',
            category_id='$category_id'
            WHERE product_id='$product_id'";

  if (mysqli_query($conn, $sql)) {

    if (isset($_POST['supplier_multi_name'])) {
      $supplier_names = $_POST['supplier_multi_name'];

      $supplier_multi_ids = isset($_POST['supplier_multi_id']) ? $_POST['supplier_multi_id'] : [];

      foreach ($supplier_names as $index => $supplier_name) {
        $current_supplier_id = isset($supplier_multi_ids[$index]) ? $supplier_multi_ids[$index] : null;
        $supplier_name = $conn->real_escape_string($supplier_name);

        if ($current_supplier_id) {
          // Update existing supplier
          $sql_variation = "UPDATE `multiple_supplier` SET `supplier_multi_name`='$supplier_name' WHERE supplier_multi_id='$current_supplier_id'";
        } else {
          // Insert new supplier
          $sql_variation = "INSERT INTO `multiple_supplier` (product_id, `supplier_multi_name`) VALUES ('$product_id', '$supplier_name')";
        }

        mysqli_query($conn, $sql_variation);
      }
    }

    $response['success'] = true;
    $response['message'] = 'Ingredient updated successfully!';
  } else {
    $response['message'] = 'Error updating Ingredient: ' . mysqli_error($conn);
  }

  echo json_encode($response);
  exit();
}
