<?php
require 'connect.php';

$requestId = $_GET['request_id'];

// Delete the friend request
$deleteRequestQuery = "DELETE FROM frnd_req WHERE frndreq_id = $requestId";

if (mysqli_query($con, $deleteRequestQuery)) {
    header("Location: friends.php?declined=true");
} else {
    echo "Error declining request: " . mysqli_error($con);
}

mysqli_close($con);
?>
