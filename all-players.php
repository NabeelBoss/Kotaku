<?php
require "header.php";
require "connect.php";

$signedInUserId = $_SESSION['LoginId'];
$playersQuery = "SELECT userid, username, userprofile FROM userreg WHERE userid != $signedInUserId";
$playersResult = mysqli_query($con, $playersQuery);
?>


<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</body>

<style>
     .player-img {
        width: 62px;
        height: 62px;
        overflow: hidden;
        border-radius: 50%;

    }

    .player-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;

    }

    #searchInput {
        font-family: 'Chakra Petch', sans-serif;
        color: white;
        background: transparent;
        border: none;
        outline: none;
        padding: 10px;
    }
</style>

<!-- Hero Section start  -->
<section class="hero-section pt-10 pb-120 position-relative">
    <div class="gradient-bg"></div>
    <div class="gradient-bg2"></div>
    <div class="container pt-120 pb-15">

        <div class="d-between bgn-4 py-sm-4 py-3 px-sm-8 px-3 rounded mb-5">
            <input type="text" id="searchInput" placeholder="Search players..." />
            <button type="button" onclick="filterPlayers()"
                style="background: none; border: none; padding: 0; cursor: pointer;">
                <i class="ti ti-search fs-3" style="color: white;"></i>
            </button>
        </div>

        <div class="player-details-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="nav nav-pills gap-3 mb-lg-10 mb-6" id="pills-tab" role="tablist">
                            <div class="nav-item" role="presentation">
                                <div class="nav-link active" id="parent-tab1" data-bs-toggle="pill"
                                    data-bs-target="#pills-parent1" role="tab" aria-selected="true">Players</div>
                            </div>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-parent1" role="tabpanel">
                                <div class="player-list-wrapper">
                                    <ul class="player-list d-grid gap-6" id="playerList">
                                        <?php while ($player = mysqli_fetch_assoc($playersResult)) { ?>
                                            <li class="d-between bgn-4 py-sm-4 py-3 px-sm-8 px-3 rounded player-item">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div class="player-img">
                                                        <img class="img-fluid rounded-circle"
                                                            src="<?php echo htmlspecialchars($player['userprofile']); ?>"
                                                            alt="player">
                                                    </div>
                                                    <h5 class="player-name tcn-1 text-capitalize">
                                                        <?php echo htmlspecialchars($player['username']); ?>
                                                    </h5>
                                                </div>
                                                <span class="player-type d-flex justify-content-center align-items-center">
                                                    <div class="edit-btn me-3">
                                                        <?php if (!isset($_SESSION["LoginId"]) || $_SESSION["LoginId"] != $player['userid']) { ?>
                                                            <form action="userprofile.php" method="get"
                                                                style="display: inline;">
                                                                <input type="hidden" name="userid"
                                                                    value="<?php echo htmlspecialchars($player['userid']); ?>">
                                                                <button type="submit"
                                                                    style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                    <i class="fas fa-circle-info fs-2x"></i>
                                                                </button>
                                                            </form>
                                                        <?php } ?>
                                                    </div>

                                                    <!-- Dynamic Friend/Unfriend Button -->
                                                    <div class="edit-btn">
                                                        <?php
                                                        $user_id = htmlspecialchars($player['userid']);
                                                        $checkFriendship = "SELECT * FROM friends WHERE (user_one = $signedInUserId AND user_two = $user_id) 
                                                        OR (user_one = $user_id AND user_two = $signedInUserId)";
                                                        $friendResult = mysqli_query($con, $checkFriendship);
                                                        $isFriend = mysqli_num_rows($friendResult) > 0;

                                                        $checkRequestSent = "SELECT * FROM frnd_req WHERE sender_id = $signedInUserId AND receiver_id = $user_id";
                                                        $requestSentResult = mysqli_query($con, $checkRequestSent);
                                                        $requestSent = mysqli_num_rows($requestSentResult) > 0;

                                                        $checkRequestReceived = "SELECT * FROM frnd_req WHERE sender_id = $user_id AND receiver_id = $signedInUserId";
                                                        $requestReceivedResult = mysqli_query($con, $checkRequestReceived);
                                                        $requestReceived = mysqli_num_rows($requestReceivedResult) > 0;

                                                        if ($isFriend): ?>
                                                            <a href="unfriend.php?user_id=<?php echo $user_id; ?>" title="Unfriend Friend">
                                                                <i class="fas fa-user-minus fs-2x"></i>
                                                            </a>
                                                        <?php elseif ($requestSent): ?>
                                                            <a href="cancel_request.php?user_id=<?php echo $user_id; ?>" title="Cancel Friend Request">
                                                                <i class="fas fa-user-times fs-2x"></i>
                                                            </a>
                                                        <?php elseif ($requestReceived): ?>
                                                            <i class="fas fa-circle-xmark fs-2x" title="Pending Request" style="cursor: pointer;"></i>
                                                        <?php else: ?>
                                                            <a href="addfriend.php?user_id=<?php echo $user_id; ?>" title="Send Friend Request">
                                                                <i class="fa-solid fa-user-plus fs-2x"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-lines overflow-hidden">
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="lines">
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                    <div class="line-vertical"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section end  -->

<script>
    function filterPlayers() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const playerItems = document.querySelectorAll('.player-item');

        playerItems.forEach(item => {
            const playerName = item.querySelector('.player-name').textContent.toLowerCase();
            item.style.display = playerName.includes(input) ? '' : 'none';
        });
    }
</script>

<?php
mysqli_close($con);
require "footer.php";
?>

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
