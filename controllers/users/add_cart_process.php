<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // Redirect to login page
  $response = array('success' => false, 'message' => 'You are not logged in.');
  echo json_encode($response);
  exit();
}

include '../../connections/connections.php';

if (isset($_POST['product_id'])) {
    // Get the product_id from the POST request and user_id from the session
    $product_id = $conn->real_escape_string($_POST['product_id']);
    $user_id = $_SESSION['user_id']; // Get the user_id from session

    // Construct SQL query to insert both user_id and product_id into the cart table
    $sql = "INSERT INTO cart (user_id, product_id) 
            VALUES ('$user_id', '$product_id')";

    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'Product added to cart successfully!');
    } else {
        $response = array('success' => false, 'message' => 'Error adding product to cart: ' . mysqli_error($conn));
    }

    echo json_encode($response);
    exit();
} else {
    $response = array('success' => false, 'message' => 'No product ID provided.');
    echo json_encode($response);
    exit();
}
?>
