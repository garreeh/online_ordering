<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header("Location: /online_ordering/index.php");
  exit();
}

?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Page Heading -->
  <h1 class="h3 mb-0 text-gray-800">
    <?php echo "Name: " . $_SESSION['user_fullname']; ?>
  </h1>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter" id="notificationCount">0</span>
      </a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Notifications Center
        </h6>
        <div id="notificationList">
          <!-- Notifications will be populated here -->
        </div>
      </div>
    </li>
  </ul>
</nav>

<script>
  // 🔄 GLOBAL FUNCTION: Call this from anywhere
  function fetchNotifications() {
    $.ajax({
      url: '/online_ordering/controllers/admin/get_latest_notification.php', // your endpoint
      type: 'POST',
      success: function(response) {
        // console.log('Fetch Notifications Response:', response); // Debugging the response

        const data = JSON.parse(response);

        if (data.status === 'success') {
          const notifications = data.notifications;
          const notificationCount = notifications.length;

          // Update notification badge
          $('#notificationCount').text(notificationCount);

          // Update dropdown list
          if (notificationCount > 0) {
            let html = '';
            notifications.forEach(function(note) {
              html += `
                <a class="dropdown-item d-flex align-items-center" href="orders_module.php">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">${note.created_at}</div>
                    <span class="font-weight-bold">Order #${note.cart_id} is processing</span>
                  </div>
                </a>
              `;
            });

            $('#notificationList').html(html);
          } else {
            $('#notificationList').html('<a class="dropdown-item text-center small text-gray-500">No new notifications</a>');
          }
        } else {
          console.error('Error fetching notifications');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX error:', error);
      }
    });
  }

  // 🔁 INITIAL CALL ON PAGE LOAD
  $(document).ready(function() {
    fetchNotifications();
  });
</script>