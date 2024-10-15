<?php
require "database.php";

if (isset($_POST["update"])) {
    $name = $_POST["gamename"];
    $url = $_POST["gameurl"];
    $userid = $_POST["updateid"];

    // Retrieve the current image path from the database
    $query = "SELECT gameimage FROM games WHERE gameid = $userid";
    $result = mysqli_query($con, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $old_image_path = $user["gameimage"];

        // Check if a new file is uploaded
        if (isset($_FILES["gameimg"]) && $_FILES["gameimg"]["error"] === 0) {
            $file_tmp = $_FILES["gameimg"]["tmp_name"];
            $file_name = $_FILES["gameimg"]["name"];
            $file_error = $_FILES["gameimg"]["error"];
            $file_size = $_FILES["gameimg"]["size"];

            $directory = "assets/img/";

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $filepath = $directory . basename($file_name);

            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_ext, $allowed_types) && $file_size < 1000000) {
                if (move_uploaded_file($file_tmp, $filepath)) {
                    if (file_exists($old_image_path) && $old_image_path !== $filepath) {
                        unlink($old_image_path);
                    }
                    $update_query = "UPDATE `games` SET `gamename`='$name',`gameimage`='$filepath',`gameurl`='$url' WHERE gameid = $userid";
                    
                    $update_result = mysqli_query($con, $update_query);

                    if ($update_result) {
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
            echo "File Upload Error";
        }
    } else {
        echo "Error fetching user data: " . mysqli_error($con);
    }
} else {
    echo "No update request received.";
}
?>