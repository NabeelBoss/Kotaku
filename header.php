<?php
require "connect.php";
session_start();

// Check if the user is logged in
if (isset($_SESSION["LoginId"])) {
    $scoreplayer = $_SESSION["LoginId"];

    $query = "SELECT SUM(gametoken) AS total_gametoken FROM scores WHERE scoreplayer = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $scoreplayer);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $total_gametoken = $row['total_gametoken'] ? $row['total_gametoken'] : 0;

    $stmt->close();

} else {
    $total_gametoken = 0;
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logoo2.png" type="image/x-icon">
    <title>Kotaku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<style>
    .menu-link a {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: inherit;

    }


    @media (max-width: 991px) {
        .menu-link {
            width: 100%;
            text-align: center;
        }

        .menu-link a {
            justify-content: start;
        }
    }


    @media (max-width: 991px) {
        .menu-link {
            margin-left: 0 !important;
        }
    }

    .montserrat-alternates-thin {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 100;
        font-style: normal;
    }

    .montserrat-alternates-extralight {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 200;
        font-style: normal;
    }

    .montserrat-alternates-light {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 300;
        font-style: normal;
    }

    .montserrat-alternates-regular {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .montserrat-alternates-medium {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 500;
        font-style: normal;
    }

    .montserrat-alternates-semibold {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 600;
        font-style: normal;
    }

    .montserrat-alternates-bold {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 700;
        font-style: normal;
    }

    .montserrat-alternates-extrabold {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 800;
        font-style: normal;
    }

    .montserrat-alternates-black {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 900;
        font-style: normal;
    }

    .montserrat-alternates-thin-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 100;
        font-style: italic;
    }

    .montserrat-alternates-extralight-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 200;
        font-style: italic;
    }

    .montserrat-alternates-light-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 300;
        font-style: italic;
    }

    .montserrat-alternates-regular-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 400;
        font-style: italic;
    }

    .montserrat-alternates-medium-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 500;
        font-style: italic;
    }

    .montserrat-alternates-semibold-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 600;
        font-style: italic;
    }

    .montserrat-alternates-bold-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 700;
        font-style: italic;
    }

    .montserrat-alternates-extrabold-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 800;
        font-style: italic;
    }

    .montserrat-alternates-black-italic {
        font-family: "Montserrat Alternates", sans-serif;
        font-weight: 900;
        font-style: italic;
    }

    .bgp-1 {
        background: rgb(var(--p1));
    }




    .logout {
        background: #f6571e;
        padding: 0.5rem 1.5rem;
        text-decoration: none;
        border: none;
        position: relative;
        border-radius: 50px;
        z-index: 1;
        margin-bottom: 20px;
        color: white;
        font-size: 1rem;
    }

    .logout::before {
        content: '';
        position: absolute;
        top: -8px;
        bottom: -8px;
        left: -8px;
        right: -8px;
        border-top: 4px solid transparent;
        border-bottom: 4px solid transparent;
        border-left: 4px solid #f6571e;
        border-right: 4px solid #f6571e;
        border-radius: 50px;
        z-index: -1;
        transition: border-color 0.3s ease;
    }

    .logout:hover::before {
        border-top: 4px solid #f6571e;
        border-bottom: 4px solid #f6571e;
        border-left: 4px solid #f6571e;
        border-right: 4px solid #f6571e;
    }

    @media (max-width: 991px) {

        .mainlinkk {
            margin-left: 0 !important;
        }

    }
</style>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <span></span>
        </div>
    </div>


    <!-- cursor effect-->
    <div class="cursor"></div>
    <!-- Header area  -->



    <!-- header-section start -->
    <header class="header-section w-100">
        <div class="py-sm-6 py-3 mx-xxl-20 mx-md-15 mx-3">
            <div class="d-flex align-items-center justify-content-between gap-xxl-10 gap-lg-8 w-100">
                <nav
                    class="navbar-custom d-flex gap-lg-6 align-items-center flex-column flex-lg-row justify-content-start justify-content-lg-between w-100">
                    <div class="top-bar w-100 d-flex align-items-center gap-lg-0 gap-6">
                        <button class="navbar-toggle-btn d-block d-lg-none" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <a class="navbar-brand d-flex align-items-center gap-4" href="index.php">
                            <img class="w-100 logo1" src="assets/img/logoo2.png" alt="logo"
                                style="height: auto; width: 200px !important;">
                            <span
                                style="font-family: Montserrat Alternates, sans-serif;font-style: italic; font-weight: 600; ">KOTAKU</span>
                        </a>
                    </div>
                    <div class="navbar-toggle-item w-100 position-lg-relative">
                        <ul class="custom-nav gap-5 cursor-scale growDown2 ms-xxl-10" data-lenis-prevent>

                            <?php if (isset($_SESSION["LoginEmail"])) { ?>

                                <li class="menu-link mainlinkk" style="margin-left: -168px;">
                                    <a href="index.php">
                                        <i class="ti ti-home fs-2xl"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="menu-link">
                                    <a href="game.php"><i class="ti ti-device-gamepad fs-2xl"></i>Games</a>
                                </li>
                                <li class="menu-link">
                                    <a href="all-players.php"><i class="ti ti-users fs-2xl"></i>Players</a>
                                </li>
                                <li class="menu-link">
                                    <a href="signup.php"><i class="ti ti-user-plus fs-2xl"></i>Signup</a>
                                </li>

                            <?php } else { ?>

                                <li class="menu-link ">
                                    <a href="index.php" class="mainlinkk" style="margin-left: -170px;"><i
                                            class="ti ti-home fs-2xl"></i>Home</a>
                                </li>
                                <li class="menu-link">
                                    <a href="terms-condition.php"><i
                                            class="ti ti-info-circle fs-2xl"></i>Terms-Condition</a>
                                </li>

                            <?php }
                            ; ?>

                        </ul>
                    </div>
                </nav>
                <div class="header-btn-area d-flex align-items-center gap-sm-6 gap-3">
                    <?php if (isset($_SESSION["LoginEmail"])) { ?>
                        <div class="header-profile pointer">
                            <div class="profile-wrapper d-flex align-items-center gap-3">
                                <div class="img-area overflow-hidden">
                                    <img class="w-100" src="<?php echo $_SESSION["LoginProfile"] ?>" alt="profile">
                                </div>
                                <span class="user-name d-none d-xxl-block text-nowrap"
                                    style="text-transform: capitalize"><?php echo $_SESSION["LoginName"]; ?></span>
                                <i class="ti ti-chevron-down d-none d-xxl-block"></i>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="menu-link">
                            <a href="signin.php"><i class="ti ti-login fs-2xl"></i>Login</a>
                        </div>
                    <?php }
                    ; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- header-section end -->





    <!-- user account details popup start  -->
    <div class="user-account-popup p-4">
        <div class="account-items d-grid gap-1" data-tilt>
            <div class="user-level-area p-3">
                <div class="user-info d-between">
                    <!-- Display the logged-in user's name -->
                    <span class="user-name fs-five" style="text-transform: capitalize">
                        <?php echo $_SESSION["LoginName"]; ?>
                    </span>

                    <!-- Display the total gametokens -->
                    <span style="color: gold;">
                        <i class="fas fa-coins"></i>
                        <?php echo $total_gametoken; ?>
                    </span>
                </div>
            </div>
            <a href="profile.php" class="account-item">View Profile</a>
            <a href="chat.php" class="account-item">Messages</a>
            <a href="friends.php" class="account-item">Friends</a>
            <button class="bttn account-item" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>
    <!-- user account details popup end  -->