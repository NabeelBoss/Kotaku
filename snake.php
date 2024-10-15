<?php require "header.php"; ?>



<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #000;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
        }

        .wrapper {
            width: 65vmin;
            height: 70vmin;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            background-color: #293447;
        }

        .game-details {
            color: #e5e8f0;
            background-color: #f6571e;
            font-size: 1.5rem;
            font-weight: 500;
            padding: 20px 27px;
            display: flex;
            justify-content: space-between;
        }

        .play-board {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template: repeat(30, 1fr) / repeat(30, 1fr);
            background-color: #c4c4c4;
        }

        .play-board .food,
        .play-board .snake-head {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .play-board .food {
            background: #FF083D;
            border-radius: 50%;
        }

        .play-board .snake-head {
            background: #60CBFF;
            position: relative;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .play-board .snake-head .eye {
            width: 6px;
            height: 6px;
            background: #000;
            border-radius: 50%;
            position: absolute;
        }

        .play-board .snake-head .eye.left {
            top: 30%;
            left: 20%;
        }

        .play-board .snake-head .eye.right {
            top: 30%;
            right: 20%;
        }

        .play-board .snake-body {
            background: #B8E1FF;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .play-board .snake-tail {
            background: #60CBFF;
            border-radius: 50%;
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .controls {
            display: none;
            justify-content: space-between;
        }

        .controls i {
            color: #B8C6DC;
            padding: 25px 0;
            text-align: center;
            cursor: pointer;
            font-size: 1.3rem;
            width: calc(100% / 4);
            border-right: 1px solid #171b26;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            position: relative;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
        }



        #resultMessage {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Replay button */
        .replay-button {
            background: #f6571e;
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            outline: none;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media screen and (max-width: 800px) {
            .wrapper {
                width: 90vmin;
                height: 115vmin;
            }

            .game-details {
                font-size: 1rem;
                padding: 15px 27px;
            }

            .controls {
                display: flex;
            }

            .controls i {
                padding: 15px 0;
                font-size: 1rem;
            }
        }
    </style>
</head>

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
        <div class="container pb-20 ">
            <div class="wrapper">
                <div class="game-details">
                    <span class="score" style="font-size: 25px;">Score: 0</span>
                    <span class="high-score" style="font-size: 25px;">High Score: 0</span>
                </div>
                <div class="play-board"></div>
                <div class="controls">
                    <i data-key="ArrowLeft" class="fa-solid fa-arrow-left-long"></i>
                    <i data-key="ArrowUp" class="fa-solid fa-arrow-up-long"></i>
                    <i data-key="ArrowRight" class="fa-solid fa-arrow-right-long"></i>
                    <i data-key="ArrowDown" class="fa-solid fa-arrow-down-long"></i>
                </div>
            </div>

            <div id="popup" class="popup" style="display:none;">
                <div class="popup-content">
                    <form action="snakescore.php" method="POST">
                        <h2 id="resultMessage">Game Over</h2>
                        <input id="scoreinput" name="score" type="hidden">
                        <input id="tokeninput" name="tokens" type="hidden">
                        <button type="submit" name="popupsubmitbtn" id="re-play" class="replay-button">Play
                            Again</button>
                    </form>


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
    <script>
        const playBoard = document.querySelector(".play-board");
        const scoreElement = document.querySelector(".score");
        const highScoreElement = document.querySelector(".high-score");
        const controls = document.querySelectorAll(".controls i");
        const popup = document.getElementById('popup');
        const resultMessage = document.getElementById('resultMessage');
        const replayButton = document.getElementById('re-play');
        const scoreInput = document.getElementById('scoreinput');
        const tokenInput = document.getElementById('tokeninput');

        let gameOver = false;
        let foodX, foodY;
        let snakeX = 15, snakeY = 15;
        let snakeBody = [[snakeX, snakeY]];
        let velocityX = 0, velocityY = 0;
        let setIntervalId;
        let score = 0;
        let tokens = 0;  // Token count
        let gamePaused = false;

        let highScore = localStorage.getItem("high-score") || 0;
        highScoreElement.innerText = `High Score: ${highScore}`;

        const generateTokens = (score) => {
            let tokens;
            if (score >= 2 && score < 50) {
                tokens = Math.floor((score - 2) / 2) + 1;
            } else if (score >= 50 && score < 100) {
                tokens = 15;
            } else if (score >= 100) {
                tokens = 20 + Math.floor((score - 100) / 5) * 5;
            }
            return tokens;
        };

        const changeFoodPosition = () => {
            let isFoodOnSnake;

            do {
                foodX = Math.floor(Math.random() * 30) + 1;
                foodY = Math.floor(Math.random() * 30) + 1;
                isFoodOnSnake = snakeBody.some(segment => segment[0] === foodY && segment[1] === foodX);
            } while (isFoodOnSnake);
        };

        const handleGameOver = () => {
            clearInterval(setIntervalId);
            resultMessage.innerHTML = `Game Over! <br>Your score: ${score}`;
            popup.style.display = 'flex';
            scoreInput.value = score;
            tokenInput.value = tokens;
        };

        const changeDirection = ({ key }) => {
    if (key === "ArrowUp" && velocityY !== 1) {
        velocityX = 0;
        velocityY = -1;
    } else if (key === "ArrowDown" && velocityY !== -1) {
        velocityX = 0;
        velocityY = 1;
    } else if (key === "ArrowLeft" && velocityX !== 1) {
        velocityX = -1;
        velocityY = 0;
    } else if (key === "ArrowRight" && velocityX !== -1) {
        velocityX = 1;
        velocityY = 0;
    }
};


document.addEventListener("keydown", (e) => {
    // Prevent default action for arrow keys
    if (["ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight"].includes(e.key)) {
        e.preventDefault(); 
        changeDirection(e);
    }
});

document.addEventListener("touchstart", (e) => {
    const target = e.target.closest('.controls i');
    if (target) {
        console.log(`Button pressed: ${target.dataset.key}`);
        e.preventDefault(); // Prevent default touch behavior
        changeDirection({ key: target.dataset.key });
    }
});


        const initGame = () => {
            if (gameOver) return handleGameOver();

            let htmlMarkup = `<div class="food" style="grid-area: ${foodY} / ${foodX}"></div>`;

            if (snakeX === foodX && snakeY === foodY) {
                changeFoodPosition();
                snakeBody.push([foodY, foodX]);
                score++;

                highScore = Math.max(score, highScore);
                localStorage.setItem("high-score", highScore);

                tokens = generateTokens(score);
                tokenInput.value = tokens;

                scoreElement.innerText = `Score: ${score}`;
                highScoreElement.innerText = `High Score: ${highScore}`;

                console.log(`Tokens: ${tokens}`);
            }

            for (let i = snakeBody.length - 1; i > 0; i--) {
                snakeBody[i] = snakeBody[i - 1];
            }

            snakeBody[0] = [snakeX, snakeY];

            snakeX += velocityX;
            snakeY += velocityY;

            if (snakeX <= 0 || snakeX > 30 || snakeY <= 0 || snakeY > 30) {
                gameOver = true;
            }

            for (let i = 1; i < snakeBody.length; i++) {
                if (snakeBody[0][0] === snakeBody[i][0] && snakeBody[0][1] === snakeBody[i][1]) {
                    gameOver = true;
                }
            }

            snakeBody.forEach((part, i) => {
                if (i === 0) {
                    htmlMarkup += `<div class="snake-head" style="grid-area: ${part[1]} / ${part[0]}">
            <div class="eye left"></div>
            <div class="eye right"></div>
        </div>`;
                } else if (i === snakeBody.length - 1) {
                    htmlMarkup += `<div class="snake-tail" style="grid-area: ${part[1]} / ${part[0]}"></div>`;
                } else {
                    htmlMarkup += `<div class="snake-body" style="grid-area: ${part[1]} / ${part[0]}"></div>`;
                }
            });

            playBoard.innerHTML = htmlMarkup;
        };

        changeFoodPosition();
        setIntervalId = setInterval(initGame, 125);

        document.addEventListener("keydown", (e) => {
            changeDirection(e);
        });


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