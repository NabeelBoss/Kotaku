<?php
require "database.php";

if (isset($_GET["deleteid"])) {
    $delete_id = $_GET["deleteid"];
    
    $delete_scores_query = "DELETE FROM scores WHERE scoreplayer = $delete_id";
    $delete_scores_result = mysqli_query($con, $delete_scores_query);
    
    if ($delete_scores_result === FALSE) {
        echo "Error deleting scores: " . mysqli_error($con);
    }
    
    $delete_user_query = "DELETE FROM userreg WHERE userid = $delete_id";
    $delete_user_result = mysqli_query($con, $delete_user_query);
    
    if ($delete_user_result) {
        header("Location: userlist.php");
        exit(); 
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
}
?>
