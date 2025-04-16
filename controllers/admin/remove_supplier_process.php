<?php

include '../../connections/connections.php';


// Check for removed variations
if (isset($_POST['remove_supplier_multi_id'])) {
  $removed_supplier_multi_ids = $_POST['remove_supplier_multi_id'];
  foreach ($removed_supplier_multi_ids as $remove_id) {
    $remove_id = $conn->real_escape_string($remove_id);
    // Remove variation from DB and unlink it if it exists
    $sql_remove_variation = "DELETE FROM `multiple_supplier` WHERE supplier_multi_id='$remove_id'";
    mysqli_query($conn, $sql_remove_variation);
  }
  echo json_encode(['success' => true, 'message' => 'Variation(s) removed successfully!']);
  exit();
}

echo json_encode($response);
exit();
