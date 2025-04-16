<?php

include '../../connections/connections.php';

if (isset($_POST['add_product'])) {

  // Initialize response array
  $response = array('success' => false, 'message' => '');

  // Get form data
  $product_name = $conn->real_escape_string($_POST['product_name']);
  $product_sku = $conn->real_escape_string($_POST['product_sku']);
  // $supplier_id = $conn->real_escape_string($_POST['supplier_id']);
  $category_id = $conn->real_escape_string($_POST['category_id']);

  // Construct SQL query
  $sql = "INSERT INTO `ingredients_product` (product_name, product_sku, category_id, product_stocks)
            VALUES ('$product_name', '$product_sku', '$category_id', '0')";

  // Execute SQL query
  if (mysqli_query($conn, $sql)) {

    $product_id = $conn->insert_id; // Get the last inserted product ID
    $response['success'] = true;
    $response['message'] = 'Product added successfully!';

    if (isset($_POST['supplier_multi_name'])) {
      $supplier_names = $_POST['supplier_multi_name'];

      foreach ($supplier_names as $index => $supplier_multi_name) {
        $supplier_multi_name = $conn->real_escape_string($supplier_multi_name);

        // Insert into variations table
        $sql_supplier = "INSERT INTO `multiple_supplier` (product_id, `supplier_multi_name`)
                              VALUES ('$product_id', '$supplier_multi_name')";
        mysqli_query($conn, $sql_supplier);
      }
    }

    $response['success'] = true;
    $response['message'] = 'Ingredients Product added successfully!';
  } else {
    $response['message'] = 'Error adding Ingredients product: ' . mysqli_error($conn);
  }

  echo json_encode($response);
  exit();
}
