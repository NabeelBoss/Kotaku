<?php require "header.php"; ?>


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #000;
        margin: 0;
        height: 100vh;
    }

    .hero-section {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select-box,
    .play-board,
    .result-box {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
    }

    .select-box {
        background: #fff;
        padding: 20px 25px 25px;
        border-radius: 5px;
        max-width: 400px;
        width: 100%;
    }

    .select-box.hide {
        opacity: 0;
        pointer-events: none;
    }

    .select-box header {
        font-size: 30px;
        font-weight: 600;
        padding-bottom: 10px;
        border-bottom: 1px solid lightgrey;
    }

    .select-box .title {
        font-size: 22px;
        font-weight: 500;
        margin: 20px 0;
    }

    .select-box .options {
        display: flex;
        width: 100%;
    }

    .options button,
    .replay-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        font-size: 20px;
        font-weight: 500;
        padding: 10px 0;
        border: none;
        background: #f6571e;
        border-radius: 5px;
        color: #fff;
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }


    .options button.playerX {
        margin-right: 5px;
    }

    .options button.playerO {
        margin-left: 5px;
    }

    .select-box .credit {
        text-align: center;
        margin-top: 20px;
        font-size: 18px;
        font-weight: 500;
    }

    .select-box .credit a {
        color: #56baed;
        text-decoration: none;
    }

    .select-box .credit a:hover {
        text-decoration: underline;
    }

    .play-board {
        opacity: 0;
        pointer-events: none;
        transform: translate(-50%, -50%) scale(0.9);
    }

    .play-board.show {
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
        padding: 30px;
        background: #fff;
        border-radius: 10px;
    }

    .play-board .details {
        padding: 10px;
        border-radius: 5px;
        background: #fff;
    }

    .play-board .players {
        width: 100%;
        display: flex;
        position: relative;
        justify-content: space-between;
    }

    .players span {
        position: relative;
        z-index: 2;
        color: #56baed;
        font-size: 24px;
        font-weight: 500;
        padding: 10px 0;
        width: 100%;
        text-align: center;
        cursor: default;
        user-select: none;
        transition: all 0.3s ease;
    }

    .players.active span:first-child {
        color: #fff;
    }

    .players.active span:last-child {
        color: #56baed;
    }

    .details {
        border-bottom: 1px solid #ccc;
    }

    .players span:first-child {
        color: #fff;
    }

    .players .slider {
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 100%;
        background: #f6571e;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .players.active .slider {
        left: 50%;
    }

    .players.active span:first-child {
        color: #56baed;
    }

    .players.active span:nth-child(2) {
        color: #fff;
    }

    .players.active .slider {
        left: 50%;
    }

    .play-area {
        margin-top: 30px;
    }

    .play-area section {
        display: flex;
        margin-bottom: 5px;
    }

    .play-area section span {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px;
        width: 100px;
        margin: 5px;
        color: #f6571e;
        font-size: 48px;
        line-height: 80px;
        text-align: center;
        border-radius: 5px;
        background: #fff;
        border: 3px solid #f6571e;
    }

    .result {
        display: flex;
        justify-content: center;
        align-items: baseline;
    }

    .result-box {
        padding: 25px 20px;
        border-radius: 5px;
        max-width: 400px;
        width: 100%;
        opacity: 0;
        text-align: center;
        background: #fff;
        pointer-events: none;
        transform: translate(-50%, -50%) scale(0.9);
    }

    .result-box.show {
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
    }

    .result-box .won-text {
        font-size: 30px;
        font-weight: 500;
        display: flex;
        justify-content: center;
    }

    .result-box .won-text p {
        font-weight: bold;
        margin-top: -10px;
        margin-right: 5px;
        margin-left: 5px;
        font-size: 30px;
        color: #f6571e;
    }

    .result-box .score {
        font-weight: 600;
        margin: 0 5px;
        font-size: 30px;
        font-weight: 500;
        display: flex;
        justify-content: center;
        padding: 0px 25px;
    }

    .result-box .btn {
        width: 100%;
        margin-top: 25px;
        display: flex;
        justify-content: center;
    }
</style>

<body>
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
        <div class="select-box">
            <header style="color:black;">Tic Tac Toe</header>
            <div class="content">
                <div class="title" style="color:black;">Select which you want to be?</div>
                <div class="options">
                    <button class="playerX" style="color:white; ">Player (X)</button>
                    <button class="playerO" style="color:white;">Player (O)</button>
                </div>
            </div>
        </div>

        <div class="play-board">
            <div class="details">
                <div class="players">
                    <span class="Xturn" style="color:black;">X's Turn</span>
                    <span class="Oturn" style="color:black;">O's Turn</span>
                    <div class="slider"></div>
                </div>
            </div>
            <div class="play-area">
                <section>
                    <span class="box1"></span>
                    <span class="box2"></span>
                    <span class="box3"></span>
                </section>
                <section>
                    <span class="box4"></span>
                    <span class="box5"></span>
                    <span class="box6"></span>
                </section>
                <section>
                    <span class="box7"></span>
                    <span class="box8"></span>
                    <span class="box9"></span>
                </section>
            </div>
        </div>

        <div class="result-box">
            <form action="tictactoescore.php" method="POST">
                <div class="won-text" style="color:black;"></div>
                <div class="score mt-5" style="color:black;"></div>
                <input id="scoreinput" name="score" type="hidden">
                <div class="btn">
                    <button type="submit" name="popupsubmitbtn" class="replay-button"
                        style="color:white;">Replay</button>
                </div>
            </form>

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

    <script>

        const selectBox = document.querySelector(".select-box"),
            selectBtnX = selectBox.querySelector(".options .playerX"),
            selectBtnO = selectBox.querySelector(".options .playerO"),
            playBoard = document.querySelector(".play-board"),
            players = document.querySelector(".players"),
            allBox = document.querySelectorAll("section span"),
            resultBox = document.querySelector(".result-box"),
            wonText = resultBox.querySelector(".won-text"),
            replayBtn = resultBox.querySelector("button"),
            scoreText = resultBox.querySelector(".score"),
            scoreInput = document.querySelector("input[name='score']");

        let playerXIcon = "fas fa-times",
            playerOIcon = "far fa-circle",
            playerSign = "X",
            runBot = true,
            userSign = "X";

        const clickHandler = (element) => {
            if (players.classList.contains("player")) {
                playerSign = "O";
                element.innerHTML = `<i class="${playerOIcon}"></i>`;
                players.classList.remove("active");
                element.setAttribute("id", playerSign);
            } else {
                element.innerHTML = `<i class="${playerXIcon}"></i>`;
                element.setAttribute("id", playerSign);
                players.classList.add("active");
            }
            selectWinner();
            element.style.pointerEvents = "none";
            playBoard.style.pointerEvents = "none";
            const randomTimeDelay = ((Math.random() * 1000) + 200).toFixed();
            setTimeout(() => {
                bot(runBot);
            }, randomTimeDelay);
        };

        const bot = (runBot) => {
            if (runBot) {
                playerSign = "O";
                const array = [];
                allBox.forEach((box) => {
                    if (box.childElementCount == 0) {
                        array.push(box);
                    }
                });
                const randomBox = array[Math.floor(Math.random() * array.length)];
                if (array.length > 0) {
                    if (players.classList.contains("player")) {
                        playerSign = "X";
                        randomBox.innerHTML = `<i class="${playerXIcon}"></i>`;
                        randomBox.setAttribute("id", playerSign);
                        players.classList.add("active");
                    } else {
                        randomBox.innerHTML = `<i class="${playerOIcon}"></i>`;
                        players.classList.remove("active");
                        randomBox.setAttribute("id", playerSign);
                    }
                    selectWinner();
                }
                randomBox.style.pointerEvents = "none";
                playBoard.style.pointerEvents = "auto";
                playerSign = "X";
            }
        };

        const selectWinner = () => {
            const checkId = (val1, val2, val3, sign) => {
                if (getId(val1) == sign && getId(val2) == sign && getId(val3) == sign) {
                    return true;
                }
            };

            const getId = (idName) => {
                return document.querySelector(".box" + idName).id;
            };

            if (
                checkId(1, 2, 3, playerSign) ||
                checkId(4, 5, 6, playerSign) ||
                checkId(7, 8, 9, playerSign) ||
                checkId(1, 4, 7, playerSign) ||
                checkId(2, 5, 8, playerSign) ||
                checkId(3, 6, 9, playerSign) ||
                checkId(1, 5, 9, playerSign) ||
                checkId(3, 5, 7, playerSign)
            ) {
                runBot = false;
                bot(runBot);
                setTimeout(() => {
                    resultBox.classList.add("show");
                    playBoard.classList.remove("show");
                }, 700);

                wonText.innerHTML = `Player <p>${playerSign}</p> won the game!`;
                const score = playerSign === userSign ? 10 : 0;
                scoreText.innerHTML = `Score: ${score}`;
                scoreInput.value = score;


            } else {
                if (
                    getId(1) != "" &&
                    getId(2) != "" &&
                    getId(3) != "" &&
                    getId(4) != "" &&
                    getId(5) != "" &&
                    getId(6) != "" &&
                    getId(7) != "" &&
                    getId(8) != "" &&
                    getId(9) != ""
                ) {
                    runBot = false;
                    bot(runBot);
                    setTimeout(() => {
                        resultBox.classList.add("show");
                        playBoard.classList.remove("show");
                    }, 700);

                    wonText.innerHTML = "Match has been drawn!";
                    scoreText.innerHTML = "Score: 0";
                    scoreInput.value = 0;
                }
            }
        };

        selectBtnX.onclick = () => {
            userSign = "X";
            selectBox.classList.add("hide");
            playBoard.classList.add("show");
        };

        selectBtnO.onclick = () => {
            userSign = "O";
            selectBox.classList.add("hide");
            playBoard.classList.add("show");
            players.setAttribute("class", "players active player");
        };

        allBox.forEach((box) => {
            box.setAttribute("onclick", "clickHandler(this)");
        });

        replayBtn.onclick = () => {
            window.location.reload();
        };


    </script>

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