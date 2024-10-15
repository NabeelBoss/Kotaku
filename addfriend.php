<?php
session_start();
require "connect.php";

if (!isset($_SESSION['LoginId'])) {
    header("Location: signin.php");
    exit();
}

$user_one = intval($_SESSION['LoginId']);
$user_two = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_two > 0 && $user_one !== $user_two) {
    $checkRequest = "
        SELECT * 
        FROM frnd_req 
        WHERE (sender_id = $user_one AND receiver_id = $user_two) 
        OR (sender_id = $user_two AND receiver_id = $user_one)
    ";
    $requestResult = mysqli_query($con, $checkRequest);

    if (mysqli_num_rows($requestResult) == 0) {
        $sendRequestQuery = "INSERT INTO frnd_req (sender_id, receiver_id) VALUES ($user_one, $user_two)";
        if (mysqli_query($con, $sendRequestQuery)) {
            $_SESSION['message'] = "Friend request sent!";
        } else {
            $_SESSION['error_message'] = "Error sending friend request: " . mysqli_error($con);
        }
    } else {
        $request = mysqli_fetch_assoc($requestResult);
        
        // Using a ternary operator as suggested
        $_SESSION['error_message'] = ($request['sender_id'] == $user_two) 
            ? "Pending request" 
            : "Friend request already sent.";
    }
    
    
    header("Location: userprofile.php?userid=" . urlencode($user_two));
    exit();
} else {
    $_SESSION['error_message'] = "Invalid action.";
    header("Location: userprofile.php");
    exit();
}
?>
