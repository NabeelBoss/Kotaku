<?php
require 'header.php';
require 'database.php';

$userid = $_SESSION["LoginId"];

$query = "SELECT * FROM userreg WHERE userid = $userid";
$result = mysqli_query($con, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($con);
    exit;
}
?>

<style>
body {
    margin: 0;
    padding: 0;
}

.page-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.page-content {
    flex: 1;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.page-inner {
    width: 100%;
    max-width: 800px;
    padding: 0;
    background-color: lightgrey;
    border-radius: 12px;
    border: 2px solid lightgrey;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.cover-photo {
    width: 100%;
    height: 200px;
    background-image: url('../<?= htmlspecialchars($user['userbanner']) ?>');
    background-size: cover;
    background-position: center;
    border-radius: 12px 12px 0 0;
    position: relative;
}

.profile-image-container {
    position: relative;
    margin-top: -75px;
    width: 100%;
    display: flex;
    justify-content: center;
}

.profile-image-container img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 5px solid #f6571e;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.profile-details {
    padding: 20px;
    width: 100%;
    background-color: lightgrey;
    border-radius: 12px;
    border: 2px solid lightgrey;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-details h2 {
    margin: 0 0 20px;
    font-size: 1.75rem;
    color: #333;
    text-align: center;
}

.profile-details label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
    color: #666;
}

.profile-details input {
    display: block;
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: none;
    border-radius: 8px;
    background: transparent;
    font-size: 1rem;
    color: #333;
}

.profile-details button {
    padding: 10px 20px;
    background-color: #f6571e;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    margin-top: 20px;
}

.profile-details button:hover {
    background-color: #e24e1b;
}

</style>

<div class="page-container">
    <div class="page-content">
        <div class="page-inner" style="margin-bottom:60px;">
            <div class="cover-photo"></div>
            <div class="profile-image-container">
                <img src="../<?= htmlspecialchars($user['userprofile']) ?>" alt="Profile Image">
            </div>

            <div class="profile-details">
                <h2><?= htmlspecialchars($user['username']) ?>'s Profile</h2>
                <form action="updateadmin.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['useremail']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" id="password" name="password" value="<?= htmlspecialchars($user['userpass']) ?>" readonly>
                    </div>

                    <button type="submit" name="update">Update</button>
                </form> 
            </div>
        </div>

        <?php require 'footer.php'; ?>
    </div>
</div>

