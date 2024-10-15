<?php

require 'header.php';
require 'database.php';

?>


<!-- Page Content -->
<div class="page-content">
    <!-- Page Inner -->
    <div class="page-inner">
        <!-- Page Heading -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title mb-15">
                        <div class="d-flex justify-content-md-between justify-content-center py-2">
                            <div class="d-none d-md-block">
                                <h3 class="breadcrumb-header">Dashboard</h3>
                            </div>
                            <div class="pull-right">
                                <div class="btn-group mx-auto">
                                    <ol class="breadcrumb hide-phone m-0" id="breadcrumb-placeholder"
                                        data-breadcrumb="Admin / Dashborad">
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="container-fluid" id="main-wrapper">
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="card border">
                        <div class="card-body widget-desk" style=" border:2px solid lightgrey; border-radius:6px;">
                            <div class="pull-right">
                                <?php
                                $query = "SELECT COUNT(*) AS total_users FROM userreg;";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                <h4 class="text-center mt-0 mb-0 fw-bold">
                                    <?= htmlspecialchars($row['total_users']) ?>
                                </h4>
                                <?php
                                    }
                                }
                                ?>
                                <p class="text-muted mb-0">Total Users</p>
                            </div>
                            <div class="widget-icon">
                                <i class="mdi mdi-eye"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card border">
                        <div class="card-body widget-desk" style="border:2px solid lightgrey; border-radius:6px;">
                            <div class="pull-right">
                                <?php
                                $queryy = "SELECT COUNT(*) AS total_games FROM games;";
                                $resultt = mysqli_query($con, $queryy);
                                if (mysqli_num_rows($resultt) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultt)) {
                                ?>
                                <h4 class="text-center mt-0 mb-0 fw-bold">
                                    <?= htmlspecialchars($row['total_games']) ?>
                                </h4>
                                <?php
                                    }
                                }
                                ?>
                                <p class="text-muted mb-0">Total Games</p>
                            </div>
                            <div class="widget-icon">
                                <i class="mdi mdi-sale"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12  col-xl-4">
                    <div class="card border ">
                        <div class="card-body widget-desk" style=" border:2px solid lightgrey; border-radius:6px;">
                            <div class="pull-right">
                                <?php
                                $quueryy = "SELECT MAX(score) AS high_score FROM scores;";
                                $reesultt = mysqli_query($con, $quueryy);
                                if (mysqli_num_rows($resultt) > 0) {
                                    while ($row = mysqli_fetch_assoc($reesultt)) {
                                ?>
                                <h4 class="text-center mt-0 mb-0 fw-bold">
                                    <?= htmlspecialchars($row['high_score']) ?>
                                </h4>
                                <?php
                                    }
                                }
                                ?>
                                <p class="text-muted mb-0">Current H.Score</p>
                            </div>
                            <div class="widget-icon">
                                <i class="mdi mdi-chart-line"></i>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-4">
                    <div class="card border mb-xl-0">
                        <div class="card-body"
                            style="border:2px solid lightgrey; background:#fdbe94; border-radius:6px;">
                            <h4 class="header-title border-bottom mb-24 mt-0" style="color:black;">Top Players</h4>
                            <div class="table-responsive">
                                <table class="table mb-0" >
                                    <thead>
                                        <tr
                                            style="font-size: 20px; text-align: start; height: 58px; vertical-align: middle;">
                                            <th scope="col" style="min-width: 50px;color:black;">No</th>
                                            <th scope="col" style="min-width: 100px;color:black;">Name</th>
                                            <th scope="col" style="min-width: 100px;color:black;">Scores</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $quuueryy = "
                                            WITH RankedScores AS (
                                                SELECT 
                                                    userreg.username, 
                                                    userreg.userprofile, 
                                                    scores.score, 
                                                    scores.scoreid, 
                                                    scores.scoregame AS gameid,
                                                    ROW_NUMBER() OVER (PARTITION BY userreg.userid ORDER BY scores.score DESC) AS rank
                                                FROM scores
                                                JOIN games ON scores.scoregame = games.gameid
                                                JOIN userreg ON scores.scoreplayer = userreg.userid
                                            ),
                                            SequentialGameIDs AS (
                                                SELECT
                                                    gameid,
                                                    ROW_NUMBER() OVER (ORDER BY gameid) AS sequential_gameid
                                                FROM (SELECT DISTINCT gameid FROM RankedScores) AS UniqueGames
                                            ),
                                            RankedWithSequentialID AS (
                                                SELECT
                                                    username,
                                                    userprofile,
                                                    score,
                                                    scoreid,
                                                    sequential_gameid AS gameid,
                                                    ROW_NUMBER() OVER (ORDER BY score DESC) AS display_id
                                                FROM RankedScores
                                                JOIN SequentialGameIDs ON RankedScores.gameid = SequentialGameIDs.gameid
                                                WHERE RankedScores.rank = 1
                                            )
                                            SELECT 
                                                username, 
                                                userprofile, 
                                                score, 
                                                display_id AS scoreid, 
                                                gameid
                                            FROM RankedWithSequentialID
                                            ORDER BY score DESC
                                            LIMIT 5;
                                            ";
                                            
                                        $reeesultt = mysqli_query($con, $quuueryy);
                                        if (mysqli_num_rows($reeesultt) > 0) {
                                            while ($row = mysqli_fetch_assoc($reeesultt)) {
                                        ?>
                                        <tr
                                            style="font-size: 18px; font-weight: 600;text-align:start; height: 58px; vertical-align: middle;">
                                            <td style="text-align:left; min-width: 50px;color:black;">
                                                <?= htmlspecialchars($row['scoreid']) ?>
                                            </td>
                                            <td style=" min-width: 100px;color:black;">
                                                <?= htmlspecialchars($row['username']) ?>
                                            </td>
                                            <td style=" min-width: 100px;color:black;">
                                                <?= htmlspecialchars($row['score']) ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card border mb-0">
                        <div class="card-body" style=" border:2px solid lightgrey; border-radius:6px">

                            <h4 class="header-title border-bottom mb-24 mt-0">High Scores</h4>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Game</th>
                                            <th scope="col">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $quuueryy = "SELECT scores.scoreid, scores.score,ROW_NUMBER() OVER (ORDER BY score DESC) AS scoreid, userreg.userprofile AS player_image, userreg.username AS player_name, games.gamename AS game_name FROM scores INNER JOIN userreg ON scores.scoreplayer = userreg.userid INNER JOIN games ON scores.scoregame = games.gameid ORDER BY score DESC LIMIT 4";
                                        $reeesultt = mysqli_query($con, $quuueryy);
                                        if (mysqli_num_rows($reeesultt) > 0) {
                                            while ($row = mysqli_fetch_assoc($reeesultt)) {
                                        ?>

                                        <tr>
                                            <th scope="row">
                                                <?= htmlspecialchars($row['scoreid']) ?>
                                            </th>
                                            <td><img src="../<?= htmlspecialchars($row['player_image']) ?>"
                                                    alt="User Image" class="img-avatar"></td>
                                            <td>
                                                <?= htmlspecialchars($row['player_name']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($row['game_name']) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($row['score']) ?>
                                            </td>
                                        </tr>

                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- Main Wrapper -->
    </div>

    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        .custom-table thead th {
            padding: 12px;
            font-size: 16px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        .custom-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .img-avatar {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .btn-uppdate {
            background-color: #007bff;
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-uppdate:hover {
            background-color: #0056b3;
        }

        .btn-deelete {
            background-color: #dc3545;
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-deelete:hover {
            background-color: #c82333;
        }
    </style>
    <?php require 'footer.php'; ?>