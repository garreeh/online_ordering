<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // User not logged in
  $response = array('success' => false, 'message' => 'You are not logged in.');
  echo json_encode($response);
  exit();
}

include '../../connections/connections.php';

if (isset($_POST['product_id']) && isset($_POST['cart_quantity'])) {
  // Get product_id from POST request and user_id from session
  $product_id = $conn->real_escape_string($_POST['product_id']);
  $user_id = $_SESSION['user_id'];
  $cart_quantity = (int) $_POST['cart_quantity']; // Get the quantity from the POST data
  $selected_time = $conn->real_escape_string($_POST['selected_time']); // Get selected time
  $selected_date = $conn->real_escape_string($_POST['selected_date']); // Get selected date

  // Check if the same user has already booked the same product, time, and date
  $check_query = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND `time` = '$selected_time' AND `date` = '$selected_date'";
  $check_result = $conn->query($check_query);

  if ($check_result->num_rows > 0) {
    $response = array('success' => false, 'message' => 'You have already booked this product for the selected date and time.');
    echo json_encode($response);
    exit();
  }

  // Get the selling price of the product
  $product_query = "SELECT product_sellingprice FROM product WHERE product_id = '$product_id'";
  $product_result = $conn->query($product_query);

  if ($product_result->num_rows > 0) {
    $product_row = $product_result->fetch_assoc();
    $product_price = $product_row['product_sellingprice'];
  } else {
    $response = array('success' => false, 'message' => 'Product not found.');
    echo json_encode($response);
    exit();
  }

  // Insert new cart entry
  $total_price = $cart_quantity * $product_price;
  $insert_query = "INSERT INTO cart (user_id, product_id, cart_quantity, total_price, cart_status, cart_type, `time`, `date`) 
                   VALUES ('$user_id', '$product_id', $cart_quantity, '$total_price', 'Cart', 'Booking', '$selected_time', '$selected_date')";

  if ($conn->query($insert_query)) {
    $response = array('success' => true, 'message' => 'Product added to cart successfully!');
  } else {
    $response = array('success' => false, 'message' => 'Error adding product to cart: ' . $conn->error);
  }

  echo json_encode($response);
  exit();
} else {
  $response = array('success' => false, 'message' => 'No product ID provided.');
  echo json_encode($response);
  exit();
}
