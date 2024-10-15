<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-layout="vertical">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Kotaku | Dashboard</title>

    <link rel="shortcut icon" href="assets/images/favi.png" type="image/x-icon">
    <!-- scrollbar -->
    <link rel="stylesheet" href="assets/css/plugins/simplebar.min.css">
    <!-- Icon Css -->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">

    <link href="assets/js/plugins/uniform/css/default.css" rel="stylesheet" />
    <link href="assets/js/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />


    <!-- Apex Chart Css -->
    <link type="text/html" href="assets/css/plugins/apexcharts.css" rel="stylesheet" />

</head>
<style>
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
</style>

<body>

    <!-- Page Header -->
    <div class="page-header">

        <nav class="navbar navbar-expand-lg navbar-default border bg-body-tertiary py-0">
            <div class="container-fluid" style="border:2px solid lightgrey">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-header d-lg-none">
                        <div class="logo-sm">
                            <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <ul class="nav navbar-nav d-none d-lg-flex mb-2 mb-lg-0">
                            <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i
                                        class="mdi mdi-menu"></i></a></li>

                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="dropdown topbar-head-dropdown header-item">
                            <a class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle border-0"
                                href="javascript:void(0)" id="theme-toggle-switch">
                                <i class="mdi mdi-weather-night fs-20"></i>
                            </a>
                        </div>

                        <div class="dropdown ms-1 user-dropdown header-item">
                            <a class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle border-0 dropdown-toggle"
                                href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false"><img
                                    src="../<?php echo $_SESSION["LoginProfile"]?>" alt="" class="rounded-circle img-fluid"></a>
                            <ul class="dropdown-menu dropdown-menu-end" style="border:2px solid lightgrey">
                                <li style="padding: 0;">
                                    <a href="profile.php"
                                        style="display: flex; justify-content: center; align-items: center; padding: 10px 20px; text-decoration: none; font-size: 18px; font-weight: 600; color: inherit; width: 100%; height: 50%;">Profile</a>
                                </li>
                                <li style="padding: 0;">
                                    <a href="logout.php"
                                        style="display: flex; justify-content: center; align-items: center; padding: 10px 20px; text-decoration: none; font-size: 16px; font-weight: 600; color: white; background: red; width: 100%; height: 50%;">LOGOUT</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
    <!-- /Page Header -->

    <!-- Page Sidebar -->
    <div class="page-sidebar" style="border:2px solid lightgrey">
        <a class='logo-box' href='index.php'>
            <span>
                <img src="assets/images/logoo2.png" alt="" height="55" width="55"
                    style="margin-top: -8px; margin-left: -15px;">
                <span style="font-family: Montserrat Alternates, sans-serif;font-style: italic; font-weight: 600; ">KOTAKU</span>
            </span>
            <i class="mdi mdi-close" id="sidebar-toggle-button-close"></i>
        </a>
        <div class="page-sidebar-inner">
            <div class="page-sidebar-menu simple-bar" data-Current-Page=index data-simplebar>
                <ul class="accordion-menu">
                    <li class="accordion-menu-item">
                        <a data-page='index' href='index.php'>
                            <i class="menu-icon mdi mdi-home"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="accordion-menu-item">
                        <a href="userlist.php">
                            <i class="menu-icon mdi mdi-clipboard-outline"></i><span>User List</span>
                        </a>
                    </li>
                    <li class="accordion-menu-item">
                        <a href="javascript:void(0);">
                            <i class="menu-icon mdi mdi-table"></i><span>Games</span><i
                                class="accordion-icon fa fa-angle-right"></i>
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item"><a data-page='tables-footable' href='addgame.php'>Add Game
                                </a></li>
                            <li class="sub-menu-item"><a data-page='tables-responsive' href='gamelist.php'>Games
                                    List</a></li>
                        </ul>
                    </li>
                    <li class="accordion-menu-item">
                        <a href="highscore.php ">
                            <i class="menu-icon mdi mdi-star"></i><span>Scores</span>
                        </a>
                    </li>



                </ul>
            </div>
            <div class="help-box text-center ">
                <form action="logout.php" method="POST">
                    <button type="submit" name="logout" class="logout">LOGOUT</button>
                </form>
            </div>
        </div>
    </div>

    <!-- /Page Sidebar -->