<style>
  /* Custom CSS for label color */
  .modal-body label {
    color: #333; /* Darker label color */
    font-weight: bolder;
  }
</style>

<?php
include './../../connections/connections.php';

if (isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
  $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
  <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Product ID: <?php echo $row['product_id']; ?></h5>
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
              <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter Product SKU" value="<?php echo $row['product_sku']; ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="product_name">Product Name:</label>
              <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" value="<?php echo $row['product_name']; ?>" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_description">Product Description:</label>
              <input type="text" class="form-control" id="product_description" name="product_description" placeholder="Enter Product Description" value="<?php echo $row['product_description']; ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="product_unitprice">Product Unit Price:</label>
              <input type="text" class="form-control" id="product_unitprice" name="product_unitprice" placeholder="Enter Product Unit Price" value="<?php echo $row['product_unitprice']; ?>" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_sellingprice">Product Selling Price:</label>
              <input type="text" class="form-control" id="product_sellingprice" name="product_sellingprice" placeholder="Enter Product Selling Price" value="<?php echo $row['product_sellingprice']; ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="product_image">Product Image:</label>
              <input type="file" class="form-control" id="product_image" name="fileToUpload" value="<?php echo $row['fileToUpload']; ?>" required>
            </div>
          </div>

            <!-- Add a hidden input field to submit the form with the button click -->
            <input type="hidden" name="edit_supplier" value="1">

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <!-- <input type="hidden" name="item_id" value="</?php echo $row['category_id']; ?>"> -->
              <button type="button" class="btn btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php 
    }
  }
}
?>

<script>
  //Save Button in Edit Supplier
  $(document).ready(function() {
    $('#editCategoryModal form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission
      // Store a reference to $(this)
      var $form = $(this);
      
      // Serialize form data
      var formData = $form.serialize();

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/edit_product_process.php',
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
            
            // Optionally, close the modal
            $('#editCategoryModal').modal('hide');
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
            text: "Error occurred while editing supplier. Please try again later.",
            duration: 2000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
        }
      });
    });
  });

</script>