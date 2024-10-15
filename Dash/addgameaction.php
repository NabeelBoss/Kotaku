<?php

require "database.php";

if (isset($_POST["Submit"]) && isset($_FILES["gameimg"])) {
    // Retrieve form data
    $gamename = $_POST["gamename"];
    $gameurl = $_POST["gameurl"];

    // Retrieve file data
    $file_tmp = $_FILES["gameimg"]["tmp_name"];
    $file_name = $_FILES["gameimg"]["name"];
    $file_error = $_FILES["gameimg"]["error"];
    $file_size = $_FILES["gameimg"]["size"];
    $file_type = $_FILES["gameimg"]["type"];

    // Directory to save uploaded images
    $directory = "assets/img/";

    // Create directory if it does not exist
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    // Set the file path
    $filepath = $directory . basename($file_name);

    // Check for file upload errors
    if ($file_error === 0) {
        // Set allowed file types
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type and size
        if (in_array($file_ext, $allowed_types) && $file_size < 1000000) { // 1MB limit
            // Move uploaded file to the target directory
            if (move_uploaded_file($file_tmp, $filepath)) {
                // Insert data into the database
                $query = "INSERT INTO `games`(`gamename`, `gameimage`, `gameurl`) VALUES ('$gamename','$filepath','$gameurl')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    header('Location: gamelist.php');
                    exit();
                } else {
                    echo "Data not sent to the database.";
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file type or file size exceeds limit.";
        }
    } else {
        echo "File upload error: " . $file_error;
    }
} else {
    echo "No file uploaded.";
}
?>