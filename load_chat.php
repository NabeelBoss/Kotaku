<?php
include 'connect.php'; 

$friendId = $_POST['friendId'];
$loggedInUserId = $_SESSION['LoginId'];

// Log friendId and loggedInUserId for debugging
error_log("Friend ID: $friendId, Logged-in User ID: $loggedInUserId");

$query = "
    SELECT sender_id, receiver_id, message_text, sent_time,
           (CASE WHEN sender_id = $loggedInUserId THEN 1 ELSE 0 END) AS is_sender
    FROM chat
    WHERE (sender_id = $loggedInUserId AND receiver_id = $friendId)
       OR (sender_id = $friendId AND receiver_id = $loggedInUserId)
    ORDER BY sent_time ASC
";

$result = mysqli_query($con, $query);

// Check if the query ran successfully
if (!$result) {
    error_log("Query failed: " . mysqli_error($con));
}

$messages = [];

while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = [
        'text' => htmlspecialchars($row['message_text']),
        'is_sender' => $row['is_sender'],
        'sender_image' => getUserImage($row['sender_id']),
        'receiver_image' => getUserImage($row['receiver_id']),
    ];
}

// Return JSON response
echo json_encode(['messages' => $messages]);

function getUserImage($userId) {
    global $con;
    $query = "SELECT userprofile FROM userreg WHERE userid = $userId";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return htmlspecialchars($row['userprofile']);
}
?>
