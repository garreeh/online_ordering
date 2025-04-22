<?php
include './../../connections/connections.php';

// Fetch products
$sql = "SELECT * FROM ingredients_product";
$resultProduct = mysqli_query($conn, $sql);
$products = [];
if ($resultProduct) {
  while ($row = mysqli_fetch_assoc($resultProduct)) {
    $products[] = $row;
  }
}
?>

<style>
  .modal-body label {
    color: #333;
    font-weight: bolder;
  }
</style>

<div class="modal fade" id="addPurchaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="addPurchaseOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPurchaseOrderModalLabel">Add Purchase Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="purchase_number">Purchase Number:</label>
              <input type="number" class="form-control" id="purchase_number" name="purchase_number" placeholder="Enter Purchase Number" required>
            </div>
            <div class="form-group col-md-6">
              <label for="quantity">Quantity (Per KG):</label>
              <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_id">Product:</label>
              <select class="form-control" id="product_id" name="product_id" onchange="inheritSupplierDetails()" required>
                <option value="">Select Product</option>
                <?php foreach ($products as $product) : ?>
                  <option value="<?php echo $product['product_id']; ?>">
                    <?php echo $product['product_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="supplier_name">Suppliers:</label>
              <input type="text" class="form-control" id="supplier_name" name="supplier_name" readonly>
            </div>

            <input type="hidden" class="form-control" id="supplier_id" name="supplier_id" readonly>
          </div>

          <input type="hidden" name="add_purchase" value="1">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
  function inheritSupplierDetails() {
    var productId = $('#product_id').val();
    console.log('Selected Product ID:', productId);

    if (!productId) {
      $('#supplier_name').val('');
      return;
    }

    $.ajax({
      url: '/online_ordering/controllers/admin/get_suppliers_by_product.php',
      type: 'POST',
      data: {
        product_id: productId
      },
      success: function(response) {
        console.log('Supplier response:', response);
        var res = JSON.parse(response);

        if (res.success) {
          $('#supplier_name').val(res.supplier_names);
        } else {
          $('#supplier_name').val('No suppliers found');
        }
      },
      error: function() {
        $('#supplier_name').val('Error loading suppliers');
      }
    });
  }

  $(document).ready(function() {
    $('#addPurchaseOrderModal form').on('submit', function(event) {
      event.preventDefault();

      var $form = $(this);
      var $submitButton = $form.find('button[type="submit"]');
      var originalButtonText = $submitButton.text();

      $submitButton.text('Adding...').prop('disabled', true);

      var formData = new FormData($form[0]);

      $.ajax({
        type: 'POST',
        url: '/online_ordering/controllers/admin/add_purchase_process.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response);
          response = JSON.parse(response);
          if (response.success) {
            Toastify({
              text: response.message,
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
            }).showToast();

            $form.trigger('reset');
            $('#addPurchaseOrderModal').modal('hide');
            window.reloadDataTable();
          } else {
            Toastify({
              text: response.message,
              duration: 2000,
              backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
            }).showToast();
          }
        },
        error: function(xhr) {
          console.error(xhr.responseText);
          Toastify({
            text: "Error occurred while adding product. Please try again later.",
            duration: 2000,
            backgroundColor: "linear-gradient(to right, #ff6a00, #ee0979)"
          }).showToast();
        },
        complete: function() {
          $submitButton.text(originalButtonText).prop('disabled', false);
        }
      });
    });
  });
</script>