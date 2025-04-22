<?php
include './../../connections/connections.php';

// Fetch all delivery riders and check if they are currently assigned in cart
$sql = "
  SELECT u.user_id, u.user_fullname, 
         CASE WHEN c.delivery_rider_id IS NOT NULL THEN 1 ELSE 0 END AS has_delivery
  FROM users u
  LEFT JOIN cart c ON u.user_id = c.delivery_rider_id
  WHERE u.user_type_id = 4
  GROUP BY u.user_id
";

$result = mysqli_query($conn, $sql);

$user_names = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $user_names[] = $row;
  }
}
?>

<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333;
    /* Darker label color */
    font-weight: bolder;
  }
</style>

<div class="modal fade" id="addDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDeliveryModalLabel">Assign Delivery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group col-md-12">
            <label for="user_id">Assign Delivery Riderrr:</label>
            <select class="form-control" id="user_id" name="user_id" required>
              <option value="">Select Delivery Rider</option>
              <?php foreach ($user_names as $user_rows): ?>
                <option value="<?php echo $user_rows['user_id']; ?>"
                  <?php echo $user_rows['has_delivery'] ? 'disabled' : ''; ?>>
                  <?php
                  echo $user_rows['user_fullname'];
                  if ($user_rows['has_delivery']) {
                    echo ' * (Ongoing Delivery)';
                  }
                  ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>


          <!-- Add a hidden input field to submit the form with the button click -->
          <input type="hidden" name="cart_id" id="cart_id" value="">

          <input type="hidden" name="add_delivery_rider" value="1">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addDeliveryRiderButton">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#addDeliveryModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      // Store a reference to $(this)
      var $form = $(this);

      // Serialize form data
      var formData = $form.serialize();

      // Change button text to "Adding..." and disable it
      var $addButton = $('#addDeliveryRiderButton');
      $addButton.text('Adding...');
      $addButton.prop('disabled', true);

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/update_order_process.php',
        data: formData,
        success: function(response) {
          // Handle success response
          console.log(response); // Log the response for debugging
          response = JSON.parse(response);
          if (response.success) {
            Toastify({
              text: response.message,
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
            }).showToast();

            // Optionally, reset the form
            $form.trigger('reset');

            // Optionally, close the modal
            $('#addDeliveryModal').modal('hide');
            window.reloadDataTable();
            fetchNotifications();

          } else {
            Toastify({
              text: response.message,
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
            }).showToast();
          }
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.error(xhr.responseText);
          Toastify({
            text: "Error occurred while adding category. Please try again later.",
            duration: 2000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
        },
        complete: function() {
          // Reset button text and re-enable it
          $addButton.text('Add');
          $addButton.prop('disabled', false);
        }
      });
    });
  });
</script>