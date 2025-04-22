<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
  exit();
}

include './../../connections/connections.php';

// Fetch notifications (orders with cart_status = 'Processing')
$notifications = [];
$sql = "SELECT * FROM cart WHERE cart_status = 'Processing' ORDER BY created_at DESC LIMIT 5"; // assuming you have a created_at column
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $notifications[] = $row;
  }
}

echo json_encode(['status' => 'success', 'notifications' => $notifications]);
