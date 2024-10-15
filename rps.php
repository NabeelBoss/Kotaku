<?php require "header.php"; ?>



<style>
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .game-container {
    padding: 2rem 5.84rem;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    width: 500px;
  }

  .round_selector {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
  }

  .round_selector label {
    font-size: 1.2rem;
    color: black;
    margin-right: 0.5rem;
    font-weight: 500;
  }

  .round_selector select {
    padding: 0.5rem 1rem;
    border: 2px solid rgb(246, 87, 30);
    font-size: 1rem;
    color: black;
    background-color: #fef5e7;
    cursor: pointer;
    transition: all 0.3s ease;
    outline: none;
  }

  .round_selector select:hover {
    border-color: rgb(255, 107, 54);
    background-color: #fdebd0;
  }

  .round_selector select:focus {
    box-shadow: 0 0 0 3px rgba(246, 88, 30, 0.568);
  }

  .result_images {
    display: flex;
    align-items: center;
    justify-content: space-between;
    column-gap: 4rem;
    position: relative;
  }

  .game-container.start .user_result {
    transform-origin: left;
    animation: userShake 0.7s ease infinite;
  }

  @keyframes userShake {
    50% {
      transform: rotate(10deg);
    }
  }

  .game-container.start .bot_result {
    transform-origin: right;
    animation: botShake 0.7s ease infinite;
  }

  @keyframes botShake {
    50% {
      transform: rotate(-10deg);
    }
  }

  .result_images img {
    width: 100px;
  }

  .user_result img {
    transform: rotate(90deg);
  }

  .bot_result img {
    transform: rotate(-90deg) rotateY(180deg);
  }

  .scores {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
  }

  .score {
    font-size: 1.2rem;
    color: #333;
    text-align: center;
    font-weight: bold;
  }

  .result {
    text-align: center;
    font-size: 2rem;
    color: rgb(246, 88, 30);
    margin-top: 1.5rem;
    text-transform: uppercase;
    font-weight: bold;
  }

  .option_image img {
    width: 50px;
  }

  .option_images {
    display: flex;
    align-items: center;
    margin-top: 2.5rem;
    justify-content: space-between;
  }

  .game-container.start .option_images {
    pointer-events: none;
  }

  .option_image {
    display: flex;
    flex-direction: column;
    align-items: center;
    opacity: 0.5;
    cursor: pointer;
    transition: opacity 0.3s ease;
  }

  .option_image:hover {
    opacity: 1;
  }

  .option_image.active {
    opacity: 1;
  }

  .option_image img {
    pointer-events: none;
  }

  .option_image p {
    color: rgb(246, 88, 30);
    font-size: 1.235rem;
    margin-top: 1rem;
    pointer-events: none;
    font-weight: 600;
  }

  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
  }

  .modal_content {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }

  .modal_content h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: rgb(246, 87, 30);
    text-transform: uppercase;
  }

  .modal_content p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: #333;
  }


  #playAgain {
    background: rgb(246, 87, 30);
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background 0.3s ease;
  }

  #playAgain:hover {
    background: rgba(246, 88, 30, 0.445);
  }


  #playAgain:active {
    transform: scale(0.97);
  }

  .game-title {
    font-size: 2rem;
    color: rgb(246, 88, 30);
    text-align: center;
    margin-bottom: 1rem;
    width: 100%;
  }
</style>

<body>
  <section class="hero-section h-100 position-relative">
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
    <div class="container">


      <section class="game-container">
        <h1 class="game-title">Rock Paper Scissors</h1>
        <div class="round_selector">
          <label for="rounds">Best of:</label>
          <select id="rounds">
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="7">7</option>
          </select>
        </div>

        <div class="result_field">
          <div class="result_images">
            <span class="user_result">
              <img src="assets/img/rock.png" alt="User's choice" />
            </span>
            <span class="bot_result">
              <img src="assets/img/rock.png" alt="Bot's choice" />
            </span>
          </div>
          <div class="scores">
            <div class="score" id="userScore">User: 0</div>
            <div class="score" id="botScore">Bot: 0</div>
          </div>
          <div class="result">Let's Play!!</div>
        </div>

        <div class="option_images">
          <span class="option_image">
            <img src="assets/img/rock.png" alt="Rock" />
            <p>Rock</p>
          </span>
          <span class="option_image">
            <img src="assets/img/paper.png" alt="Paper" />
            <p>Paper</p>
          </span>
          <span class="option_image">
            <img src="assets/img/scissors.png" alt="Scissors" />
            <p>Scissors</p>
          </span>
        </div>
      </section>

      <div class="modal" id="resultModal">
        <div class="modal_content">
          <form action="rpsscore.php" method="POST">
            <h2>Game Over!</h2>
            <p id="finalResult"></p>
            <p id="finalScore"></p>
            <input id="scoreinput" name="score" type="hidden">
            <p id="winCount"></p>
            <button type="submit" name="popupsubmitbtn" id="playAgain">Play Again</button>
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
document.addEventListener("DOMContentLoaded", function () {
    const gameContainer = document.querySelector(".game-container"),
          userResult = document.querySelector(".user_result img"),
          botResult = document.querySelector(".bot_result img"),
          result = document.querySelector(".result"),
          optionImages = document.querySelectorAll(".option_image"),
          roundSelector = document.getElementById("rounds"),
          userScoreDisplay = document.getElementById("userScore"),
          botScoreDisplay = document.getElementById("botScore"),
          resultModal = document.getElementById("resultModal"),
          finalResult = document.getElementById("finalResult"),
          finalScore = document.getElementById("finalScore"),
          winCount = document.getElementById("winCount"),
          playAgainButton = document.getElementById("playAgain");


    let totalRounds = 3;
    let userScore = 0;
    let botScore = 0;

    roundSelector.addEventListener("change", (e) => {
        totalRounds = parseInt(e.target.value);
        resetGame();
    });

    function resetGame() {
        userScore = 0;
        botScore = 0;
        userScoreDisplay.textContent = `User: ${userScore}`;
        botScoreDisplay.textContent = `Bot: ${botScore}`;
        result.textContent = "Let's Play!!";
        userResult.src = botResult.src = "assets/img/rock.png";
        optionImages.forEach((image) => image.classList.remove("active"));
        resultModal.style.display = "none";
    }

    playAgainButton.addEventListener("click", () => {
        resetGame();
        resultModal.style.display = "none";
    });

    optionImages.forEach((image, index) => {
        image.addEventListener("click", (e) => {
            if (userScore < Math.ceil(totalRounds / 2) && botScore < Math.ceil(totalRounds / 2)) {
                image.classList.add("active");

                userResult.src = botResult.src = "assets/img/rock.png";
                result.textContent = "Wait...";

                optionImages.forEach((image2, index2) => {
                    index !== index2 && image2.classList.remove("active");
                });

                gameContainer.classList.add("start");

                let time = setTimeout(() => {
                    gameContainer.classList.remove("start");

                    let imageSrc = e.target.querySelector("img").src;
                    userResult.src = imageSrc;

                    let randomNumber = Math.floor(Math.random() * 3);
                    let botImages = ["assets/img/rock.png", "assets/img/paper.png", "assets/img/scissors.png"];
                    botResult.src = botImages[randomNumber];

                    let botValue = ["R", "P", "S"][randomNumber];
                    let userValue = ["R", "P", "S"][index];

                    let outcomes = {
                        RR: "Draw",
                        RP: "Bot",
                        RS: "User",
                        PP: "Draw",
                        PR: "User",
                        PS: "Bot",
                        SS: "Draw",
                        SR: "Bot",
                        SP: "User",
                    };

                    let outComeValue = outcomes[userValue + botValue];

                    if (userValue === botValue) {
                        result.textContent = "Match Draw";
                    } else if (outComeValue === "User") {
                        result.textContent = "User Won!!";
                        userScore++;
                        userScoreDisplay.textContent = `User: ${userScore}`;
                    } else {
                        result.textContent = "Bot Won!!";
                        botScore++;
                        botScoreDisplay.textContent = `Bot: ${botScore}`;
                    }

                    if (userScore === Math.ceil(totalRounds / 2) || botScore === Math.ceil(totalRounds / 2)) {
                        finalResult.textContent = userScore > botScore ? "Congratulations! You Win!" : "Oops! Bot Wins!";

                        let score = userScore > botScore ? Math.floor((userScore / (totalRounds - 1)) * 100) : 0;
                        finalScore.textContent = `Score: ${score}`;
                        winCount.textContent = `User Wins: ${userScore} | Bot Wins: ${botScore}`;

                        // Update the score in the hidden input field
                        document.getElementById("scoreinput").value = score;

                        resultModal.style.display = "flex"; // Show modal with result
                    }
                }, 2500);
            }
        });
    });
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