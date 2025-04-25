<?php

include '../../connections/connections.php';


// Check for removed variations
if (isset($_POST['remove_size_id'])) {
  $removed_variation_ids = $_POST['remove_size_id'];
  foreach ($removed_variation_ids as $remove_id) {
    $remove_id = $conn->real_escape_string($remove_id);
    // Remove variation from DB and unlink it if it exists
    $sql_remove_variation = "DELETE FROM size_booking WHERE size_id = '$remove_id'";
    mysqli_query($conn, $sql_remove_variation);
  }
  echo json_encode(['success' => true, 'message' => 'Size(s) removed successfully!']);
  exit();
}

echo json_encode($response);
exit();
