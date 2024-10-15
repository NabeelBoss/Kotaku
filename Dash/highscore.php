<?php
require 'header.php';
require 'database.php';

// Define the query
$query = "SELECT  ROW_NUMBER() OVER (ORDER BY scoreid ASC) AS row_number,  scores.scoreid, scores.score, userreg.userprofile AS player_image, userreg.username AS player_name, games.gamename AS game_name FROM scores INNER JOIN userreg ON scores.scoreplayer = userreg.userid INNER JOIN games ON scores.scoregame = games.gameid";

// Execute the query
$result = mysqli_query($con, $query);

// Check for SQL errors
if (!$result) {
    die("Error executing query: " . mysqli_error($con));
}
?>

<!-- Page Container -->
<div class="page-container">

    <!-- Page Content -->
    <div class="page-content">

        <!-- /Page Header -->
        <!-- Page Inner -->
        <div class="page-inner">
            <!-- Page Heading -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title mb-15">
                            <div class="d-flex justify-content-md-between justify-content-center py-2">
                                <div class="d-none d-md-block">
                                    <h3 class="breadcrumb-header">ALL SCORES</h3>
                                </div>
                                <div class="pull-right">
                                    <div class="btn-group mx-auto">
                                        <ol class="breadcrumb hide-phone m-0" id="breadcrumb-placeholder"
                                            data-breadcrumb="Dashboard / Scores">
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
                    <div class="col-lg-12">
                        <div class="card border mb-0">
                            <div class="card-body" style="border:2px solid lightgrey;">

                                <h4 class="mt-0 header-title border-bottom">SCORES</h4>

                                <div>
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>P.Image</th>
                                                <th>P.Name</th>
                                                <th>G.Name</th>
                                                <th>Score</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= htmlspecialchars($row['scoreid']) ?>
                                                </td>
                                                <td><img src="../<?= htmlspecialchars($row['player_image']) ?>"
                                                        alt="User Image" class="img-avatar"></td>
                                                <td class="text-capitalize">
                                                    <?= htmlspecialchars($row['player_name']) ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($row['game_name']) ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($row['score']) ?>
                                                </td>
                                                <td><a
                                                        href="deletescore.php?deleteid=<?= urlencode($row['scoreid']) ?>"><button
                                                            class="btn-deelete">Delete</button></a></td>
                                            </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No records found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Wrapper -->
        </div>

        <?php require 'footer.php'; ?>

    </div>
</div>

<!-- Add this CSS to your style sheet or within a <style> tag -->
<style>
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