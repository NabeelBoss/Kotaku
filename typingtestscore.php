<?php
require "connect.php";
session_start();

if (isset($_POST['popupsubmitbtn'])) {
    $score = $_POST["score"];
    $tokens = $_POST["tokens"];
    $sessionid = $_SESSION["LoginId"];

    $query = "SELECT gameid FROM games WHERE gamename = 'Typing Speed Test'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $scoregame = $row['gameid'];

        $query = "INSERT INTO scores (score, scoreplayer, scoregame, gametoken) VALUES ('$score', '$sessionid', '$scoregame', '$tokens')";
        $mysql = mysqli_query($con, $query);

        if ($mysql) {
            header('Location: typingtest.php');
        } else {
            echo "<script>alert('Error inserting score')</script>";
        }
    } else {
        echo "<script>alert('Game not found')</script>";
    }
}
?>
