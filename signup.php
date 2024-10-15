<?php require "header.php"; ?>

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -moz-appearance: textfield;
        -webkit-appearance: none;
        appearance: none;
    }
</style>


<!-- sign in section start  -->
<section class="sign-in-section pb-120 pt-120 mt-sm-15 mt-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="form-area">
                    <h1 class="tcn-1 text-center cursor-scale growUp mb-10">SIGN UP</h1>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger text-center mb-4">
                            <?php echo $_SESSION['error_message']; ?>
                            <?php unset($_SESSION['error_message']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="signupaction.php" method="POST" class="sign-in-form">
                        <div class="single-input mb-6">
                            <input type="text" placeholder="Enter your Username" name="username">
                        </div>
                        <div class="single-input mb-6">
                            <input type="number" placeholder="Enter your phone" name="usernumber">
                        </div>
                        <div class="single-input mb-6">
                            <input type="email" placeholder="Enter your email" name="useremail">
                        </div>
                        <div class="single-input mb-6">
                            <input type="password" placeholder="Enter your password" name="userpass">
                        </div>
                        <div class="text-center">
                            <button class="bttn py-3 px-6 rounded bgp-1" type="submit" name="Submit">Sign Up</button>
                        </div>
                    </form>
                    <p class="tcn-4 text-center mt-lg-10 mt-6">Already have an account? <a href="signin.php"
                            class="text-decoration-underline tcp-1">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sign in section end  -->

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


<!-- Mirrored from gameplex-final.vercel.app/gameplex-v1-smooth-scroll/signup.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2024 22:13:32 GMT -->

</html>