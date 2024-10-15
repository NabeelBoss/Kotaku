<?php
require "connect.php";
require "header.php";


?>

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
</style>


<!-- profile section start  -->
<section class="profile-banner-section pb-120 pt-120 mt-lg-0 mt-sm-15 mt-10">
    <div class="container position-relative">
        <div class="row">
            <div class="col-12 mb-lg-0 mb-10">
                <div class="parallax-banner-area parallax-container">
                    <form action="profileupdate.php?id=<?php echo $_SESSION["LoginId"] ?>" method="POST"
                        enctype="multipart/form-data">

                        <!-- Hidden file input for banner -->

                        <input type="file" name="userbannerimg" id="bannerFileInput" accept=".jpg, .jpeg, .png"
                            style="display: none;">

                        <div class="change-banner-btn position-absolute rounded top-0 end-0 mt-sm-10 mt-15 me-10 z-2"
                            id="changeBannerButton" style="cursor: pointer;">

                            <button type="submit" class="button box-style">
                                <i class="ti ti-settings fs-2xl"></i></button>
                        </div>

                        <div class="parallax-img profile-banner position-relative">

                            <img class="w-100 h-100 tbi rounded-5" src="<?php echo $_SESSION["LoginBanner"] ?>"
                                alt="profile banner">

                            <div class="user-profile d-between position-absolute z-1 w-100 px-xxl-15 px-md-10 px-sm-6">
                                <div class="d-flex align-items-center gap-sm-6 gap-3">

                                    <div class="profile-thumb position-relative">

                                        <img id="profileImage" class="w-100 rounded-circle"
                                            src="<?php echo $_SESSION["LoginProfile"] ?>" alt="team logo">

                                        <input type="file" name="userprofileimg" id="profileFileInput"
                                            accept=".jpg, .jpeg, .png" style="display: none;">

                                        <div class="change-profile-btn position-absolute text-white p-1 z-10"
                                            id="changeProfileButton" style="cursor: pointer;">
                                        </div>

                                    </div>

                                    <div class="user-details mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <h3 class="user-name" style="text-transform: capitalize">
                                                <?php echo $_SESSION["LoginName"] ?>
                                            </h3>
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
                    </form>
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
                <span class="display-four tcn-1 cursor-scale growUp mb-10 d-block title-anim">My Scores:</span>
                <div class="d-between p-lg-8 p-sm-3 bgn-4 rounded">
                    <?php
                    $sqli = "SELECT scores.score, games.gamename, userreg.username FROM scores 
                             JOIN games ON scores.scoregame = games.gameid 
                             JOIN userreg ON scores.scoreplayer = userreg.userid 
                             WHERE scores.scoreplayer = '$_SESSION[LoginId]'";

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












<!-- user earning section start -->
<section class="user-earning-section pb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="display-three tcn-1 cursor-scale growUp title-anim mb-lg-15 mb-sm-10 mb-6">
                    Account Deletion:
                </h2>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-lg-12">
                <div class="user-earning-area py-8 px-4 bgn-4 rounded">
                    <div class="d-between">
                        <h5 class="tcn-1 fs-three">Delete your account:</h5>
                        <div class="deletebtn">
                            <a href="profiledelete.php?id=<?php echo urlencode($_SESSION["LoginId"]); ?>"
                                class="claim-btn tcn-1">Delete</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- user earning section end -->


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