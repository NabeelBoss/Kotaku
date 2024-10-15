<?php
require "header.php";
require "connect.php";
?>

<style>
    .player-img {
        overflow: hidden;
        border-radius: 50%;
    }

    .player-img img {
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>

<!-- Hero Section start  -->
<section class="hero-section pt-20 pb-120 position-relative">
    <div class="gradient-bg"></div>
    <div class="gradient-bg2"></div>
    <div class="star-area">
        <div class="big-star">
            <img class="w-100" src="assets/img/big-star.png" alt="star">
        </div>
        <div class="small-star">
            <img class="w-100" src="assets/img/small-star.png" alt="star">
        </div>
    </div>
    <div class="rotate-award">
        <img class="w-100" src="assets/img/award.png" alt="award">
    </div>
    <div class="container pt-120 pb-15">
        <div class="row g-6 justify-content-between">
            <div class="col-lg-5 col-md-6 col-sm-8">
                <div class="hero-content">
                    <ul class="d-flex gap-3 fs-2xl fw-semibold heading-font mb-5 list-icon title-anim">
                        <li>Play</li>
                        <li>Kotaku</li>
                        <li>Enjoy</li>
                    </ul>
                    <h1 class="hero-title display-one tcn-1 cursor-scale growUp mb-10">
                        ULTIMATE
                        <span class="d-block tcp-1">MINI</span>
                        GAMES
                    </h1>
                    <a href="<?php echo isset($_SESSION["LoginEmail"]) ? 'game.php' : 'signin.php'; ?>"
                        class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">
                        Play Now
                    </a>
                </div>

            </div>
            <div class="col-xl-3 col-md-2 col-4 order-md-last order-lg-1">
                <div class="hero-banner-area">
                    <div class="hero-banner-bg">
                        <img class="w-100" src="assets/img/bg-1.png" alt="banner">
                    </div>
                    <div class="hero-banner-img">
                        <img class="w-100 hero" src="assets/img/hero.png" alt="banner">
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 order-md-1 order-lg-last">
                <div class="hero-content">
                    <div class="card-area py-lg-8 py-6 px-lg-6 px-3 rounded-5 tilt mb-10" data-tilt>
                        <h3 class="tcn-1 dot-icon cursor-scale growDown mb-6 title-anim">
                            Top Players
                        </h3>
                        <div class="hr-line mb-6"></div>
                        <?php
                        $select = mysqli_query(
                            $con,
                            "WITH RankedScores AS (
    SELECT 
        userreg.username, 
        userreg.userprofile, 
        games.gamename, 
        scores.score,
        ROW_NUMBER() OVER (PARTITION BY userreg.userid ORDER BY scores.score DESC) AS rn
    FROM scores 
    JOIN games ON scores.scoregame = games.gameid 
    JOIN userreg ON scores.scoreplayer = userreg.userid 
)
SELECT 
    username, 
    userprofile, 
    gamename, 
    score
FROM RankedScores
WHERE rn = 1
ORDER BY score DESC
LIMIT 3;
"
                        ) or die("error: " . mysqli_error($con));
                        while ($li = mysqli_fetch_array($select)) {

                            ?>
                            <div class="card-items d-grid gap-5">
                                <div class="card-item d-flex align-items-center gap-4">
                                    <div class="card-img-area rounded-circle overflow-hidden">
                                        <img class="w-100" src="<?php
                                        echo $li['userprofile'];
                                        ?>" alt="profile">
                                    </div>
                                    <div class="card-info">
                                        <h4
                                            class="text-uppercase card-title fw-semibold tcn-1 mb-1 cursor-scale growDown2 title-anim">
                                            <?php
                                            echo $li['username'];
                                            ?>
                                        </h4>
                                        <h5 class="card-text fw-bold tcs-1 fw-medium" style="color:gold;">+ <?php
                                        echo $li['score'];
                                        ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="hr-line"></div>
                            </div>
                            <?php
                        }
                        ?>
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
</section>
<!-- Hero Section end  -->



<!-- 3D swiper section start-->
<section class="swiper-3d-section position-relative z-1" id="swiper-3d">
    <div class="container">
        <!-- Slider main container -->
        <div class="swiper swiper-3d-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php
                $sqli = "
    WITH ranked_scores AS (
        SELECT 
            s.scoregame,
            s.score,
            s.scoreplayer,
            g.gamename,
            g.gameimage,
            u.username,
            u.userprofile,
            ROW_NUMBER() OVER (PARTITION BY s.scoregame ORDER BY s.score DESC, s.scoreplayer ASC) AS rn
        FROM 
            scores s
        JOIN 
            games g ON s.scoregame = g.gameid
        JOIN 
            userreg u ON s.scoreplayer = u.userid
    )
    SELECT 
        username,
        userprofile,
        gamename,
        score,
        gameimage
    FROM 
        ranked_scores
    WHERE 
        rn = 1
";

                $result = mysqli_query($con, $sqli);

                while ($details = mysqli_fetch_array($result)) {
                    ?>
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="card-3d d-grid justify-content-center p-3">
                            <div class="img-area w-100 mb-8 position-relative">
                                <img class="w-100" src="<?php echo htmlspecialchars($details['gameimage']); ?>" alt="game">
                                <span class="card-status position-absolute start-0 py-2 px-6 tcn-1 fs-sm">

                                    <span
                                        class="dot-icon alt-icon ps-3"><?php echo htmlspecialchars($details['gamename']); ?></span>

                                </span>
                            </div>
                            <div class="cardnames d-flex justify-content-evenly text-uppercase">
                                <h5 class="card-title text-center tcn-1 mb-4 title-anim ">
                                    Name:
                                </h5>
                                <div style="padding: 14px 0;" class="v-line h-50"></div>

                                <h5 class="card-title text-center tcn-1 mb-4 title-anim ">
                                    <?php echo htmlspecialchars($details['username']); ?>
                                </h5>
                            </div>
                            <div class="d-center">
                                <div class="card-info d-center gap-3 py-1 px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="tcn-1 fs-xl">Highest Score:</span>
                                    </div>
                                    <div class="v-line"></div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="tcn-1 fs-xl"
                                            style="color: gold"><?php echo htmlspecialchars($details['score']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="swiper-btn-area d-center gap-6">
            <div class="swiper-btn swiper-3d-button-prev box-style">
                <i class="ti ti-chevron-left fs-xl"></i>
            </div>
            <div class="swiper-btn swiper-3d-button-next box-style">
                <i class="ti ti-chevron-right fs-xl"></i>
            </div>
        </div>
    </div>
</section>

<!-- 3D swiper section end-->







<!-- top player section start  -->
<section class="top-player-section pt-120 pb-120" id="top-player">
    <!-- sword animation -->
    <div class="sword-area">
        <img class="w-100" src="assets/img/sword.png" alt="sword">
    </div>
    <div class="red-ball end-0"></div>
    <div class="container">
        <div class="row justify-content-between mb-15">
            <div class="col-sm-6">
                <h2 class="display-four tcn-1 cursor-scale growUp title-anim">All Players</h2>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <div class="d-flex justify-content-end align-items-center gap-6">
                    <div class="swiper-btn top-player-prev box-style">
                        <i class="ti ti-chevron-left fs-xl"></i>
                    </div>
                    <div class="swiper-btn top-player-next box-style">
                        <i class="ti ti-chevron-right fs-xl"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <?php

            $sql = "SELECT
    u.userid AS user_id,
    u.username AS username,
    s.score AS score,
    g.gamename AS gamename,
    u.userprofile AS userprofile
FROM 
    userreg u
    INNER JOIN scores s ON u.userid = s.scoreplayer
    INNER JOIN games g ON s.scoregame = g.gameid
WHERE 
    s.score = (
        SELECT MAX(s2.score)
        FROM scores s2
        WHERE s2.scoreplayer = u.userid
    )
ORDER BY 
    u.username
";
            $user = mysqli_query($con, $sql);

            if (!$user) {
                die("Query failed: " . mysqli_error($con));
            }
            ?>
            <div class="col">

                <div class="swiper swiper-top-player">
                    <div class="swiper-wrapper my-1">
                        <?php while ($ul = mysqli_fetch_assoc($user)) { ?>
                            <div class="swiper-slide">
                                <div class="player-card d-grid gap-6 p-6 card-tilt" data-tilt>
                                    <div class="player-info-area d-between w-100">
                                        <div class="player-info d-flex align-items-center gap-4">
                                            <div class="player-img position-relative">
                                                <img class="w-100 rounded-circle"
                                                    src="<?php echo htmlspecialchars($ul['userprofile']); ?>" alt="player">
                                            </div>
                                            <div>
                                                <h5 class="player-name tcn-1 mb-1 title-anim text-uppercase">
                                                    <?php echo htmlspecialchars($ul['username']); ?>
                                                </h5>
                                            </div>
                                        </div>

                                        <?php if (!isset($_SESSION["LoginId"]) || $_SESSION["LoginId"] != $ul['user_id']) { ?>
                                            <form action="userprofile.php" method="get">
                                                <input type="hidden" name="userid"
                                                    value="<?php echo htmlspecialchars($ul['user_id']); ?>">
                                                <button class="follow-btn box-style" type="submit">
                                                    <i class="ti ti-info-circle fs-xl"></i>
                                                </button>
                                            </form>
                                        <?php } ?>

                                    </div>
                                    <div
                                        class="player-score-details justify-content-evenly d-flex align-items-center flex-wrap gap-3">
                                        <div class="score">
                                            <h6 class="score-title tcn-6 mb-2">High Score</h6>
                                            <ul class="d-flex align-items-center gap-1 tcp-2">
                                                <i
                                                    class="ti ti-plus fs-xs fw-bold"></i><?php echo htmlspecialchars($ul['score']); ?>
                                            </ul>
                                        </div>
                                        <div class="rank">
                                            <h6 class="rank-title tcn-6 mb-2">Game</h6>
                                            <span class="tcn-1 fs-sm">
                                                <i class="ti ti-diamond"></i>
                                                <?php echo htmlspecialchars($ul['gamename']); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>




        </div>
    </div>
</section>
<!-- top player section end -->


<!-- game section start  -->
<section class="game-section">
    <div class="red-ball bottom-0 end-0"></div>
    <div class="container mb-15">
        <div class="row justify-content-between align-items-center mb-15">
            <div class="col-6">
                <h2 class="display-four tcn-1 cursor-scale growUp title-anim">Games</h2>
            </div>
            <div class="col-6 text-end">
                <a href="<?php echo isset($_SESSION["LoginEmail"]) ? 'game.php' : 'signin.php'; ?>"
                    class="btn-half-border position-relative d-inline-block py-2 px-6 bgp-1 rounded-pill">View
                    More</a>
            </div>
        </div>
        <div class="row">

            <div class="col">
                <div class="swiper game-swiper">
                    <div class="swiper-wrapper mb-lg-15 mb-10">
                        <?php
                        $games = "SELECT * FROM games";
                        $gameque = mysqli_query($con, $games);
                        while ($game = mysqli_fetch_array($gameque)) {
                            ?>
                            <div class="swiper-slide">
                                <div class="game-card-wrapper mx-auto">
                                    <div class="game-card mb-5 p-2">
                                        <div class="game-card-border"></div>
                                        <div class="game-card-border-overlay"></div>
                                        <div class="game-img alt">
                                            <img class="w-100 h-100"
                                                src="<?php echo htmlspecialchars($game['gameimage']); ?>" alt="game">
                                        </div>
                                        <div class="game-link d-center">
                                            <a href="<?php echo isset($_SESSION["LoginEmail"]) ? htmlspecialchars($game['gameurl']) : 'signin.php'; ?>"
                                                class="btn2">
                                                <i class="ti ti-arrow-right fs-2xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <a
                                        href="<?php echo isset($_SESSION["LoginEmail"]) ? htmlspecialchars($game['gameurl']) : 'signin.php'; ?>">
                                        <h3 class="game-title mb-0 tcn-1 cursor-scale growDown2">
                                            <?php echo htmlspecialchars($game['gamename']); ?>
                                        </h3>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-center d-center">
                        <div class="game-swiper-pagination"></div>
                    </div>
                </div>
            </div>



        </div>
</section>
<!-- game section end  -->




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