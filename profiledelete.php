<?php

require 'connect.php';

if (isset($_GET["id"])) {
    
    $id = $_GET["id"];

    $sql_delete_scores = "DELETE FROM `scores` WHERE scoreplayer = $id";
    if ($con->query($sql_delete_scores) === FALSE) {
        die("Error deleting scores: " . $con->error);
    }

    $sql_delete_user = "DELETE FROM `userreg` WHERE userid = $id";
    if ($con->query($sql_delete_user) === FALSE) {
        die("Error deleting user: " . $con->error);
    }
}

session_start();
session_unset();
session_destroy();

header('Location: index.php');
exit();

?>
