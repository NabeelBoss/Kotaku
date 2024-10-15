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

    .change-profile-btn .button {
        background-color: black;
        border-radius: 10px;
        border: none;

    }

    .change-profile-btn .button:hover {
        background-color: #F76D1F;
    }

    .change-profile-btn i {
        font-size: 1.3rem;
    }

    .change-banner-btn .button {
        background-color: black;
        border-radius: 10px;
        border: none;

    }

    .change-profile-btn .button:hover {
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

    form label{
        font-family: "Chakra Petch";
    }
</style>


<!-- connected accounts section start  -->
<section class="sign-in-section pb-120 pt-120 mt-sm-15 mt-10">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="display-four text-center tcn-1 cursor-scale growUp mb-10 d-block title-anim">Update
                    Account</span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="form-area">

                                <form action="updateprofile.php" method="POST" enctype="multipart/form-data"
                                    class="sign-in-form">

                                    
                                    <input type="hidden" name="id" value="<?php echo $_SESSION["LoginId"]; ?>" />
                                    <label class="fw-bold fs-5">Name</label>
                                    <div class="single-input mb-6">
                                        <input type="text" placeholder="Enter your Username" name="username"
                                            value="<?php echo $_SESSION['LoginName']; ?>" required>
                                    </div>
                                    <label class="fw-bold fs-5">Number</label>
                                    <div class="single-input mb-6">
                                        <input type="number" placeholder="Enter your phone" name="usernumber"
                                            value="<?php echo $_SESSION['LoginNumber']; ?>" required>
                                    </div>
                                    <label class="fw-bold fs-5">Email</label>
                                    <div class="single-input mb-6">
                                        <input type="email" placeholder="Enter your email" name="useremail"
                                            value="<?php echo $_SESSION['LoginEmail']; ?>" required>
                                    </div>
                                    <label class="fw-bold fs-5">Password</label>
                                    <div class="single-input mb-6">
                                        <input type="password" placeholder="Enter your password" name="userpass"
                                            value="<?php echo $_SESSION['LoginPass']; ?>" required>
                                    </div>
                                    <label class="fw-bold fs-5">Profile</label>
                                    <div class="single-input mb-6">
                                        <input type="file" name="userprofile"
                                            value="<?php echo $_SESSION['LoginProfile']; ?>" required>
                                    </div>
                                    <label class="fw-bold fs-5">Banner</label>
                                    <div class="single-input mb-6">
                                        <input type="file" name="userbanner"
                                            value="<?php echo $_SESSION['LoginBanner']; ?>" required>
                                    </div>
                                    <div class="text-center">
                                        <button class="bttn py-3 px-6 rounded bgp-1" type="submit"
                                            name="Submit">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- connected accounts section end  -->




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