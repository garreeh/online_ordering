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
		'db' => 'product_name',
		'dt' => 1,
		'field' => 'product_name',
		'formatter' => function ($lab1, $row) {
			return $row['product_name'];
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
		'db' => 'cart.updated_at',
		'dt' => 6,
		'field' => 'updated_at',
		'formatter' => function ($lab5, $row) {
			return $row['updated_at'];
		}
	),

	array(
		'db' => 'cart_id',
		'dt' => 7,
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
);

// Database connection details
include '../../connections/ssp_connection.php';


// Include the SSP class
require('../../assets/datatables/ssp.class.php');


// THIS IS A SAMPLE ONLY
$where = "cart_status = 'Processing' AND (cart_type IS NULL OR cart_type = '')";

// echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));

$joinQuery = "FROM $table LEFT JOIN users ON $table.user_id = users.user_id
              LEFT JOIN product ON $table.product_id = product.product_id";

// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));
