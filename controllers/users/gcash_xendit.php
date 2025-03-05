<?php
// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
  exit;
}

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Your Xendit API Key Live
$apiKey = "xnd_production_dqxeofsDj9XByj0IqB1lB7iWZ8COfk0GoVgoWlRHM43F3AD8zeBmLF3f3EgX";

// API KEY FOR TEST MODE
// $apiKey = "xnd_development_qJhz7tuhEvlfKgnHmbeS3zP6pLCl9GoKZMNrX8gE2tcc6v7j3U7aSUkCI1bb";

// Generate a unique reference ID
$referenceId = "order-id-" . uniqid();

// Read the incoming JSON data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
  echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
  exit;
}

session_start();

$amount = $input['amount'];
$user_id = $_SESSION['user_id'];
$paymentMethod = "GCash";
$referenceNo = strtoupper(bin2hex(random_bytes(3)));

$data = [
  "reference_id" => $referenceId,
  "currency" => "PHP",
  "amount" => $amount,
  "checkout_method" => "ONE_TIME_PAYMENT",
  "channel_code" => "PH_GCASH",
  "channel_properties" => [
    "success_redirect_url" => "http://localhost/online_ordering/thankyou_payment.php",
    "failure_redirect_url" => "http://localhost/online_ordering/sorry.php"
  ]
];

$ch = curl_init('https://api.xendit.co/ewallets/charges');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['actions']['desktop_web_checkout_url']) || isset($result['actions']['mobile_web_checkout_url'])) {
  $paymentUrl = isset($result['actions']['desktop_web_checkout_url']) ? $result['actions']['desktop_web_checkout_url'] : $result['actions']['mobile_web_checkout_url'];
  echo json_encode(['success' => true, 'payment_url' => $paymentUrl, 'reference_id' => $referenceId]);
} else {
  echo json_encode(['success' => false, 'message' => 'Payment request failed.']);
}
