<?php
include '../../connections/connections.php';

$response = ["success" => false, "bookedDates" => []];

$query = "SELECT `date`, `time` FROM cart WHERE cart_status = 'Processing'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $date = $row["date"];
    $time = $row["time"];

    if (!isset($response["bookedDates"][$date])) {
      $response["bookedDates"][$date] = [];
    }

    $response["bookedDates"][$date][] = $time;
  }

  $response["success"] = true;
}

echo json_encode($response);
