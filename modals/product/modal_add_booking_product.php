<?php
include './../../connections/connections.php';

// Fetch user types from the database
$sql = "SELECT * FROM supplier";
$result = mysqli_query($conn, $sql);

$supplier_names = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $supplier_names[] = $row;
  }
}

// Fetch user types from the database
$sql = "SELECT * FROM category";
$resultCategory = mysqli_query($conn, $sql);

$category_names = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($resultCategory)) {
    $category_names[] = $row;
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

<div class="modal fade" id="addProductBookingModal" tabindex="-1" role="dialog" aria-labelledby="addProductBookingModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductBookingModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_sku">Product Code:</label>
              <input type="text" class="form-control" id="product_sku" name="product_sku"
                placeholder="Enter Product SKU" required>
            </div>
            <div class="form-group col-md-6">
              <label for="product_name">Product Name:</label>
              <input type="text" class="form-control" id="product_name" name="product_name"
                placeholder="Enter Product Name" required>
            </div>
          </div>


          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_sellingprice">Product Selling Price:</label>
              <input type="text" class="form-control" id="product_sellingprice" name="product_sellingprice"
                placeholder="Enter Product Selling Price" required>
            </div>
            <div class="form-group col-md-6">
              <label for="product_image">Main Product Image:</label>
              <input type="file" class="form-control" id="product_image" name="fileToUpload" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="product_description">Product Description:</label>
              <textarea class="form-control" id="product_description" name="product_description"
                placeholder="Enter Product Description" rows="4" required></textarea>
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Other Product Images:</label>
              <div id="images-container">
                <!-- Placeholder for additional images -->
              </div>
              <button type="button" class="btn btn-secondary mt-2" id="add-image-button">+ Add Image</button>
            </div>
          </div>

          <!-- Add a hidden input field to submit the form with the button click -->
          <input type="hidden" name="add_product_booking" value="1">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addProductButton">Add</button>
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
  // Add Image functionality with remove button
  const addImageButton = document.getElementById('add-image-button');
  addImageButton.addEventListener('click', function() {
    const container = document.getElementById('images-container');

    const row = document.createElement('div');
    row.className = 'form-row mt-2';

    const imageCol = document.createElement('div');
    imageCol.className = 'form-group col-md-11';
    imageCol.innerHTML = `
    <input type="file" class="form-control" name="productImagePath[]" required>
  `;

    // Remove button
    const removeCol = document.createElement('div');
    removeCol.className = 'form-group col-md-1';
    removeCol.innerHTML = `
    <button type="button" class="btn btn-danger btn-block remove-add-image">Remove</button>
  `;

    row.appendChild(imageCol);
    row.appendChild(removeCol);

    container.appendChild(row);

    // Add event listener for remove button
    const removeButton = row.querySelector('.remove-add-image');
    removeButton.addEventListener('click', function() {
      container.removeChild(row);
    });
  });


  document.getElementById('product_sellingprice').addEventListener('input', function(e) {
    // Allow only numbers and dots, and ensure only one dot
    this.value = this.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters except dot
    if ((this.value.match(/\./g) || []).length > 1) {
      this.value = this.value.slice(0, -1); // Remove the last character if there's more than one dot
    }
  });


  $(document).ready(function() {
    $('#addProductBookingModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      // Store a reference to $(this)
      var $form = $(this);

      // Serialize form data
      var formData = new FormData($form[0]);

      // Change button text to "Adding..." and disable it
      var $addButton = $('#addProductButton');
      $addButton.text('Adding...');
      $addButton.prop('disabled', true);

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/add_product_booking_process.php',
        data: formData,
        contentType: false,
        processData: false,
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

            $form.trigger('reset');
            $('#addProductBookingModal').modal('hide');
            window.reloadDataTable();
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
            text: "Error occurred while adding product. Please try again later.",
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