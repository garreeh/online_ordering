<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>J & J | Gcash Successful</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">GCash Payment Successful!</h1>
                    <p class="mb-4">Thank you for payment.</p>
                  </div>
                  <a href="./index.php" class="btn btn-primary btn-user btn-block">
                    Back to Home Page
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/admin/js/sb-admin-2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script>
    $(document).ready(function() {
      let referenceId = localStorage.getItem("xendit_reference_id");

      if (referenceId) {
        $.ajax({
          type: "POST",
          url: "/v2/controllers/users/xendit_check_status.php",
          data: JSON.stringify({
            reference_id: referenceId
          }),
          contentType: "application/json",
          success: function(response) {
            response = JSON.parse(response);

            if (response.success) {
              console.log("Cart updated successfully.");
              localStorage.removeItem("xendit_reference_id"); // Remove after processing
              window.location.href = "/v2/thankyou_payment.php"; // Redirect to thank you page
            } else {
              console.error("Failed to process payment:", response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error("Error:", error);
          }
        });
      }
    });
  </script>
</body>

</html>