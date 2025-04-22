<?php
include './../../connections/connections.php';

$response = ['success' => false, 'supplier_names' => ''];

if (isset($_POST['product_id'])) {
  $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

  $sql = "SELECT supplier_multi_name 
          FROM multiple_supplier 
          WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  $names = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $names[] = $row['supplier_multi_name'];
  }

  if (!empty($names)) {
    $response['success'] = true;
    $response['supplier_names'] = implode(', ', $names);
  }
}

echo json_encode($response);
