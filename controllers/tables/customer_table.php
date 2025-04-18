<?php

// Define table and primary key
$table = 'users';
$primaryKey = 'user_id';
// Define columns for DataTables
$columns = array(
    array(
        'db' => 'user_id',
        'dt' => 0,
        'field' => 'user_id',
        'formatter' => function ($lab1, $row) {
            return $row['user_id'];
        }
    ),
    array(
        'db' => 'user_fullname',
        'dt' => 1,
        'field' => 'user_fullname',
        'formatter' => function ($lab2, $row) {
            return $row['user_fullname'];
        }
    ),

    array(
        'db' => 'username',
        'dt' => 2,
        'field' => 'username',
        'formatter' => function ($lab3, $row) {
            return $row['username'];
        }
    ),

    array(
        'db' => 'user_email',
        'dt' => 3,
        'field' => 'user_email',
        'formatter' => function ($lab3, $row) {
            return $row['user_email'];
        }
    ),

    // array(
    //     'db' => 'user_confirm_password',
    //     'dt' => 4,
    //     'field' => 'user_confirm_password',
    //     'formatter' => function ($lab4, $row) {
    //         // $password = $row['user_confirm_password'];
    //         // $color = '#FFCCCB'; // Light Red
    //         // $width = '70px'; // Adjust the value as needed
    //         // $height = '30px'; // Adjust the value as needed
    //         // $border_radius = '10px'; // Adjust the value as needed
    //         // return '<span style="display: inline-block; background-color: ' . $color . '; width: ' . $width . '; height: ' . $height . '; border-radius: ' . $border_radius . '; text-align: center; line-height: ' . $height . ';">' . $password . '</span>';

    //         return '<a class="fetchDataPassword" href="#"> Click to View</a> ';
    //     }
    // ),
    array(
        'db' => 'account_status',
        'dt' => 4,
        'field' => 'account_status',
        'formatter' => function ($lab5, $row) {
            $account_status = $row['account_status'];
            $color = '#90EE90'; // Light Red
            $width = '70px'; // Adjust the value as needed
            $height = '30px'; // Adjust the value as needed
            $border_radius = '10px'; // Adjust the value as needed
            return '<span style="display: inline-block; background-color: ' . $color . '; width: ' . $width . '; height: ' . $height . '; border-radius: ' . $border_radius . '; text-align: center; line-height: ' . $height . ';">' . $account_status . '</span>';
        }
    ),
    array(
        'db' => 'user_address',
        'dt' => 5,
        'field' => 'user_address',
        'formatter' => function ($lab5, $row) {
            return $row['user_address'];
        }
    ),

    array(
        'db' => 'user_contact',
        'dt' => 6,
        'field' => 'user_contact',
        'formatter' => function ($lab5, $row) {
            return $row['user_contact'];
        }
    ),

);

// Database connection details
include '../../connections/ssp_connection.php';


// Include the SSP class
require('../../assets/datatables/ssp.class_with_where.php');

// Define where clause if needed
$where = "is_admin = '0'";

// Fetch and encode data
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where));
