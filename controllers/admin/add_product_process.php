<?php

include '../../connections/connections.php';

if (isset($_POST['add_product'])) {

    // Initialize response array
    $response = array('success' => false, 'message' => '');

    $rand = substr(md5(microtime()), rand(0, 26), 5);
    $target_dir = "../../uploads/"; // Save directly in the uploads folder
    $target_filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $target_filename; // Fixed path issue
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Create target directory if it doesn't exist (this is not needed in your case)
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Other checks and upload logic
    if (file_exists($target_file)) {
        $response['message'] = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // LIMIT FILE SIZE (Uncomment if needed)
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //   $response['message'] = "Sorry, your file is too large.";
    //   $uploadOk = 0;
    // }
    
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PDF" && $imageFileType != "pdf"
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
        } else {
            $response['message'] = "Sorry, there was an error uploading your file.";
            echo json_encode($response);
            exit();
        }
    }
    

    // Get form data
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_sku = $conn->real_escape_string($_POST['product_sku']);
    $product_description = $conn->real_escape_string($_POST['product_description']);
    $product_unitprice = $conn->real_escape_string($_POST['product_unitprice']);
    $product_sellingprice = $conn->real_escape_string($_POST['product_sellingprice']);

    // Construct SQL query
    $sql = "INSERT INTO `product` (product_name, product_sku, product_description, product_unitprice, product_sellingprice, product_image)
            VALUES ('$product_name', '$product_sku', '$product_description', '$product_unitprice', '$product_sellingprice', '$target_file')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        $response['success'] = true;
        $response['message'] = 'Product added successfully!';
    } else {
        $response['message'] = 'Error adding product: ' . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
?>