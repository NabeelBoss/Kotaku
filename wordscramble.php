<?php require "header.php"; ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<style>


    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 0 10px;
    }

    .container {
        width: 440px;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px; 
    }

    .headings{
        border-bottom: 1px solid #ccc;
        width: 100%;
    }

    .container .headings h2 {
        font-size: 35px;
        font-weight: 500;
        margin-bottom: 16px;
        text-align: center;
    }

    .container .content {
        width: 100%;
        margin: 25px 0 35px;
    }

    .content .word {
        user-select: none;
        font-size: 33px;
        font-weight: 500;
        text-align: center;
        letter-spacing: 24px;
        margin-right: -24px;
        word-break: break-all;
        text-transform: uppercase;
    }

    .content .details {
        margin: 25px 0 20px;
    }

    .details p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .details p b {
        font-weight: 500;
    }

    .content input {
        width: 100%;
        height: 60px;
        outline: none;
        padding: 0 16px;
        font-size: 18px;
        border-radius: 5px;
        border: 1px solid #bfbfbf;
        text-align: center;
        line-height: 60px;
    }

    .content input:focus {
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08);
    }

    .content input::placeholder {
        color: #aaa;
    }

    .content input:focus::placeholder {
        color: #bfbfbf;
    }

    .content .score-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        font-size: 18px;
        font-weight: 500;
        background-color: #f5f5f5;
        border-radius: 5px;
        margin-top: 10px;
    }

    .score-display span {
        color: #333;
    }

    .score-display #score {
        color: #5372F0;
        font-size: 20px;
    }

    .content .buttons {
        display: flex;
        margin-top: 20px;
        justify-content: space-between;
    }

    .buttons button {
        border: none;
        outline: none;
        color: #fff;
        cursor: pointer;
        padding: 15px 0;
        font-size: 17px;
        border-radius: 5px;
        width: calc(50% - 10px); 
        transition: all 0.3s ease;
        text-align: center;
    }

    .buttons button:active {
        transform: scale(0.97);
    }

    .buttons .refresh-word {
        background: #6C757D;
    }

    .buttons .refresh-word:hover {
        background: #5f666d;
    }

    .buttons .check-word {
        background: #f6571e;
    }

    .buttons .check-word:hover {
        background: #f6571e;
    }

    #result-message {
        display: block;
        margin-top: 10px;
        font-size: 18px;
        min-height: 30px;
        line-height: 30px;
        text-align: center; 
    }

    @media screen and (max-width: 470px) {
        .container h2 {
            font-size: 22px;
            margin-bottom: 13px; 
            text-align: center;
        }

        .content .word {
            font-size: 30px;
            letter-spacing: 20px;
            margin-right: -20px;
        }

        .container .content {
            margin: 20px 0 30px;
        }

        .details p {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .content input {
            height: 55px;
            font-size: 17px;
        }

        .buttons button {
            padding: 14px 0;
            font-size: 16px;
            width: calc(50% - 7px);
        }
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
        <div class="container mt-10">
            <div class="headings">
                <h2 style="color: black;">Word Scramble</h2>
            </div>
            <div class="content">
                <p class="word" style="color: black;"></p>
                <div class="details">
                    <p class="hint" style="color: black;">Hint: <span style="color: black;"></span></p>
                    <p class="time" style="color: black;">Time Left: <span><b>30</b>s</span></p>
                </div>
                <div class="both" style="margin-top: 50px;">
                    <input type="text" spellcheck="false" placeholder="Enter a correct word">
                    <div class="score-display" style="border: 3px solid #f6571e;">
                        <span>Score: </span><span id="score" style="color:black;">0</span>
                    </div>
                </div>
                <span id="result-message"></span>
                <div class="buttons">
                    <button class="refresh-word" style="display: flex; justify-content: center;">Refresh Word</button>
                    <button class="check-word" style="display: flex; justify-content: center;">Check Word</button>
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
const wordText = document.querySelector(".word"),
    hintText = document.querySelector(".hint span"),
    timeText = document.querySelector(".time b"),
    inputField = document.querySelector("input"),
    refreshBtn = document.querySelector(".refresh-word"),
    checkBtn = document.querySelector(".check-word"),
    scoreDisplay = document.getElementById("score"),
    resultMessage = document.getElementById("result-message");

let correctWord, timer;
let score = 0;
let isCorrect = false; // Flag to check if the word is already guessed

const words = [
    {
        word: "html",
        hint: "Helps to build web structure"
    },
    {
        word: "database",
        hint: "Place where all data store"
    },
    {
        word: "number",
        hint: "Math symbol used for counting"
    },
    {
        word: "exchange",
        hint: "The act of trading"
    },
    {
        word: "garden",
        hint: "Space for planting flower and plant"
    },
    {
        word: "position",
        hint: "Location of someone or something"
    },
    {
        word: "feather",
        hint: "Hair outer covering of bird"
    },
    {
        word: "history",
        hint: "The study of past events"
    },
    {
        word: "tongue",
        hint: "The muscular organ of mouth"
    },
    {
        word: "group",
        hint: "A number of objects or persons"
    },
    {
        word: "taste",
        hint: "Ability of tongue to detect flavour"
    },
    {
        word: "store",
        hint: "Large shop where goods are traded"
    },
    {
        word: "friend",
        hint: "Closest person other than a family member"
    },
    {
        word: "pocket",
        hint: "A place for carrying small items in clothes"
    },
    {
        word: "needle",
        hint: "A thin and sharp metal pin"
    },
    {
        word: "expert",
        hint: "Person with extensive knowledge"
    },
    {
        word: "statement",
        hint: "A declaration of something"
    },
    {
        word: "echo",
        hint: "A sound that is reflected and heard again"
    },
    {
        word: "library",
        hint: "Place containing collection of books"
    },
];

const initTimer = maxTime => {
    clearInterval(timer);
    timer = setInterval(() => {
        if (maxTime > 0) {
            maxTime--;
            timeText.innerText = maxTime;
        } else {
            clearInterval(timer);
            resultMessage.innerHTML = `<span style="color: red;">Time off! ${correctWord.toUpperCase()} was the correct word</span>`;
            setTimeout(initGame, 2000);
        }
    }, 1000);
}

const initGame = () => {
    isCorrect = false; // Reset the flag when a new word is generated
    initTimer(30);
    let randomObj = words[Math.floor(Math.random() * words.length)];
    let wordArray = randomObj.word.split("");
    for (let i = wordArray.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [wordArray[i], wordArray[j]] = [wordArray[j], wordArray[i]];
    }
    wordText.innerText = wordArray.join("");
    hintText.innerText = randomObj.hint;
    correctWord = randomObj.word.toLowerCase();
    inputField.value = "";
    inputField.setAttribute("maxlength", correctWord.length);
    scoreDisplay.innerText = score;
    resultMessage.innerHTML = "<span style='visibility: hidden;'>Placeholder</span>";
}

initGame();

const checkWord = () => {
    let userWord = inputField.value.toLowerCase();
    if (!userWord) {
        resultMessage.innerHTML = `<span style="color: red;">Please enter the word to check!</span>`;
        return;
    }
    if (userWord !== correctWord) {
        resultMessage.innerHTML = `<span style="color: red;">Oops! ${userWord} is not a correct word</span>`;
        return;
    }

    if (isCorrect) {
        // If the word is already correct, don't increase the score
        resultMessage.innerHTML = `<span style="color: green;">Congrats! ${correctWord} is the correct word</span>`;
        return;
    }

    score += 10;
    scoreDisplay.innerText = score;
    isCorrect = true; // Set the flag to true once the word is correctly guessed

    resultMessage.innerHTML = `<span style="color: green;">Congrats! ${correctWord} is the correct word</span>`;
    setTimeout(initGame, 2000);
}

refreshBtn.addEventListener("click", initGame);
checkBtn.addEventListener("click", checkWord);


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
  <script src="assets/js/magnific-popup.js_1.1.0_jqsuery.magnific-popup.min.js"></script>
  <!-- bootstrap js -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!-- main js  -->
  <script src="assets/js/main.js"></script>
</body>