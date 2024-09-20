<?php
include './../../connections/connections.php';

session_start();

$response = array('success' => false, 'message' => '');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];
$paymentMethod = $_POST['paymentCategory'];
$referenceNo = strtoupper(bin2hex(random_bytes(3))); // Generate a 6-digit random reference number

// Handle file upload
$proofOfPaymentPath = null;
if ($paymentMethod === 'GCash' && isset($_FILES['proofOfPayment']) && $_FILES['proofOfPayment']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../uploads/payments/';
    $uploadFile = $uploadDir . basename($_FILES['proofOfPayment']['name']);
    
    // Check if directory exists and is writable
    if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
        $response['message'] = 'Upload directory not writable';
        echo json_encode($response);
        exit;
    }

    if (move_uploaded_file($_FILES['proofOfPayment']['tmp_name'], $uploadFile)) {
        $proofOfPaymentPath = $uploadFile;
    } else {
        $response['message'] = 'Failed to upload file';
        echo json_encode($response);
        exit;
    }
}

// Start a transaction to ensure data integrity
mysqli_begin_transaction($conn);

try {
    // Update cart status
    $updateCartSql = "UPDATE cart SET cart_status = 'Processing', reference_no = '$referenceNo', payment_method = '$paymentMethod' WHERE user_id = '$user_id'";
    if (!mysqli_query($conn, $updateCartSql)) {
        throw new Exception('Failed to update cart status');
    }

    // Save the path of the proof of payment if available
    if ($proofOfPaymentPath) {
        $updateProofSql = "UPDATE cart SET proof_of_payment = '$proofOfPaymentPath' WHERE user_id = '$user_id'";
        if (!mysqli_query($conn, $updateProofSql)) {
            throw new Exception('Failed to update proof of payment');
        }
    }

    // Retrieve cart items for stock update
    $cartItemsSql = "SELECT product_id, cart_quantity FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $cartItemsSql);
    if (!$result) {
        throw new Exception('Failed to retrieve cart items');
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $cart_quantity = $row['cart_quantity'];

        // Update product stocks
        $updateProductSql = "UPDATE product SET product_stocks = product_stocks - $cart_quantity WHERE product_id = '$product_id'";
        if (!mysqli_query($conn, $updateProductSql)) {
            throw new Exception('Failed to update product stocks');
        }

        // Check if product stocks are 0
        $checkStockSql = "SELECT product_stocks FROM product WHERE product_id = '$product_id'";
        $stockResult = mysqli_query($conn, $checkStockSql);
        if ($stockResult) {
            $stockRow = mysqli_fetch_assoc($stockResult);
            if ($stockRow['product_stocks'] <= 0) {
                // Remove cart items for other users
                $deleteCartSql = "DELETE FROM cart WHERE product_id = '$product_id' AND user_id != '$user_id'";
                if (!mysqli_query($conn, $deleteCartSql)) {
                    throw new Exception('Failed to remove cart items for other users');
                }
            }
        } else {
            throw new Exception('Failed to check product stocks');
        }
    }

    // Commit the transaction
    mysqli_commit($conn);

    // Success response
    $response['success'] = true;
    $response['message'] = 'Checkout successful';

} catch (Exception $e) {
    // Rollback the transaction on error
    mysqli_rollback($conn);
    $response['message'] = $e->getMessage();
}

// Output the JSON response
echo json_encode($response);
?>
