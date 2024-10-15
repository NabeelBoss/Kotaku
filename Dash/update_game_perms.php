<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameid = $_POST['gameid'];
    $gameperms = $_POST['gameperms'];

    // Update the game permissions in the database
    $query = "UPDATE games SET gameperms = ? WHERE gameid = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $gameperms, $gameid);

    if ($stmt->execute()) {
        echo "Game permissions updated successfully.";
    } else {
        echo "Error updating game permissions: " . $stmt->error;
    }

    $stmt->close();
}
?>
