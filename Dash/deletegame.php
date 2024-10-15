<?php
require "database.php";

if (isset($_GET["deleteid"])) {
    $delete_id = $_GET["deleteid"];
    
    $query = "DELETE FROM games WHERE gameid = $delete_id";
    
    $result = mysqli_query($con, $query);
    
    if ($result) {
        header("Location: gamelist.php");
        exit(); 
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
}
?>