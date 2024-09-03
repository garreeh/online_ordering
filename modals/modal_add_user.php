<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333; /* Darker label color */
    font-weight: bolder;
  }
</style>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="user_fullname">Fullname:</label>
            <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Enter fullname" required>
        </div>
        
        <div class="form-group col-md-6">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
        </div>

        <div class="form-group col-md-6">
            <label for="user_address">Address:</label>
            <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Enter Address" required>
        </div>
        
        <div class="form-group col-md-6">
            <label for="user_email">Email:</label>
            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter Email" required>
        </div>

        <div class="form-group col-md-6">
            <label for="user_contact">Contact #:</label>
            <input type="text" class="form-control" id="user_contact" name="user_contact" placeholder="Enter Contact #" required>
        </div>
        
        <div class="form-group col-md-6">
            <label for="user_password">Password:</label>
            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter Password" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>

      </div>
    </div>
  </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
  $(document).ready(function() {
    $('#addUserModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission
      
      // Store a reference to $(this)
      var $form = $(this);
      
      // Serialize form data
      var formData = $form.serialize();

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/add_user_process.php',
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
            $('#addUserModal').modal('hide');
            window.reloadDataTable();
            
            // Optionally, reload the DataTable or update it with the new data
            // Example: $('#dataTable').DataTable().ajax.reload();
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
            text: "Error occurred while adding ticket. Please try again later.",
            duration: 2000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
        }
      });
    });
  });
</script>