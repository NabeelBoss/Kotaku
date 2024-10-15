<?php
require "header.php";
require "connect.php";

$query = "SELECT * FROM games WHERE gameperms = 'unlocked'";
$result = mysqli_query($con, $query);

$scndquery = "SELECT * FROM games WHERE gameperms = 'locked'";
$scndresult = mysqli_query($con, $scndquery);
?>

<section class="game-section pb-120 pt-120 mt-lg-0 mt-sm-15 mt-10">
    <div class="container">
        <div class="row align-items-center justify-content-between mb-lg-15 mb-md-8 mb-sm-6 mb-4">
            <div class="col-6">
                <h2 class="display-four tcn-1 cursor-scale growUp title-anim">Games</h2>
            </div>
        </div>
        <div class="row gy-lg-10 gy-6">

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="game-card-wrapper mx-auto">
                            <div class="game-card mb-5 p-2">
                                <div class="game-card-border"></div>
                                <div class="game-card-border-overlay"></div>
                                <div class="game-img">
                                    <img class="w-100 h-100" src="<?= htmlspecialchars($row['gameimage']) ?>" alt="game">
                                </div>
                                <div class="game-link d-center">
                                    <a href="<?= htmlspecialchars($row['gameurl']) ?>" class="btn2">
                                        <i class="ti ti-arrow-right fs-2xl"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="<?= htmlspecialchars($row['gameurl']) ?>">
                                <h4 class="game-title mb-0 tcn-1 cursor-scale growDown2 title-anim">
                                    <?= htmlspecialchars($row['gamename']) ?>
                                </h4>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12"><p>No unlocked games available.</p></div>';
            }
            if (mysqli_num_rows($scndresult) > 0) {
                while ($row = mysqli_fetch_assoc($scndresult)) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="game-card-wrapper mx-auto" style="position: relative;">
                            <div class="game-card mb-5 p-2">
                                <div class="game-card-border" style="background: rgb(var(--p1));"></div>
                                <div class="game-card-border-overlay"></div>
                                <div class="game-img">
                                    <img class="w-100 h-100" src="<?= htmlspecialchars($row['gameimage']) ?>" alt="game"
                                        style="transform: scale(1.1); transition: transform 0.3s;">
                                </div>
                                <div class="game-link d-center" style="opacity: 1; height: 99%;">
                                    <a href="#" class="btn2"
                                        onclick="confirmBuy('<?= htmlspecialchars($row['gamename']) ?>', <?= $row['gameprice'] ?>)"
                                        style="transition: transform 0.3s;">
                                        <i class="ti ti-lock fs-2xl"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="<?= htmlspecialchars($row['gameurl']) ?>">
                                <h4 class="game-title mb-0 tcn-1 cursor-scale">
                                    <?= htmlspecialchars($row['gamename']) ?>
                                </h4>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '';
            }
            ?>
        </div>
    </div>
</section>
<!-- game section end  -->

<?php require "footer.php"; ?>

<script>
    var totalGametoken = <?= $total_gametoken ?>; // Fetch user's total tokens from PHP

// Function to confirm the purchase of a game
function confirmBuy(gameName, gamePrice) {
    // Message to confirm the purchase
    var message = "Do you want to buy the " + gameName + " game for " + gamePrice + " tokens?";

    // Show confirmation dialog
    if (confirm(message)) {
        // Check if the user has enough tokens
        if (totalGametoken >= gamePrice) {
            // Deduct the tokens
            totalGametoken -= gamePrice; 
            alert("You have bought " + gameName + " and used " + gamePrice + " tokens. Remaining tokens: " + totalGametoken);

            // AJAX request to deduct tokens from the database
            $.ajax({
                type: "POST",
                url: "deduct_tokens.php",
                data: { gamePrice: gamePrice },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                    } else {
                        alert("Error: " + result.message);
                    }
                },
                error: function() {
                    alert("An error occurred while processing your request."); // Error handling
                }
            });
        } else {
            // If not enough tokens, show an alert
            alert("Insufficient tokens. You need " + (gamePrice - totalGametoken) + " more tokens.");
        }
    } else {
        // If user cancels the purchase
        alert("Purchase cancelled.");
    }
}

</script>

<!-- ==== js dependencies start ==== -->
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
<!-- swiper js -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- magnific popup  -->
<script src="assets/js/magnific-popup.js_1.1.0_jquery.magnific-popup.min.js"></script>
<!-- main js  -->
<script src="assets/js/main.js"></script>
</body>