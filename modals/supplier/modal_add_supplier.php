<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333;
    /* Darker label color */
    font-weight: bolder;
  }
</style>

<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSupplierModalLabel">Add Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="supplier_name">Supplier Name:</label>
              <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" required>
            </div>
            <div class="form-group col-md-4">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
            </div>
            <div class="form-group col-md-4">
              <label for="landline">Landline:</label>
              <input type="text" class="form-control" id="landline" name="landline" placeholder="Enter Landline">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="mobile">Mobile:</label>
              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group col-md-4">
              <label for="tin">TIN:</label>
              <input type="text" class="form-control" id="tin" name="tin" placeholder="Enter TIN">
            </div>
          </div>

          <!-- Add a hidden input field to submit the form with the button click -->
          <input type="hidden" name="add_supplier" value="1">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addButton">Add</button>
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
    $('#addSupplierModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      // Store a reference to $(this)
      var $form = $(this);

      // Serialize form data
      var formData = $form.serialize();

      // Change button text to "Adding..." and disable it
      var $addButton = $('#addButton');
      $addButton.text('Adding...');
      $addButton.prop('disabled', true);

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/add_supplier_process.php',
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
            $('#addSupplierModal').modal('hide');
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
            text: "Error occurred while adding supplier. Please try again later.",
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