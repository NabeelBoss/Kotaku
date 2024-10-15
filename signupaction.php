<?php
require "connect.php";
session_start();

if (isset($_POST['Submit'])) {
    $username = trim($_POST['username']);
    $usernumber = trim($_POST['usernumber']);
    $useremail = trim($_POST['useremail']);
    $userpass = trim($_POST['userpass']);

    // Validation: Check if fields are not empty
    if (empty($username) || empty($usernumber) || empty($useremail) || empty($userpass)) {
        $_SESSION['error_message'] = "All fields are required!";
        header("Location: signup.php");
        exit();
    }

    // Validation: Username must be greater than 4 characters!
    if (strlen($username) < 4) {
        $_SESSION['error_message'] = "Username must be greater than 4 characters!";
        header("Location: signup.php");
        exit();
    }

    // Validation: Check if email contains '@' and a valid domain
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) || !preg_match("/@.*\..+/", $useremail)) {
        $_SESSION['error_message'] = "Please enter a valid email address!";
        header("Location: signup.php");
        exit();
    }

    // Validation: Check if the email is unique
    $query = "SELECT * FROM userreg WHERE useremail = '$useremail'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error_message'] = "Email already exists!";
            header("Location: signup.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Database query failed.";
        header("Location: signup.php");
        exit();
    }

    // If all validations pass, insert the new user into the database
    $insert_query = "INSERT INTO userreg (username, usernumber, useremail, userpass, userrole, userprofile, userbanner) 
                     VALUES ('$username', '$usernumber', '$useremail', '$userpass', 'PLAYER', 'assets/img/defaultuser.png', 'assets/img/profilebanner.png')";
    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
        $_SESSION['success_message'] = "Registration successful! Please sign in.";
        header("Location: signin.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Could not register. Please try again later.";
        header("Location: signup.php");
        exit();
    }
}
?>
