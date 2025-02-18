<?php
include '../../connections/connections.php';

if (isset($_POST['delete_product']) && isset($_POST['product_id'])) {
  $product_id = $conn->real_escape_string($_POST['product_id']);

  // Construct the DELETE query
  $sql = "DELETE FROM ingredients_product WHERE product_id = '$product_id'";

  // Execute the DELETE query
  if (mysqli_query($conn, $sql)) {
    $response = array('success' => true, 'message' => 'Ingredient deleted successfully!');
  } else {
    $response = array('success' => false, 'message' => 'Error deleting Ingredient: ' . mysqli_error($conn));
  }

  // Return the response as JSON
  echo json_encode($response);
  exit();
} else {
  // Invalid request
  $response = array('success' => false, 'message' => 'Invalid request. Ingredient ID missing.');
  echo json_encode($response);
  exit();
}
