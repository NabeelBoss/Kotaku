<?php
require 'header.php';
require 'database.php';

$query = "SELECT * FROM games";
$result = mysqli_query($con, $query);
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
                                    <h3 class="breadcrumb-header">ALL GAMES</h3>
                                </div>
                                <div class="pull-right">
                                    <div class="btn-group mx-auto">
                                        <ol class="breadcrumb hide-phone m-0" id="breadcrumb-placeholder"
                                            data-breadcrumb="Dashboard / Games / Games List">
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

                                <h4 class="mt-0 header-title border-bottom">GAMELIST</h4>

                                <div>
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>URL</th>
                                                <th>Options</th>
                                                <th>Lock/Unlock</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?= htmlspecialchars($row['gameid']) ?>
                                                        </td>
                                                        <td><img src="../<?= htmlspecialchars($row['gameimage']) ?>"
                                                                alt="User Image" class="img-avatar"></td>
                                                        <td>
                                                            <?= htmlspecialchars($row['gamename']) ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($row['gameurl']) ?>
                                                        </td>
                                                        <td><a href="updategame.php?updateid=<?= urlencode($row['gameid']) ?>"><button
                                                                    class="btn-uppdate">Update</button></a>
                                                            <a href="deletegame.php?deleteid=<?= urlencode($row['gameid']) ?>"><button
                                                                    class="btn-deelete">Delete</button></a>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    id="lock-<?= htmlspecialchars($row['gameid']) ?>"
                                                                    data-gameid="<?= htmlspecialchars($row['gameid']) ?>"
                                                                    <?= $row['gameperms'] == 'locked' ? 'checked' : '' ?>
                                                                    onchange="updateGamePerms(this)" />
                                                                <label class="form-check-label"
                                                                    for="lock-<?= htmlspecialchars($row['gameid']) ?>"> Click me
                                                                    to Lock it</label>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <!-- Add more rows as needed -->
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

<script>
    function updateGamePerms(checkbox) {
        var gameId = checkbox.dataset.gameid; // Get game ID from data attribute
        var isChecked = checkbox.checked; // Check if it's checked

        // Determine new permissions value based on checkbox state
        var newPerms = isChecked ? 'locked' : 'unlocked';

        // Send AJAX request to update game permissions
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_game_perms.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // Handle response (optional)
            }
        };
        xhr.send("gameid=" + gameId + "&gameperms=" + newPerms);
    }
</script>


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