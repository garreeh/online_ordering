<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User not logged in
    $response = array('success' => false, 'message' => 'You are not logged in.');
    echo json_encode($response);
    exit();
}

include '../../connections/connections.php';

if (isset($_POST['product_id'])) {
    // Get product_id from POST request and user_id from session
    $product_id = $conn->real_escape_string($_POST['product_id']);
    $user_id = $_SESSION['user_id'];

    // Get the current stock of the product
    $stock_query = "SELECT product_stocks FROM product WHERE product_id = '$product_id'";
    $stock_result = $conn->query($stock_query);
    
    if ($stock_result->num_rows > 0) {
        $stock_row = $stock_result->fetch_assoc();
        $product_stock = $stock_row['product_stocks'];
    } else {
        $response = array('success' => false, 'message' => 'Product not found.');
        echo json_encode($response);
        exit();
    }

    // Check if the product is already in the cart
    $cart_query = "SELECT cart_quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $cart_result = $conn->query($cart_query);

    if ($cart_result->num_rows > 0) {
        // Product is already in the cart, update the quantity
        $cart_row = $cart_result->fetch_assoc();
        $new_quantity = $cart_row['cart_quantity'] + 1;

        // Check if the new quantity exceeds available stock
        if ($new_quantity > $product_stock) {
            $response = array('success' => false, 'message' => 'Not enough stock available.');
            echo json_encode($response);
            exit();
        }

        // Update the quantity in the cart
        $update_query = "UPDATE cart SET cart_quantity = '$new_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        if ($conn->query($update_query)) {
            $response = array('success' => true, 'message' => 'Cart updated successfully!');
        } else {
            $response = array('success' => false, 'message' => 'Error updating cart: ' . $conn->error);
        }
    } else {
        // Product is not in the cart, add it with quantity 1
        if ($product_stock < 1) {
            $response = array('success' => false, 'message' => 'Not enough stock available.');
            echo json_encode($response);
            exit();
        }

        $insert_query = "INSERT INTO cart (user_id, product_id, cart_quantity) VALUES ('$user_id', '$product_id', 1)";
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
?>
