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

    // Get the selling price of the product (removed stock check)
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

    // Check if the product is in the cart with status 'Cart'
    $cart_query = "SELECT cart_quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND cart_status = 'Cart'";
    $cart_result = $conn->query($cart_query);

    if ($cart_result->num_rows > 0) {
        // Product is already in the cart, update the quantity
        $cart_row = $cart_result->fetch_assoc();
        $new_quantity = $cart_row['cart_quantity'] + $cart_quantity;
        $total_price = $new_quantity * $product_price;

        // Update the quantity and total price in the cart
        $update_query = "UPDATE cart SET cart_quantity = '$new_quantity', total_price = '$total_price' WHERE user_id = '$user_id' AND product_id = '$product_id' AND cart_status = 'Cart'";
        if ($conn->query($update_query)) {
            $response = array('success' => true, 'message' => 'Cart updated successfully!');
        } else {
            $response = array('success' => false, 'message' => 'Error updating cart: ' . $conn->error);
        }
    } else {
        // Product is not in the cart, add it
        $total_price = $cart_quantity * $product_price;
        $insert_query = "INSERT INTO cart (user_id, product_id, cart_quantity, total_price, cart_status) VALUES ('$user_id', '$product_id', $cart_quantity, '$total_price', 'Cart')";

        if ($conn->query($insert_query)) {
            $response = array('success' => true, 'message' => 'Product added to cart successfully!');
        } else {
            $response = array('success' => false, 'message' => 'Error adding product to cart: ' . $conn->error);
        }
    }

    echo json_encode($response);
    exit();
} else {
    $response = array('success' => false, 'message' => 'No product ID provided.');
    echo json_encode($response);
    exit();
}
