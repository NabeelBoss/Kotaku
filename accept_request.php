<?php
require 'connect.php';

$requestId = $_GET['request_id'];

// Get the friend request details
$requestQuery = "SELECT sender_id, receiver_id FROM frnd_req WHERE frndreq_id = $requestId";
$requestResult = mysqli_query($con, $requestQuery);
$request = mysqli_fetch_assoc($requestResult);

$senderId = $request['sender_id'];
$receiverId = $request['receiver_id'];

// Insert into the friends table
$addFriendQuery = "
    INSERT INTO friends (user_one, user_two)
    VALUES ($senderId, $receiverId)
";

if (mysqli_query($con, $addFriendQuery)) {
    $deleteRequestQuery = "DELETE FROM frnd_req WHERE frndreq_id = $requestId";
    mysqli_query($con, $deleteRequestQuery);
    header("Location: friends.php?success=true");
} else {
    echo "Error accepting request: " . mysqli_error($con);
}

mysqli_close($con);
?>
