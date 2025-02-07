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
$referenceNo = strtoupper(bin2hex(random_bytes(3)));

mysqli_begin_transaction($conn);

try {

    $updateCartSql = "UPDATE cart SET cart_status = 'Processing', reference_no = '$referenceNo', payment_method = '$paymentMethod' 
                      WHERE user_id = '$user_id' AND cart_status = 'Cart'";

    if (!mysqli_query($conn, $updateCartSql)) {
        throw new Exception('Failed to update cart status for all items');
    }

    mysqli_commit($conn);

    $response['success'] = true;
    $response['message'] = 'Checkout successful for all items in the cart';

} catch (Exception $e) {
    mysqli_rollback($conn);
    $response['message'] = $e->getMessage();
}

// Output the JSON response
echo json_encode($response);
?>