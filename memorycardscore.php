<?php
require "connect.php";
session_start();

if (isset($_POST['popupsubmitbtn'])) {
    $score = $_POST["score"];
    $tokens = $_POST["token"];
    $sessionid = $_SESSION["LoginId"];

    $query = "SELECT gameid FROM games WHERE gamename = 'Memory Card'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $scoregame = $row['gameid'];

        $query = "INSERT INTO scores (score, scoreplayer, scoregame, gametoken) VALUES ('$score', '$sessionid', '$scoregame', '$tokens')";
        $mysql = mysqli_query($con, $query);

        if ($mysql) {
            header('Location: memorycards.php');
        } else {
            echo "<script>alert('Error inserting score and token')</script>";
        }
    } else {
        echo "<script>alert('Game not found')</script>";
    }
}
?>
