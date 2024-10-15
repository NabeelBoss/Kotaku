<?php
session_start();
require "connect.php";

    if (isset($_POST['submittt'])) {
        $message = $_POST['message'];
        $sender_id = $_SESSION["LoginId"];
        $receiver_id = $_POST['receiver_id'];

        $queryinsert = "INSERT INTO `chat`(`message_text`, `sender_id`, `receiver_id`) VALUES ('$message','$sender_id','$receiver_id')";
        $dbsend = mysqli_query($con, $queryinsert);

        if (!$dbsend) {
            echo "Input data not sent to database: " . mysqli_error($con);
        } else {
            header("Location: chat.php");
            exit; 
        }
    }
?>