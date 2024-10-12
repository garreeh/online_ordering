<?php
include './../../connections/connections.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT *
        FROM cart c
        JOIN product p ON c.product_id = p.product_id
        WHERE c.user_id = '$user_id' AND c.cart_status = 'Cart'";
$result = mysqli_query($conn, $sql);

$totalPrice = 0; // Initialize total price
$cartItems = ''; // Initialize cart items content

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_id = htmlspecialchars($row['cart_id']);

        $productName = htmlspecialchars($row['product_name']);
        $quantity = intval($row['cart_quantity']);
        $price = floatval($row['product_sellingprice']);
        $itemTotal = $quantity * $price;
        $totalPrice += $itemTotal;
        
        $cartItems .= '<tr>';
        $cartItems .= '<td>' . $productName . '</td>';
        $cartItems .= '<td>' . $quantity . '</td>';
        $cartItems .= '<td>₱ ' . $price . '</td>';
        $cartItems .= '<td>₱ ' . $itemTotal . '</td>';
        $cartItems .= '</tr>';

        $cartItems .= '<input type="hidden" name="cart_id[]" value="' . $cart_id . '">';
    }
?>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Order Summary Section -->
        <h2>Order Summary</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Item</th>
              <th scope="col">Quantity</th>
              <th scope="col">Unit Price</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="order-summary">
            <?php echo $cartItems; // Output the generated cart items ?>
          </tbody>
        </table>
        <div class="text-right">
          <h1>Total: <span id="total-amount">₱ <?php echo number_format($totalPrice, 2); ?></span></h1>
        </div>
        <hr>

        <!-- Payment Section -->
        <form id="checkoutForm">
          <div class="form-group">
            <label for="payment-category">Select Payment Method:</label>
            <div>
              <label><input type="radio" name="paymentCategory" value="GCash"> Gcash</label>
              <label><input type="radio" name="paymentCategory" value="Cash On Delivery"> Cash on Delivery (COD)</label>
            </div>
          </div>
          <div class="form-group" id="proof-of-payment-field" style="display: none;">
            <label for="proofOfPayment">Upload Proof of Payment (GCash):</label>
            <input type="file" id="proofOfPayment" name="proofOfPayment" class="form-control-file" required>
          </div>

          <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitCheckout">Confirm Payment</button>
      </div>
    </div>
  </div>
</div>

<!-- IF THE MODAL BACKDROP DID NOT WORK UNCOMMENT THIS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<?php 
}
?>
