<?php
require "header.php";
require "connect.php";


$signedInUserId = $_SESSION['LoginId'];

$friendsQuery = "
    SELECT f.friend_id, 
           CASE 
               WHEN f.user_one = $signedInUserId THEN f.user_two 
               ELSE f.user_one 
           END AS friend_id 
    FROM friends f 
    WHERE f.user_one = $signedInUserId OR f.user_two = $signedInUserId
";

$friendsResult = mysqli_query($con, $friendsQuery);

$friendsList = [];
while ($friend = mysqli_fetch_assoc($friendsResult)) {
    $friendUserId = $friend['friend_id'];
    $userQuery = "SELECT userid, username, userprofile FROM userreg WHERE userid = $friendUserId";
    $userResult = mysqli_query($con, $userQuery);
    if ($user = mysqli_fetch_assoc($userResult)) {
        $friendsList[] = $user;
    }
}

$requestCountQuery = "
    SELECT COUNT(*) as request_count
    FROM frnd_req
    WHERE receiver_id = $signedInUserId
";

$requestCountResult = mysqli_query($con, $requestCountQuery);
$requestCountRow = mysqli_fetch_assoc($requestCountResult);
$requestCount = $requestCountRow['request_count'];

$friendRequestsQuery = "
    SELECT fr.frndreq_id, fr.sender_id, ur.username, ur.userprofile 
    FROM frnd_req fr
    JOIN userreg ur ON fr.sender_id = ur.userid
    WHERE fr.receiver_id = $signedInUserId
";

$friendRequestsResult = mysqli_query($con, $friendRequestsQuery);

?>

<style>
    .player-img {
        width: 60px;
        height: 60px;
        overflow: hidden;
    }

    .player-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    #searchInput {
        font-family: 'Chakra Petch', sans-serif;
        color: white;
        background: transparent;
        border: none;
        outline: none;
        padding: 10px;
    }

    .badge {
        display: flex;
        flex-direction: row-reverse;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: red;
        color: white;
        margin-left: 2px;
    }

    .actionbtn {
        color: white;
    }
</style>

<!-- Hero Section start  -->
<section class="hero-section pt-10 pb-120 position-relative">
    <div class="gradient-bg"></div>
    <div class="gradient-bg2"></div>
    <div class="container pt-120 pb-15">

        <div class="d-between bgn-4 py-sm-4 py-3 px-sm-8 px-3 rounded mb-5">
            <input type="text" id="searchInput" placeholder="Search friends..." />
            <button type="button" onclick="filterPlayers()"
                style="background: none; border: none; padding: 0; cursor: pointer;">
                <i class="ti ti-search fs-3" style="color: white;"></i>
            </button>
        </div>

        <div class="player-details-section pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills gap-3 mb-lg-10 mb-6" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="parent-tab1" data-bs-toggle="pill"
                                    data-bs-target="#pills-parent1" role="tab" aria-selected="true">Friends</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="parent-tab2"
                                    data-bs-toggle="pill" data-bs-target="#pills-parent2" role="tab"
                                    aria-selected="false">
                                    Requests
                                    <span class="badge"><?php echo $requestCount > 0 ? $requestCount : 0; ?></span>
                                </button>
                            </li>


                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-parent1" role="tabpanel">
                                <div class="player-list-wrapper">
                                    <ul class="player-list d-grid gap-6" id="playerList">
                                        <?php
                                        $signedInUserId = $_SESSION['LoginId'];
                                        $friendsQuery = "
                                    SELECT f.friend_id, 
                                           CASE 
                                               WHEN f.user_one = $signedInUserId THEN f.user_two 
                                               ELSE f.user_one 
                                           END AS friend_id 
                                    FROM friends f 
                                    WHERE f.user_one = $signedInUserId OR f.user_two = $signedInUserId
                                ";

                                        $friendsResult = mysqli_query($con, $friendsQuery);

                                        $friendsList = [];
                                        while ($friend = mysqli_fetch_assoc($friendsResult)) {
                                            $friendUserId = $friend['friend_id'];
                                            $userQuery = "SELECT userid, username, userprofile FROM userreg WHERE userid = $friendUserId";
                                            $userResult = mysqli_query($con, $userQuery);
                                            if ($user = mysqli_fetch_assoc($userResult)) {
                                                $friendsList[] = $user;
                                            }
                                        }

                                        foreach ($friendsList as $friend) { ?>
                                            <li class="d-between bgn-4 py-sm-4 py-3 px-sm-8 px-3 rounded player-item">
                                                <div class="d-flex gap-3 align-items-center">
                                                    <div class="player-img">
                                                        <img class="w-100 rounded-circle"
                                                             src="<?php echo htmlspecialchars($friend['userprofile']); ?>"
                                                             alt="player">
                                                    </div>
                                                    <h5 class="player-name tcn-1 text-capitalize">
                                                        <?php echo htmlspecialchars($friend['username']); ?>
                                                    </h5>
                                                </div>
                                                <span class="player-type d-flex justify-content-center align-items-center">
                                                    <div class="edit-btn me-3">
                                                        <a href="chat.php?user_id=<?php echo htmlspecialchars($friend['userid']); ?>">
                                                            <i class="ti ti-message-circle fs-2xl"></i>
                                                        </a>
                                                    </div>
                                                    <div class="edit-btn">
                                                        <a href="chat.php?friendId=<?php echo htmlspecialchars($friend['userid']); ?>">
                                                            <i class="ti ti-user-minus fs-2xl"></i>
                                                        </a>
                                                    </div>
                                                </span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-parent2" role="tabpanel">
                                <!-- Nested Tabs start here -->
                                <div class="tab-content" id="pill-tabContent">
                                    <div class="tab-pane fade show active" id="pill-child1" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="team-game-table w-100" data-lenis-prevent>
                                                <thead>
                                                    <tr>
                                                        <th class="tdw p-3 text-nowrap tcn-5">Player Name</th>
                                                        <th class="tdw p-3 text-nowrap tcn-5">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tbody>
                                                    <?php while ($request = mysqli_fetch_assoc($friendRequestsResult)) { ?>
                                                        <tr>
                                                            <td class="tdw p-3 tcn-6">
                                                                <div class="d-flex gap-3 align-items-center">
                                                                    <div class="player-img">
                                                                        <img class="img-fluid rounded-circle"
                                                                            src="<?php echo htmlspecialchars($request['userprofile']); ?>"
                                                                            alt="player">
                                                                    </div>
                                                                    <h5 class="player-name tcn-1 text-capitalize">
                                                                        <?php echo htmlspecialchars($request['username']); ?>
                                                                    </h5>
                                                                </div>
                                                            </td>
                                                            <td class="tdw p-3 text-nowrap tcn-6 actionbtn">
                                                                <a href="accept_request.php?request_id=<?php echo $request['frndreq_id']; ?>"
                                                                    class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill me-4">
                                                                    Accept
                                                                </a>
                                                                <a href="decline_request.php?request_id=<?php echo $request['frndreq_id']; ?>"
                                                                    class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">
                                                                    Decline
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Nested Tabs end here -->
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