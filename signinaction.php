<?php

require "connect.php";

session_start();

if (isset($_POST["Submit"])) {
    $email = $_POST["useremail"];
    $pass = $_POST["userpass"];

    $query = "SELECT * FROM `userreg` WHERE useremail = '$email'";
    $delivery = mysqli_query($con, $query);

    if ($delivery) {
        $userFound = false;
        while ($row = mysqli_fetch_assoc($delivery)) {

            $db_id = $row["userid"];
            $db_name = $row["username"];
            $db_number = $row["usernumber"];
            $db_email = $row["useremail"];
            $db_pass = $row["userpass"];
            $db_role = $row["userrole"];
            $db_pfp = $row["userprofile"];
            $db_banner = $row["userbanner"];

            if ($email == $db_email && $pass == $db_pass) {
                $_SESSION["LoginId"] = $db_id;
                $_SESSION["LoginName"] = $db_name;
                $_SESSION["LoginNumber"] = $db_number;
                $_SESSION["LoginEmail"] = $db_email;
                $_SESSION["LoginPass"] = $db_pass;
                $_SESSION["LoginRole"] = $db_role;
                $_SESSION["LoginProfile"] = $db_pfp;
                $_SESSION["LoginBanner"] = $db_banner;

                if ($db_role == 'PLAYER') {
                    header('location:index.php');
                } elseif ($db_role == 'ADMIN') {
                    header('location:Dash/index.php');
                }
                exit();

            } else {
                $userFound = true;
            }
        }

        if ($userFound) {
            $_SESSION['error_message'] = 'Incorrect email or password.';
            header('location: signin.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Email not found.';
            header('location: signin.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Database query failed.';
        header('location: signin.php');
        exit();
    }
}
?>