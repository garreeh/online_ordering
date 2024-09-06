<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if the user is not logged in
  header("Location: /online_ordering/views/login.php");
  exit();
}

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== "1") {
  // If the user is not an admin (is_admin is not set or not "1"), redirect to the user dashboard
  header("Location: /online_ordering/index.php"); // Adjust the redirect location as needed
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
</head>

<body id="page-top">
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
      href="/online_ordering/views/admin/admin/admin_dashboard.php">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Ordering <sup>System</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="/online_ordering/views/admin/dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Billing & PO
    </div>
    <li class="nav-item">
      <a class="nav-link" href="/online_ordering/views/admin/transaction_module.php">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Transactions</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/online_ordering/views/admin/purchase_module.php">
      <i class="fas fa-fw fa-cart-plus"></i>
      <span>Purchase Order</span></a>
    </li>

    <!-- <li class="nav-item">
      <a class="nav-link" href="/online_ordering/views/admin/billing_module.php">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Voucher</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Reports, Product & Setup
    </div>

    <!-- Reports Collapse -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
        aria-controls="collapse1">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Reports</span>
      </a>
      <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- <h6 class="collapse-header">Setup:</h6> -->
          <a class="collapse-item" href="/online_ordering/views/admin/supplier_module.php">Sales Report</a>
          <a class="collapse-item" href="/online_ordering/views/admin/supplier_module.php">Voucher Report</a>
          <a class="collapse-item" href="/online_ordering/views/admin/supplier_module.php">Item Category Report</a>
          <a class="collapse-item" href="/online_ordering/views/admin/supplier_module.php">Turnover Report</a>
        </div>
        
      </div>
      
    </li>

    <!-- Products Setup Collapse -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
        aria-controls="collapse2">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Product Setup</span>
      </a>
      <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- <h6 class="collapse-header">Setup:</h6> -->
          <a class="collapse-item" href="/online_ordering/views/admin/supplier_module.php">Suppliers</a>
          <a class="collapse-item" href="/online_ordering/views/admin/category_module.php">Category</a>
          <a class="collapse-item" href="/online_ordering/views/admin/product_module.php">Products</a>
        </div>
        
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
        aria-controls="collapse3">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Delivery</span>
      </a>
      <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- <h6 class="collapse-header">Setup:</h6> -->
          <a class="collapse-item" href="/online_ordering/views/admin/delivery_module.php">Assign Delivery</a>
          <a class="collapse-item" href="/online_ordering/views/admin/category_module.php">Delivery Status</a>
          <a class="collapse-item" href="/online_ordering/views/admin/product_module.php">Delivery History</a>
        </div>
        
      </div>
      
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Settings
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true"
        aria-controls="collapse4">
        <i class="fas fa-fw fa-cogs"></i>
        <span>User</span>
      </a>
      <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- <h6 class="collapse-header">Setup:</h6> -->
          <a class="collapse-item" href="/online_ordering/views/admin/user_type_module.php">Add User Type</a>
          <a class="collapse-item" href="/online_ordering/views/admin/user_module.php">Add User</a>
          <a class="collapse-item" href="/online_ordering/views/admin/customer_module.php">Customers</a>

        </div>
        
      </div>
      
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/online_ordering/views/admin/billing_module.php">
        <i class="fas fa-fw fa-cog"></i>
        <span>Account Setting</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      <a class="nav-link" href="/online_ordering/controllers/logout_process.php">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Sign Out</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
  <!-- End of Sidebar -->
</body>

</html>