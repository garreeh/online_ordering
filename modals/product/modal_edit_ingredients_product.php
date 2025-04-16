<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333;
    /* Darker label color */
    font-weight: bolder;
  }

  .modal-body img {
    max-width: 100%;
    /* Ensure the image fits within the modal */
    height: auto;
    max-height: 300px;
    /* Limit the image height */
    object-fit: contain;
    /* Maintain aspect ratio */
  }

  .file-info {
    margin-top: 10px;
  }
</style>

<?php
include './../../connections/connections.php';

// Fetch user types from the database
$sql = "SELECT * FROM ingredients_supplier";
$result = mysqli_query($conn, $sql);

$supplier_names = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $supplier_names[] = $row;
  }
}

// Fetch user types from the database
$sql = "SELECT * FROM ingredients_category";
$resultCategory = mysqli_query($conn, $sql);

$category_names = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($resultCategory)) {
    $category_names[] = $row;
  }
}

if (isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];

  $sql = "SELECT * FROM multiple_supplier WHERE product_id = '$product_id'";
  $result_suppliers = mysqli_query($conn, $sql);

  $suppliers = [];
  if ($result_suppliers) {
    while ($row = mysqli_fetch_assoc($result_suppliers)) {
      $suppliers[] = $row;
    }
  }

  $sql = "SELECT * FROM ingredients_product WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $product_image = basename($row['product_image']);
      $image_url = '../../uploads/' . $product_image; // Construct the image URL
?>
      <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Ingredient ID: <?php echo $row['product_id']; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="product_sku">Product SKU:</label>
                    <input type="text" class="form-control" id="product_sku" name="product_sku"
                      placeholder="Enter Product SKU" value="<?php echo $row['product_sku']; ?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                      placeholder="Enter Product Name" value="<?php echo $row['product_name']; ?>" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="category_id">Category:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                      <option value="" disabled>Select Category</option>
                      <?php
                      // Loop through category names to populate the dropdown
                      foreach ($category_names as $category_rows) {
                        // Set selected if the category_id matches
                        $selected = ($category_rows['category_id'] == $row['category_id']) ? 'selected' : '';
                        echo "<option value='" . $category_rows['category_id'] . "' $selected>" . $category_rows['category_name'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                </div>


                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Suppliers :</label>

                    <div id="variations-container_update">
                      <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $supplier): ?>
                          <div class="form-row mt-2">
                            <input type="hidden" name="supplier_multi_id[]" value="<?php echo $supplier['supplier_multi_id']; ?>">

                            <div class="form-group col-md-11">
                              <label>Supplier Name:</label>

                              <input type="text" class="form-control" name="supplier_multi_name[]" value="<?php echo $supplier['supplier_multi_name']; ?>"
                                placeholder="Enter Supplier Name" required>
                            </div>
                            <div class="form-group col-md-1">
                              <label></label>

                              <button type="button" class="btn btn-danger remove-suppliers_edit"
                                data-id="<?php echo $supplier['supplier_multi_id']; ?>">Remove</button>

                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      <button type="button" class="btn btn-secondary" id="add-variation-button_update">+ Add
                        Variation</button>
                    </div>
                  </div>
                </div>

                <!-- Add a hidden input field to submit the form with the button click -->
                <input type="hidden" name="edit_product" value="1">

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="saveProductButton">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- COPY THESE WHOLE CODE WHEN IMPORT SELECT -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
      <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

      <script>
        $(document).ready(function() {
          $('select').selectize({
            sortField: 'text'
          });
        });
      </script>
      <!-- END OF SELECT -->

<?php
    }
  }
}
?>

<script>
  $(document).ready(function() {
    // Add Variation Functionality
    document.getElementById('add-variation-button_update').addEventListener('click', function() {
      const container = document.getElementById('variations-container_update');

      const newVariation = document.createElement('div');
      newVariation.classList.add('form-row', 'mt-2');
      newVariation.innerHTML = `
    <div class="form-group col-md-11">
      <label>Supplier Name:</label>
      <input type="text" class="form-control" name="supplier_multi_name[]" placeholder="Enter Supplier Name" required>
    </div>
    <div class="form-group col-md-1">
      <label></label>
      <button type="button" class="btn btn-danger remove-suppliers_edit">Remove</button>
    </div>
  `;

      container.appendChild(newVariation);

    });

    // Remove Variation Functionality
    document.querySelectorAll('.remove-suppliers_edit').forEach(function(button) {
      button.addEventListener('click', function() {
        this.parentElement.parentElement.remove();
      });
    });

    $(document).off('click', '.remove-suppliers_edit').on('click', '.remove-suppliers_edit', function() {
      var supplier_multi_id = $(this).data('id');

      if (supplier_multi_id) {
        // Send the supplier_multi_id to the backend via AJAX for deletion
        $.ajax({
          type: 'POST',
          url: '/online_ordering/controllers/admin/remove_supplier_process.php',
          data: {
            remove_supplier_multi_id: [supplier_multi_id]
          },
          success: function(response) {
            try {
              response = JSON.parse(response);

              if (response.success) {
                Toastify({
                  text: 'Supplier removed successfully!',
                  duration: 2000,
                  backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                }).showToast();

                // Remove the corresponding <div> from the UI
                $(this).closest('.form-row').remove(); // Fix: `this` needs to reference the current `remove-suppliers_edit` element
              } else {
                Toastify({
                  text: response.message,
                  duration: 2000,
                  backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
                }).showToast();
              }
            } catch (error) {
              console.error('Error parsing response JSON:', error);
              Toastify({
                text: "An error occurred while processing the variation removal.",
                duration: 2000,
                backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
              }).showToast();
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            Toastify({
              text: "Error occurred while removing variation. Please try again later.",
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
            }).showToast();
          }
        });
      } else {
        // If no `supplier_multi_id`, simply perform the deletion without AJAX
        $(this).closest('.form-row').remove();
        Toastify({
          text: 'Variation removed successfully!',
          duration: 2000,
          backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
        }).showToast();
      }
    });


    $('#editProductModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission

      var $form = $(this);

      // Create a FormData object to handle file uploads
      var formData = new FormData($form[0]);

      // Change button text to "Saving..." and disable it
      var $saveButton = $('#saveProductButton');
      $saveButton.text('Saving...');
      $saveButton.prop('disabled', true);

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/edit_ingredients_product_process.php',
        data: formData,
        processData: false, // Prevent jQuery from automatically transforming the data into a query string
        contentType: false, // Let the browser set the content type for the FormData
        success: function(response) {
          console.log(response); // Log the response for debugging
          response = JSON.parse(response);
          if (response.success) {
            Toastify({
              text: response.message,
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
            }).showToast();

            $('#editProductModal').modal('hide');
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
          console.error(xhr.responseText);
          Toastify({
            text: "Error occurred while editing product. Please try again later.",
            duration: 2000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
        },
        complete: function() {
          // Reset button text and re-enable it
          $saveButton.text('Save');
          $saveButton.prop('disabled', false);
        }
      });


    });
  });
</script>