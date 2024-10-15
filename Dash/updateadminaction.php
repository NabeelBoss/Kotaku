<?php
require "database.php";

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $number = $_POST["number"];
    $userid = $_POST["updateid"];

    // Retrieve the current image path from the database
    $query = "SELECT userprofile, userbanner FROM userreg WHERE userid = $userid";
    $result = mysqli_query($con, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $old_image_path = $user["userprofile"];
        $old_banner_path = $user["userbanner"];

        $upload_success = true;

        // Check if a new file is uploaded
        if (isset($_FILES["img"]) && $_FILES["img"]["error"] === 0 && isset($_FILES["banner"]) && $_FILES["banner"]["error"] === 0) {
            $file_tmp = $_FILES["img"]["tmp_name"];
            $file_name = $_FILES["img"]["name"];
            $file_error = $_FILES["img"]["error"];
            $file_size = $_FILES["img"]["size"];

            $banner_tmp = $_FILES["banner"]["tmp_name"];
            $banner_name = $_FILES["banner"]["name"];
            $banner_error = $_FILES["banner"]["error"];
            $banner_size = $_FILES["banner"]["size"];

            // Directory to save uploaded banner
            $directorybanner = "assets/img/";

            // Create directory if it does not exist
            if (!is_dir($directorybanner)) {
                mkdir($directorybanner, 0755, true);
            }

            // Set the banner path
            $bannerpath = $directorybanner . basename($banner_name);

            // Check for banner file upload errors and move it
            if ($banner_error === 0) {
                if (!move_uploaded_file($banner_tmp, $bannerpath)) {
                    echo "Failed to move banner file.";
                    $upload_success = false;
                }
            } else {
                echo "Banner file upload error: " . $banner_error;
                $upload_success = false;
            }

            // Directory to save uploaded images
            $directory = "assets/img/";

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Set the file path
            $filepath = $directory . basename($file_name);

            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_ext, $allowed_types) && $file_size < 1000000) {
                if (!move_uploaded_file($file_tmp, $filepath)) {
                    echo "Failed to move image file.";
                    $upload_success = false;
                }
            } else {
                echo "Invalid image file type or size exceeds limit.";
                $upload_success = false;
            }

            // If both files are uploaded successfully, update the database
            if ($upload_success) {
                // Delete old files if new files are uploaded
                if (file_exists($old_image_path) && $old_image_path !== $filepath) {
                    unlink($old_image_path);
                }
                if (file_exists($old_banner_path) && $old_banner_path !== $bannerpath) {
                    unlink($old_banner_path);
                }

                $update_query = "UPDATE `userreg` SET `username`='$name', `usernumber`='$number', `useremail`='$email', `userpass`='$password', `userprofile`='$filepath', `userbanner`='$bannerpath', `userrole`='ADMIN' WHERE userid = $userid";
                $update_result = mysqli_query($con, $update_query);

                if ($update_result) {
                    header('Location: profile.php');
                    exit();
                } else {
                    echo "Failed to update data in the database.";
                }
            }
        } else {
            echo "No files were uploaded or there was an upload error.";
        }
    } else {
        echo "Error fetching user data: " . mysqli_error($con);
    }
} else {
    echo "No update request received.";
}
?>