<?php
session_start();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Your Xendit API Key Live
$apiKey = "xnd_production_dqxeofsDj9XByj0IqB1lB7iWZ8COfk0GoVgoWlRHM43F3AD8zeBmLF3f3EgX";

// API KEY FOR TEST MODE
// $apiKey = "xnd_development_qJhz7tuhEvlfKgnHmbeS3zP6pLCl9GoKZMNrX8gE2tcc6v7j3U7aSUkCI1bb";

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !isset($input['reference_id'])) {
  echo json_encode(['success' => false, 'message' => 'Invalid request']);
  exit;
}

$user_id = $_SESSION['user_id'];
$referenceId = $input['reference_id'];
$paymentMethod = "GCash";
// $referenceNo = strtoupper(bin2hex(random_bytes(3)));

// Get payment status from Xendit
$ch = curl_init("https://api.xendit.co/ewallets/charges/$referenceId");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":");

$response = curl_exec($ch);
curl_close($ch);

include './../../connections/connections.php';

$updateCartSql = "UPDATE cart SET cart_status = 'Processing', reference_no = '$referenceId', payment_method = '$paymentMethod' WHERE user_id = '$user_id' AND cart_status = 'Cart'";
mysqli_query($conn, $updateCartSql);

echo json_encode(['success' => true]);
