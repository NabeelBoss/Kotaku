<?php require "header.php"; ?>





<style>
  .container {
    display: flex;
    justify-content: center;
  }

  .wrapper {
    display: flex;
    padding: 25px;
    border-radius: 10px;
    background: #F8F8F8;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    flex-wrap: wrap;
    justify-content: center;
  }

  .cards,
  .card,
  .view {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cards {
    height: 400px;
    width: 400px;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .card {
    cursor: pointer;
    list-style: none;
    user-select: none;
    position: relative;
    perspective: 1000px;
    height: calc(100% / 4 - 10px);
    width: calc(100% / 4 - 10px);
  }

  .card.shake {
    animation: shake 0.35s ease-in-out;
  }

  @keyframes shake {

    0%,
    100% {
      transform: translateX(0);
    }

    20% {
      transform: translateX(-13px);
    }

    40% {
      transform: translateX(13px);
    }

    60% {
      transform: translateX(-8px);
    }

    80% {
      transform: translateX(8px);
    }
  }

  .view {
    width: 100%;
    height: 100%;
    position: absolute;
    border-radius: 7px;
    background: #fff;
    pointer-events: none;
    backface-visibility: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.6s ease;
  }

  .front-view img {
    width: 45px;
    transform-style: preserve-3d;
  }

  .back-view img {
    max-width: 45px;
    transform-style: preserve-3d;
  }

  .back-view {
    transform: rotateY(180deg);
  }

  .card.flip .back-view {
    transform: rotateY(0);
  }

  .card.flip .front-view {
    transform: rotateY(-180deg);
    /* Flip to hide the front */
  }

  @media screen and (max-width: 700px) {
    .cards {
      height: 350px;
      width: 350px;
    }

    .front-view img {
      width: 35px;
    }

    .back-view img {
      max-width: 35px;
    }
  }

  @media screen and (max-width: 530px) {
    .cards {
      height: 300px;
      width: 300px;
    }

    .front-view img {
      width: 30px;
    }

    .back-view img {
      max-width: 30px;
    }
  }



  .difficulty-selector {
    margin: 20px;
    text-align: center;
    color: black;
  }

  .difficulty-selector select {
    padding: 5px;
    font-size: 16px;
  }

  .time {
    color: black;
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
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    max-width: 400px;
    width: 90%;
    position: relative;
    color: black;
  }

  .close-btn {
    margin-top: 5px;
    background: rgb(246, 87, 30);
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background 0.3s ease;
  }

  .close-btn:hover {
    background: rgba(246, 88, 30, 0.7);
    color: white;
  }


  .close-btn:active {
    transform: scale(0.97);
  }


  .custom-select-wrapper {
    position: relative;
    display: inline-block;
    width: 200px;
  }

  .custom-select-wrapper::after {
    content: '▼';
    font-size: 16px;
    color: #333;
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none;
  }

  .custom-select-wrapper select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    font-size: 16px;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
  }

  .details {
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 20px 0;
    justify-content: space-between;
    width: 100%;
  }

  .details p {
    margin: 0;
    color: black;

  }

  .details button {
    padding: 10px 20px;
    border: none;
    background-color: rgb(246, 87, 30);
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }

  .details button:hover {
    background-color: rgb(246, 87, 30);
  }

  .details button:active {
    transform: scale(0.97);
  }

  .missed_moves {
    display: flex;
    gap: 15px;
  }
</style>

<body>


  <!-- Hero Section start  -->
  <section class="hero-section pt-20 pb-120 h-100 position-relative">
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
    <div class="container pt-120 pb-20 ">
      <div class="wrapper col-lg-5 col-md-6 col-sm-8">
        <div class="header">
          <div class="difficulty-selector">
            <label for="difficulty">Choose Difficulty:</label>
            <div class="custom-select-wrapper">
              <select id="difficulty">
                <option value="easy">Easy</option>
                <option value="normal">Normal</option>
                <option value="hard">Hard</option>
              </select>
            </div>
          </div>

          <div class="time">
            Time: <span><b>20</b>s</span>
          </div>
        </div>

        <ul class="cards">
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-1.png" alt="card-img" />
            </div>
          </li>

          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-2.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-3.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-4.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-5.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-6.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-5.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-6.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-1.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-2.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-3.png" alt="card-img" />
            </div>
          </li>
          <li class="card">
            <div class="view front-view">
              <img src="assets/img/black question mark.png" alt="icon" />
            </div>
            <div class="view back-view">
              <img src="assets/img/gem-4.png" alt="card-img" />
            </div>
          </li>
          <div class="details">
            <div class="missed_moves">
              <p class="flips">
                Missed: <span><b>0</b></span>
              </p>
              <p class="remaining">
                Moves: <span><b>0</b></span>
              </p>
            </div>
            <div>
              <button>Refresh</button>
            </div>
          </div>
        </ul>
      </div>

      <div id="popup" class="popup">
        <div class="popup-content">
          <form action="memorycardscore.php" method="POST">
            <h2 id="resultMessage"></h2>
            <p id="score"></p>
            <input id="scoreinput" name="score" type="hidden">
            <input id="tokeninput" name="token" type="hidden">
            <button type="submit" name="popupsubmitbtn" id="closePopup" class="close-btn">Close</button>
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
  <!-- Hero Section end  -->



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

  <script>
    const cards = document.querySelectorAll(".card"),
      timeTag = document.querySelector(".time b"),
      flipsTag = document.querySelector(".flips b"),
      remainingTag = document.querySelector(".remaining b"),
      refreshBtn = document.querySelector(".details button"),
      popup = document.getElementById("popup"),
      scoreText = document.getElementById("score"),
      closePopup = document.getElementById("closePopup"),
      difficultySelect = document.getElementById("difficulty");

    let maxTime, timeLeft, flips, matchedCard, disableDeck, isPlaying, cardOne, cardTwo, timer, maxFlips;

    function initGameSettings() {
      const difficulty = difficultySelect.value;
      switch (difficulty) {
        case "easy":
          maxTime = 60;
          maxFlips = 30;
          break;
        case "normal":
          maxTime = 30;
          maxFlips = 15;
          break;
        case "hard":
          maxTime = 15;
          maxFlips = 10;
          break;
      }
      timeLeft = maxTime;
      flips = 0;
      matchedCard = 0;
      cardOne = cardTwo = "";
      clearInterval(timer);
      timeTag.innerText = timeLeft;
      flipsTag.innerText = flips;
      remainingTag.innerText = maxFlips;
      disableDeck = isPlaying = false;
      hidePopup();
      shuffleCard();
    }


    function initTimer() {
      if (timeLeft <= 0) {
        clearInterval(timer);
        showPopup();
      }
      timeLeft--;
      timeTag.innerText = timeLeft;
    }

    function flipCard({ target: clickedCard }) {
      if (!isPlaying) {
        isPlaying = true;
        timer = setInterval(initTimer, 1000);
      }
      if (clickedCard !== cardOne && !disableDeck && timeLeft > 0) {
        clickedCard.classList.add("flip");
        if (!cardOne) {
          return (cardOne = clickedCard);
        }
        cardTwo = clickedCard;
        disableDeck = true;
        let cardOneImg = cardOne.querySelector(".back-view img").src,
          cardTwoImg = cardTwo.querySelector(".back-view img").src;
        matchCards(cardOneImg, cardTwoImg);
      }
    }

    function matchCards(img1, img2) {
      if (img1 === img2) {
        matchedCard++;
        if (matchedCard === 6 && timeLeft > 0) {
          clearInterval(timer);
          showPopup();
        }
        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardOne = cardTwo = "";
        disableDeck = false;
        return;
      }

      flips++;
      flipsTag.innerText = flips;
      remainingTag.innerText = maxFlips - flips;

      setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
      }, 400);

      setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardOne = cardTwo = "";
        disableDeck = false;
        checkGameOver();
      }, 1200);
    }

    function shuffleCard() {
      let arr = [1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6];
      arr.sort(() => (Math.random() > 0.5 ? 1 : -1));

      cards.forEach((card, index) => {
        card.classList.remove("flip");
        let imgTag = card.querySelector(".back-view img");
        imgTag.src = `assets/img/gem-${arr[index]}.png`;
        card.addEventListener("click", flipCard);
      });
    }

    function showPopup() {
      let score = 0;
      let resultMessage = "";
      let tokens = 0;

      if (matchedCard === 6) {
        resultMessage = "You Won!";
        let remainingMoves = maxFlips - flips;
        let missedAttempts = parseInt(flipsTag.innerText, 10);
        missedAttempts = isNaN(missedAttempts) ? 0 : missedAttempts;
        let timeBonus = timeLeft > 0 ? timeLeft : 0;

        if (difficultySelect.value === "easy") {
          if (timeLeft >= 45 && flips <= 10) {
            score = 300;
          } else if (timeLeft >= 30 && flips <= 15) {
            score = 250;
          } else {
            score = remainingMoves * 10 + timeBonus * 5 - missedAttempts * 2;
          }
          score = Math.max(Math.min(score, 300), 0);
        } else {
          score = remainingMoves * 10 + timeBonus * 5 - missedAttempts * 2;
          score = Math.max(Math.min(score, 300), 0);
        }

        if (difficultySelect.value === "easy") {
          if (score === 300) {
            tokens = 30;
          } else if (score >= 200) {
            tokens = 20;
          } else if (score > 0) {
            tokens = 10;
          }
        } else {
          if (score >= 200) {
            tokens = 30;
          } else if (score >= 100) {
            tokens = 20;
          } else if (score > 0) {
            tokens = 10;
          }
        }
      } else {
        resultMessage = "You Lose!";
        score = 0;
      }

      document.getElementById("tokeninput").value = tokens;
      document.getElementById("resultMessage").innerText = resultMessage;
      document.getElementById("score").innerText = `Score: ${score}`;
      document.getElementById("scoreinput").value = score;

      popup.style.display = "flex";
    }


    function hidePopup() {
      popup.style.display = "none";
    }

    function checkGameOver() {
      if (flips >= maxFlips) {
        clearInterval(timer);
        showPopup();
      }
    }

    refreshBtn.addEventListener("click", initGameSettings);
    closePopup.addEventListener("click", hidePopup);
    difficultySelect.addEventListener("change", initGameSettings);

    initGameSettings();

    window.onload = hidePopup;

  </script>
</body>