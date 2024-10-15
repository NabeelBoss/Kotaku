<?php
require "connect.php"; // Include your database connection

session_start();

// Assuming you have the user's ID stored in the session
$userId = $_SESSION['user_id']; // Get the logged-in user's ID

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gamePrice = isset($_POST['gamePrice']) ? (int)$_POST['gamePrice'] : 0;

    // Check current tokens for the user
    $query = "SELECT gametoken FROM scores WHERE scoreplayer = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $userId);
    $stmt->execute();
    $stmt->bind_result($currentTokens);
    $stmt->fetch();
    $stmt->close();

    // Check if the user has enough tokens
    if ($currentTokens >= $gamePrice) {
        // Deduct tokens from the scores table
        $query = "UPDATE scores SET gametoken = gametoken - ? WHERE scoreplayer = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('is', $gamePrice, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Tokens deducted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to deduct tokens.']);
        }

        $stmt->close();
    } else {
        // If insufficient tokens, send a message
        echo json_encode(['success' => false, 'message' => 'Insufficient tokens.']);
    }
} else {
    // If request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$con->close();
?>
