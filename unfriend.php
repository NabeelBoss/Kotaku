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
    $deleteFriendship = "DELETE FROM friends WHERE (user_one = $user_one AND user_two = $user_two) 
                         OR (user_one = $user_two AND user_two = $user_one)";
                         
    if (mysqli_query($con, $deleteFriendship)) {
        header("Location: friends.php");
        exit();
    } else {
        echo "Error removing friend: " . mysqli_error($con);
    }
} else {
    echo "Invalid action.";
}

mysqli_close($con);
?>
