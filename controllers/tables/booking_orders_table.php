<?php

// Define table and primary key
$table = 'cart';
$primaryKey = 'cart_id';
// Define columns for DataTables
$columns = array(
  array(
    'db' => 'cart_id',
    'dt' => 0,
    'field' => 'cart_id',
    'formatter' => function ($lab1, $row) {
      return $row['cart_id'];
    }
  ),

  array(
    'db' => 'reference_no',
    'dt' => 1,
    'field' => 'reference_no',
    'formatter' => function ($lab1, $row) {
      return $row['reference_no'];
    }
  ),

  array(
    'db' => 'users.user_fullname',
    'dt' => 2,
    'field' => 'user_fullname',
    'formatter' => function ($lab2, $row) {
      return $row['user_fullname'];
    }
  ),

  array(
    'db' => 'cart_status',
    'dt' => 3,
    'field' => 'cart_status',
    'formatter' => function ($lab3, $row) {
      return $row['cart_status'];
    }
  ),

  array(
    'db' => 'total_price',
    'dt' => 4,
    'field' => 'total_price',
    'formatter' => function ($lab4, $row) {
      return $row['total_price'];
    }
  ),

  array(
    'db' => 'payment_method',
    'dt' => 5,
    'field' => 'payment_method',
    'formatter' => function ($lab4, $row) {
      return $row['payment_method'];
    }
  ),

  array(
    'db' => 'proof_of_payment',
    'dt' => 6,
    'field' => 'proof_of_payment',
    'formatter' => function ($lab4, $row) {
      // Check if the value is null or empty
      if (empty($lab4)) {
        return 'COD';
      } else {
        return '<a class="ProofData" href="#"> View Image</a>';
      }
    }
  ),

  array(
    'db' => 'time',
    'dt' => 7,
    'field' => 'time',
    'formatter' => function ($d, $row) {
      $time = DateTime::createFromFormat('H:i:s', $row['time']);
      $date = DateTime::createFromFormat('Y-m-d', $row['date']);

      $formattedDate = $date ? $date->format('M j, Y') : $row['date'];

      if ($row['time'] === '08:00:00') {
        return '8:00am - 12:00pm' . ' | ' . $formattedDate;
      } elseif ($row['time'] === '12:00:00') {
        return '12:00pm - 5:00pm' . ' | ' . $formattedDate;
      } else {
        $formattedTime = $time ? $time->format('g:iA') : $row['time'];
        return $formattedTime . ' - ' . $formattedDate;
      }
    }
  ),




  array(
    'db' => 'cart_id',
    'dt' => 8,
    'field' => 'cart_id',
    'formatter' => function ($lab5, $row) {
      return '
      <div class="dropdown">
          <button class="btn btn-info" type="button" id="dropdownMenuButton' . $row['cart_id'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              &#x22EE;
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row['cart_id'] . '">
              <a class="dropdown-item fetchDataDelivery" href="#">Assign Delivery</a>

          </div>
      </div>';
    }
  ),

  array(
    'db' => 'date',
    'dt' => 9,
    'field' => 'date',
    'formatter' => function ($d, $row) {
      $date = DateTime::createFromFormat('Y-m-d', $row['date']);
      return $date ? $date->format('F j, Y') : $row['date'];
    }
  ),
);

// Database connection details
include '../../connections/ssp_connection.php';


// Include the SSP class
require('../../assets/datatables/ssp.class.php');


// THIS IS A SAMPLE ONLY
$where = "cart_status = 'Processing' AND cart_type = 'Booking'";

// Fetch and encode ONLY WHERE
// echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));

$joinQuery = "FROM $table LEFT JOIN users ON $table.user_id = users.user_id";

// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));
