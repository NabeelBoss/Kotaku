<?php
session_start();
include('connect.php');

$friendId = isset($_GET['friendId']) ? $_GET['friendId'] : null;
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$loggedInUserId = $_SESSION['LoginId'];

// Determine which ID to use
$targetId = $friendId ? $friendId : $userId;

if ($targetId) {
    // Fetch logged-in user's profile image
    $userImageQuery = "SELECT userprofile FROM userreg WHERE userid = $loggedInUserId";
    $userImageResult = mysqli_query($con, $userImageQuery);
    $loggedInUserImage = mysqli_fetch_assoc($userImageResult)['userprofile'];

    // Fetch friend's profile image and username
    $friendImageQuery = "SELECT userprofile, username FROM userreg WHERE userid = $targetId";
    $friendImageResult = mysqli_query($con, $friendImageQuery);
    $friendData = mysqli_fetch_assoc($friendImageResult);
    $friendImage = $friendData['userprofile'];
    $friendName = $friendData['username'];

    // Fetch chat messages between logged-in user and friend
    $query = "
        SELECT sender_id, receiver_id, message_text, sent_time,
            (CASE WHEN sender_id = $loggedInUserId THEN 1 ELSE 0 END) AS is_sender
        FROM chat
        WHERE (sender_id = $loggedInUserId AND receiver_id = $targetId)
        OR (sender_id = $targetId AND receiver_id = $loggedInUserId)
        ORDER BY sent_time ASC
    ";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['is_sender']) {
                echo "
                <div class='chat-msg receiver ms-auto'>
                    <div class='msg-content mb-4'>
                        <div class='msg-text text-end'>
                            <span>
                                {$row['message_text']}
                            </span>
                        </div>
                    </div>
                    <div class='msg-receiver-thumb mt-2 ms-auto circle-image'>
                        <img class='w-100 rounded-circle' src='$loggedInUserImage' alt='Receiver Image'>
                    </div>
                </div>";
            } else {
                echo "
                <div class='chat-msg sender'>
                    <div class='msg-sender-thumb mb-4 circle-image'>
                        <img class='w-100 rounded-circle' src='$friendImage' alt='Sender Image'>
                    </div>
                    <div class='msg-content'>
                        <div class='msg-text'>
                            <span>
                                {$row['message_text']}
                            </span>
                        </div>
                    </div>
                </div>";
            }
        }
    } else {
        echo "<div class='center-text'><p>Explore and Talk to new friends.</p></div>";
    }
} else {
    echo "<p>Please select a friend to view the chat.</p>";
}
?>
<style>
    .circle-image {
        width: 100%;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
    }
    .center-text {
        text-align: center;
        width: 100%;
        margin: 0 auto;
    }
</style>
