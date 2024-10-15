<?php
require "database.php";

if (isset($_POST["Submit"]) && isset($_FILES["img"]) && isset($_FILES["banner"])) {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $number = $_POST["numb"];
    $playerrole = "PLAYER";

    // Retrieve banner data
    $banner_tmp = $_FILES["banner"]["tmp_name"];
    $banner_name = $_FILES["banner"]["name"];
    $banner_error = $_FILES["banner"]["error"];
    $banner_size = $_FILES["banner"]["size"];
    $banner_type = $_FILES["banner"]["type"];

    // Directory to save uploaded banner
    $directorybanner = "User Banners/";

    // Create directory if it does not exist
    if (!is_dir($directorybanner)) {
        mkdir($directorybanner, 0755, true);
    }

    // Set the banner path after directory creation
    $bannerpath = $directorybanner . basename($banner_name);

    // Check for banner file upload errors and move it
    if ($banner_error === 0) {
        // Move uploaded banner to the target directory
        if (!move_uploaded_file($banner_tmp, $bannerpath)) {
            echo "Failed to move banner file.";
            $upload_success = false;
        }
    } else {
        echo "Banner file upload error: " . $banner_error;
        $upload_success = false;
    }

    // Retrieve file data
    $file_tmp = $_FILES["img"]["tmp_name"];
    $file_name = $_FILES["img"]["name"];
    $file_error = $_FILES["img"]["error"];
    $file_size = $_FILES["img"]["size"];
    $file_type = $_FILES["img"]["type"];

    // Directory to save uploaded images
    $directory = "User Images/";

    // Create directory if it does not exist
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    // Set the file path after directory creation
    $filepath = $directory . basename($file_name);

    // Initialize a flag to check if both files are uploaded successfully
    $upload_success = true;

    // Check for image file upload errors and move it
    if ($file_error === 0) {
        // Set allowed file types
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type and size
        if (in_array($file_ext, $allowed_types) && $file_size < 1000000) { // 1MB limit
            // Move uploaded image to the target directory
            if (!move_uploaded_file($file_tmp, $filepath)) {
                echo "Failed to move image file.";
                $upload_success = false;
            }
        } else {
            echo "Invalid image file type or size exceeds limit.";
            $upload_success = false;
        }
    } else {
        echo "Image file upload error: " . $file_error;
        $upload_success = false;
    }

    // If both files are uploaded successfully, insert data into the database
    if ($upload_success) {
        $query = "INSERT INTO `userreg` (username, usernumber, useremail, userpass, userprofile, userbanner, userrole) VALUES ('$name', '$number', '$email', '$password', '$filepath', '$bannerpath', '$playerrole')";
        $result = mysqli_query($con, $query);

        if ($result) {
            header('Location: userlist.php');
            exit();
        } else {
            echo "Failed to insert data into the database.";
        }
    }
} else {
    echo "No file uploaded.";
}
?>