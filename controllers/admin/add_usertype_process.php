<?php
include '../../connections/connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize POST data
    $user_type_name = isset($_POST['user_type_name']) ? $conn->real_escape_string($_POST['user_type_name']) : '';
    $dashboard_module = isset($_POST['dashboard_module']) ? $conn->real_escape_string($_POST['dashboard_module']) : '';
    $inventory_module = isset($_POST['inventory_module']) ? $conn->real_escape_string($_POST['inventory_module']) : '';

    $user_module = isset($_POST['user_module']) ? $conn->real_escape_string($_POST['user_module']) : '';
    $reports_module = isset($_POST['reports_module']) ? $conn->real_escape_string($_POST['reports_module']) : '';
    $po_module = isset($_POST['po_module']) ? $conn->real_escape_string($_POST['po_module']) : '';
    $transaction_module = isset($_POST['transaction_module']) ? $conn->real_escape_string($_POST['transaction_module']) : '';
    $orders_module = isset($_POST['orders_module']) ? $conn->real_escape_string($_POST['orders_module']) : '';
    $deliveries_module = isset($_POST['deliveries_module']) ? $conn->real_escape_string($_POST['deliveries_module']) : '';

    // Check if any field is empty
    if (empty($user_type_name)) {
        $response = array('success' => false, 'message' => 'User Type Name is required.');
        echo json_encode($response);
        exit();
    }

    // Check if user type already exists
    $sql = "SELECT * FROM usertype WHERE user_type_name = '$user_type_name'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $response = array('success' => false, 'message' => 'User Type already exists.');
        echo json_encode($response);
        exit();
    }

    // Insert the new user type into the database
    $sql = "INSERT INTO usertype 
            (user_type_name, inventory_module, user_module, reports_module, po_module, 
             transaction_module, orders_module, deliveries_module, dashboard_module)
            VALUES 
            ('$user_type_name', '$inventory_module', '$user_module', '$reports_module', '$po_module', 
             '$transaction_module', '$orders_module', '$deliveries_module', '$dashboard_module')";

    if (mysqli_query($conn, $sql)) {
        $response = array('success' => true, 'message' => 'User Type added successfully.');
    } else {
        $response = array('success' => false, 'message' => 'Failed to add. Please try again.');
    }

    echo json_encode($response);
    exit();
}
