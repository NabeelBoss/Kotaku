<?php
session_start();
require "connect.php";

// Check if user is logged in
if (!isset($_SESSION["LoginId"])) {
    header("Location: signinaction.php");
    exit();
}

$id = $_SESSION['LoginId'];

$username = $_POST['username'];
$usernumber = $_POST['usernumber'];
$usermail = $_POST['useremail'];
$userpass = $_POST['userpass'];


$userprofile = $_FILES['userprofile']['name'];
$profile_tmp_name = $_FILES['userprofile']['tmp_name'];



$userbanner = $_FILES['userbanner']['name'];
$banner_tmp_name = $_FILES['userbanner']['tmp_name'];


$profile_folder = "assets/img/$userprofile";
$banner_folder = "assets/img/$userbanner";


if (move_uploaded_file($profile_tmp_name, $profile_folder) && move_uploaded_file($banner_tmp_name, $banner_folder)) {
    // Update user information in the database
    $update = mysqli_query($con, "UPDATE userreg SET 
        username='$username',
        usernumber='$usernumber',
        useremail='$usermail',
        userpass='$userpass',
        userprofile='$profile_folder',
        userbanner='$banner_folder' 
        WHERE userid=$id");

    if ($update) {
        // Update session variables to reflect changes
        $_SESSION['LoginProfile'] = $profile_folder;
        $_SESSION['LoginBanner'] = $banner_folder;

        // Redirect to profile page
        header("Location: profile.php");
    } else {
        echo '<script>alert("Your data was not updated")</script>';
    }
} else {
    header("Location: profile.php");
}
?>