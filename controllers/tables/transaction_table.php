<?php

// Define table and primary key
$table = 'billing';
$primaryKey = 'billing_id';
// Define columns for DataTables
$columns = array(
	array(
		'db' => 'billing_id',
		'dt' => 0,
		'field' =>'billing_id',
		'formatter' => function ($lab1, $row) {
      return $row['billing_id'];
		}
	),

	array(
		'db' => 'users.user_fullname',
		'dt' => 1,
		'field' => 'user_fullname',
		'formatter' => function ($lab2, $row) {
			return $row['user_fullname'];
		}
	),

	array(
		'db' => 'total_less_discount',
		'dt' => 2,
		'field' => 'total_less_discount',
		'formatter' => function ($lab3, $row) {
			return $row['total_less_discount'];

		}
	),

	array(
		'db' => 'payment_status',
		'dt' => 3,
		'field' => 'payment_status',
		'formatter' => function ($lab4, $row) {
      return $row['payment_status'];
		}
	),


	array(
    'db' => 'billing.created_at',
    'dt' => 4,
    'field' => 'created_at',
    'formatter' => function ($lab5, $row) {
			return $row['created_at'];
    }
	),


);

// Database connection details
$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db' => 'ecommerce',
	'host' => 'localhost',
);

// Include the SSP class
require('../../assets/datatables/ssp.class.php');


// THIS IS A SAMPLE ONLY
$where = "billing_id > 0";

// Fetch and encode ONLY WHERE
// echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));

$joinQuery = "FROM $table LEFT JOIN users ON $table.user_id = users.user_id";

// Fetch and encode JOIN AND WHERE
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where));


?>