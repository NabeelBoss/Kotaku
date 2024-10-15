<?php
session_start();
require "connect.php";

if (!isset($_SESSION['LoginId'])) {
    header("Location: signin.php");
    exit();
}

$logged_in_user_id = intval($_SESSION['LoginId']);
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id > 0) {
    // Delete the friend request from frnd_req table
    $cancelRequestQuery = "DELETE FROM frnd_req WHERE sender_id = $logged_in_user_id AND receiver_id = $user_id";
    if (mysqli_query($con, $cancelRequestQuery)) {
        $_SESSION['message'] = "Friend request canceled successfully.";
    } else {
        $_SESSION['error_message'] = "Error canceling request: " . mysqli_error($con);
    }
} else {
    $_SESSION['error_message'] = "Invalid action.";
}

// Redirect back to the user profile
header("Location: userprofile.php?userid=" . $user_id);
exit();

?>
