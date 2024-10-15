<?php
require "connect.php";
require "header.php";

$user_id = isset($_GET['userid']) ? intval($_GET['userid']) : 0;

$logged_in_user_id = isset($_SESSION['LoginId']) ? intval($_SESSION['LoginId']) : 0;

if ($user_id === 0 || $logged_in_user_id === 0) {
    die("Invalid user ID.");
}

// Fetch user information (profile and banner)
$sqlii = "SELECT userid, username, userprofile, userbanner FROM userreg WHERE userid = $user_id";
$resultt = mysqli_query($con, $sqlii);
$userr = mysqli_fetch_assoc($resultt);

if (!$userr) {
    die("User not found.");
}

// Check if the logged-in user is friends with the profile user
$checkFriendship = "SELECT * FROM friends WHERE (user_one = $logged_in_user_id AND user_two = $user_id) 
                    OR (user_one = $user_id AND user_two = $logged_in_user_id)";
$friendResult = mysqli_query($con, $checkFriendship);
$isFriend = mysqli_num_rows($friendResult) > 0;

?>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</body>

<style>
    .profile-thumb {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .profile-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        overflow: hidden;
    }

    .change-profile-btn {
        top: -17px;
        right: 5px;
        background: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
    }

    .change-profile-btn button {
        background-color: black;
        border-radius: 10px;
        border: none;

    }

    .change-profile-btn button:hover {
        background-color: #F76D1F;
    }

    .change-profile-btn i {
        font-size: 1.3rem;
    }

    .change-banner-btn button {
        background-color: black;
        border-radius: 10px;
        border: none;

    }

    .change-profile-btn button:hover {
        background-color: #F76D1F;
    }

    .deletebtn a {
        color: white;
        background-color: #C41E3A;
    }

    .deletebtn a:hover {
        background-color: #811331;
    }

    .deletebtn:active {
        transform: scale(0.97);
    }





    .display-four {
        border-bottom: 2px solid rgb(var(--orange));
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    /* Table styles */
    .table-container {
        border: 1px solid rgb(var(--dark-gray));
        border-radius: 10px;
        overflow: hidden;
        background-color: rgb(var(--background));
    }

    .connected-accounts {
        color: rgb(255, 165, 0);
    }



    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table thead th {
        background-color: rgb(34, 34, 34);
        color: rgb(255, 255, 255);
        padding: 15px;
        border-bottom: 2px solid rgb(255, 165, 0);
    }

    .table tbody td {
        background-color: rgb(50, 50, 50);
        color: rgb(255, 255, 255);
        padding: 15px;
        border-bottom: 1px solid rgb(34, 34, 34);
    }

    .table tbody tr:nth-child(even) {
        background-color: rgb(34, 34, 34);
    }

    .user-cross-icon {
        color: white;
    }
</style>


<?php


$sqlii = "SELECT userid, username, userprofile, userbanner FROM userreg WHERE userid = $user_id";
$resultt = mysqli_query($con, $sqlii);
$userr = mysqli_fetch_assoc($resultt);

if (!$userr) {
    die("User not found.");
}
?>


<!-- profile section start  -->
<section class="profile-banner-section pb-120 pt-120 mt-lg-0 mt-sm-15 mt-10">
    <div class="container position-relative">
        <div class="row">
            <div class="col-12 mb-lg-0 mb-10">
                <div class="parallax-banner-area parallax-container">
                    <div class="parallax-img profile-banner position-relative">
                        <img class="w-100 h-100 tbi rounded-5"
                            src="<?php echo htmlspecialchars($userr['userbanner']); ?>" alt="profile banner">

                        <div class="user-profile d-between position-absolute z-1 w-100 px-xxl-15 px-md-10 px-sm-6">
                            <div class="d-flex align-items-center gap-sm-6 gap-3">
                                <div class="profile-thumb position-relative">
                                    <img id="profileImage" class="w-100 rounded-circle"
                                        src="<?php echo htmlspecialchars($userr['userprofile']); ?>" alt="team logo">

                                    <input type="file" name="userprofileimg" id="profileFileInput"
                                        accept=".jpg, .jpeg, .png" style="display: none;">

                                    <div class="change-profile-btn position-absolute text-white p-1 z-10"
                                        id="changeProfileButton" style="cursor: pointer;">
                                    </div>
                                </div>

                                <div class="user-details mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <h3 class="user-name" style="text-transform: capitalize">
                                            <?php echo htmlspecialchars($userr['username']); ?>
                                        </h3>

                                        <!-- Dynamic Friend/Unfriend Button -->
                                        <div class="edit-btn">
                                            <?php if ($isFriend): ?>

                                                <a
                                                    href="unfriend.php?user_id=<?php echo htmlspecialchars($userr['userid']); ?>">
                                                    <i class="fa-solid fa-user-minus fs-2xl"></i>

                                                </a>
                                            <?php else: ?>
                                                <?php
                                                $checkRequest = "SELECT * FROM frnd_req WHERE sender_id = $logged_in_user_id AND receiver_id = $user_id";
                                                $requestResult = mysqli_query($con, $checkRequest);

                                                if (mysqli_num_rows($requestResult) > 0): ?>
                                                    <a href="cancel_request.php?user_id=<?php echo htmlspecialchars($userr['userid']); ?>"
                                                        title="Cancel Friend Request">
                                                        <i class="fas fa-user-times fs-2xl"></i>
                                                    </a>


                                                <?php else: ?>
                                                    <a href="addfriend.php?user_id=<?php echo htmlspecialchars($userr['userid']); ?>"
                                                        title="Send Friend Request">
                                                        <i class="fas fa-user-plus fs-2xl"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>


                                    </div>

                                    <ul class="user-social d-flex align-items-center gap-sm-3 gap-1">
                                        <li class="box-style"> <a href="#"><i
                                                    class="ti ti-brand-facebook fs-2xl"></i></a>
                                        </li>
                                        <li class="box-style"> <a href="#"><i
                                                    class="ti ti-brand-twitter fs-2xl"></i></a></li>
                                        <li class="box-style"> <a href="#"><i
                                                    class="ti ti-brand-instagram fs-2xl"></i></a>
                                        </li>
                                        <li class="box-style"> <a href="#"><i
                                                    class="ti ti-brand-discord fs-2xl"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- profile section end  -->








<section class="connected-accounts pb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success text-center mb-4">
                        <?php echo htmlspecialchars($_SESSION['message']); ?>
                        <?php unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger text-center mb-4">
                        <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                        <?php unset($_SESSION['error_message']); ?>
                    </div>
                <?php endif; ?>

                <span
                    class="display-four tcn-1 cursor-scale growUp mb-10 d-block title-anim text-uppercase"><?php echo htmlspecialchars($userr['username']); ?>
                    Scores:</span>
                <div class="d-between p-lg-8 p-sm-3 bgn-4 rounded">
                    <?php

                    $sqli = "SELECT scores.score, games.gamename, userreg.username 
                             FROM scores 
                             JOIN games ON scores.scoregame = games.gameid 
                             JOIN userreg ON scores.scoreplayer = userreg.userid 
                             WHERE scores.scoreplayer = $user_id";

                    $result = mysqli_query($con, $sqli);

                    if ($result && mysqli_num_rows($result) > 0) {
                        ?>

                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Player</th>
                                    <th>Score</th>
                                    <th>Games</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                while ($userscore = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td scope="row"><?php echo $count++; ?></td>
                                        <td class="text-capitalize"><?php echo htmlspecialchars($userscore['username']); ?></td>
                                        <td><?php echo htmlspecialchars($userscore['score']); ?></td>
                                        <td><?php echo htmlspecialchars($userscore['gamename']); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                    } else {
                        ?>
                        <p>No scores found for this user.</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
mysqli_close($con);
?>









<?php require "footer.php"; ?>

<!-- ==== js dependencies start ==== -->
<!-- jquery  -->
<script src="assets/js/jquery.min.js"></script>
<!-- gsap  -->
<script src="assets/js/gsap.min.js"></script>
<!-- gsap scroll trigger -->
<script src="assets/js/ScrollTrigger.min.js"></script>
<!-- lenis  -->
<script src="assets/js/lenis.min.js"></script>
<!-- gsap split text -->
<script src="assets/js/SplitText.min.js"></script>
<!-- tilt js -->
<script src="assets/js/vanilla-tilt.js"></script>
<!-- scroll magic -->
<script src="assets/js/ScrollMagic.min.js"></script>
<!-- animation.gsap -->
<script src="assets/js/animation.gsap.min.js"></script>
<!-- gsap customization  -->
<script src="assets/js/gsap-customization.js"></script>
<!-- apex chart  -->
<script src="assets/js/apexcharts.js"></script>
<!-- swiper js -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- magnific popup  -->
<script src="assets/js/magnific-popup.js_1.1.0_jquery.magnific-popup.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- main js  -->
<script src="assets/js/main.js"></script>

</body>

</html>