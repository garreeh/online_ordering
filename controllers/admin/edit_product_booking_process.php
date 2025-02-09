<?php

include '../../connections/connections.php';

if (isset($_POST['edit_product'])) {

  $response = array('success' => false, 'message' => '');
  $product_id = $conn->real_escape_string($_POST['product_id']);

  // Get the old file path from the database
  $sql = "SELECT product_image FROM product WHERE product_id='$product_id'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $old_file = $row['product_image'];
  } else {
    $response['message'] = "Error retrieving old file information.";
    echo json_encode($response);
    exit();
  }

  $target_dir = "../../uploads/";
  $uploadOk = 1;

  // Handle file upload
  if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] != UPLOAD_ERR_NO_FILE) {
    $target_filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $target_filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check for upload errors
    if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
      $response['message'] = "File upload error: " . $_FILES["fileToUpload"]["error"];
      echo json_encode($response);
      exit();
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $response['message'] = "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "pdf"
    ) {
      $response['message'] = "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $response['message'] = "Sorry, your file was not uploaded.";
      echo json_encode($response);
      exit();
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $response['message'] = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        // Delete the old file if it exists and is different from the new file
        if (!empty($old_file) && $old_file !== $target_file) {
          if (file_exists($old_file)) {
            unlink($old_file);
          }
        }
      } else {
        $response['message'] = "Sorry, there was an error uploading your file.";
        echo json_encode($response);
        exit();
      }
    }

    // Set new filename if a new file is uploaded
    $new_filename = $target_file;
  } else {
    // No file uploaded, retain old filename
    $new_filename = $old_file;
  }

  $product_name = $conn->real_escape_string($_POST['product_name']);
  $product_sku = $conn->real_escape_string($_POST['product_sku']);
  $product_description = $conn->real_escape_string($_POST['product_description']);
  $product_sellingprice = $conn->real_escape_string($_POST['product_sellingprice']);

  // Update SQL query with full path
  $sql = "UPDATE product SET 
            product_name='$product_name', 
            product_sku='$product_sku', 
            product_description='$product_description', 
            product_sellingprice='$product_sellingprice', 
            product_image='$new_filename'
            WHERE product_id='$product_id'";

  if (mysqli_query($conn, $sql)) {


    // Updating Images
    if (!empty($_FILES["productImagePath"]["name"])) {
      foreach ($_FILES["productImagePath"]["name"] as $key => $image_name) {
        $image_id = isset($_POST['product_image_id'][$key]) ? $_POST['product_image_id'][$key] : null;
        $additional_filename = $_FILES["productImagePath"]["name"][$key];
        $additional_target_file = $target_dir . basename($additional_filename);

        $imageFileType = strtolower(pathinfo($additional_target_file, PATHINFO_EXTENSION));

        // Skip invalid file types
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" && $imageFileType != "pdf"
        ) {
          continue; // Skip invalid files
        }

        // Check if there's an existing file to delete
        if ($image_id) {
          // Fetch current file path for this image ID
          $current_file_query = "SELECT product_image_path FROM `product_image` WHERE product_image_id = '$image_id'";
          $result = mysqli_query($conn, $current_file_query);
          $current_file = mysqli_fetch_assoc($result)['product_image_path'];

          if (!empty($current_file) && file_exists($current_file)) {
            unlink($current_file); // Remove the old file
          }

          // Update existing image in the database
          $sql_images = "UPDATE `product_image` SET product_image_path='$additional_target_file' WHERE product_image_id='$image_id'";
        } else {
          // Insert new image into the database
          $sql_images = "INSERT INTO `product_image` (product_id, product_image_path) VALUES ('$product_id', '$additional_target_file')";
        }

        // Attempt to execute SQL and upload file
        if (move_uploaded_file($_FILES["productImagePath"]["tmp_name"][$key], $additional_target_file)) {
          if (mysqli_query($conn, $sql_images)) {
            $response['success'] = true;
            $response['message'] = 'Product updated successfully!';
          } else {
            $response['message'] = 'Error updating product: ' . mysqli_error($conn);
          }
        }
      }
    }


    $response['success'] = true;
    $response['message'] = 'Product updated successfully!';
  } else {
    $response['message'] = 'Error updating product: ' . mysqli_error($conn);
  }

  echo json_encode($response);
  exit();
}
