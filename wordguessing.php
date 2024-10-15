<?php require "header.php"; ?>


<head>
    <link rel="stylesheet" href="assets/css/wordguessing.css">
</head>

<body>

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

            <div class="wrapper">
                <h1>Guess the Word</h1>
                <div class="content">
                    <input type="text" class="typing-input" maxlength="1">
                    <div class="inputs"></div>
                    <div class="details">
                        <p class="hint">Hint: <span></span></p>
                        <p class="guess-left">Remaining guesses: <span></span></p>
                        <p class="wrong-letter">Wrong letters: <span></span></p>
                    </div>
                    <button class="reset-btn">Reset Game</button>
                </div>
            </div>

            <div id="modal" class="modal">
                <div class="modal-content">
                    <form action="wordguessingscore.php" method="POST">

                        <h2>Game Over!</h2>
                        <p id="modal-message"></p>
                        <p id="modal-score">Score: <span></span></p>
                        <input id="scoreinput" name="score" type="hidden">

                        <button type="submit" name="popupsubmitbtn" id="modal-reset" class="reset-btn">Reset
                            Game</button>
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
</body>


<script>

    let wordList = [
        {
            word: "python",
            hint: "programming language"
        },
        {
            word: "guitar",
            hint: "a musical instrument"
        },
        {
            word: "aim",
            hint: "a purpose or intention"
        },
        {
            word: "venus",
            hint: "planet of our solar system"
        },
        {
            word: "gold",
            hint: "a yellow precious metal"
        },
        {
            word: "ebay",
            hint: "online shopping site"
        },
        {
            word: "golang",
            hint: "programming language"
        },
        {
            word: "coding",
            hint: "related to programming"
        },
        {
            word: "matrix",
            hint: "science fiction movie"
        },
        {
            word: "bugs",
            hint: "related to programming"
        },
        {
            word: "avatar",
            hint: "epic science fiction film"
        },
        {
            word: "gif",
            hint: "a file format for image"
        },
        {
            word: "mental",
            hint: "related to the mind"
        },
        {
            word: "map",
            hint: "diagram represent of an area"
        },
        {
            word: "island",
            hint: "land surrounded by water"
        },
        {
            word: "hockey",
            hint: "a famous outdoor game"
        },
        {
            word: "chess",
            hint: "related to a indoor game"
        },
        {
            word: "viber",
            hint: "a social media app"
        },
        {
            word: "github",
            hint: "code hosting platform"
        },
        {
            word: "png",
            hint: "a image file format"
        },
        {
            word: "silver",
            hint: "precious greyish-white metal"
        },
        {
            word: "mobile",
            hint: "an electronic device"
        },
        {
            word: "gpu",
            hint: "computer component"
        },
        {
            word: "java",
            hint: "programming language"
        },
        {
            word: "google",
            hint: "famous search engine"
        },
        {
            word: "venice",
            hint: "famous city of waters"
        },
        {
            word: "excel",
            hint: "microsoft product for windows"
        },
        {
            word: "mysql",
            hint: "a relational database system"
        },
        {
            word: "nepal",
            hint: "developing country name"
        },
        {
            word: "flute",
            hint: "a musical instrument"
        },
        {
            word: "crypto",
            hint: "related to cryptocurrency"
        },
        {
            word: "tesla",
            hint: "unit of magnetic flux density"
        },
        {
            word: "mars",
            hint: "planet of our solar system"
        },
        {
            word: "proxy",
            hint: "related to server application"
        },
        {
            word: "email",
            hint: "related to exchanging message"
        },
        {
            word: "html",
            hint: "markup language for the web"
        },
        {
            word: "air",
            hint: "related to a gas"
        },
        {
            word: "idea",
            hint: "a thought or suggestion"
        },
        {
            word: "server",
            hint: "related to computer or system"
        },
        {
            word: "svg",
            hint: "a vector image format"
        },
        {
            word: "jpeg",
            hint: "a image file format"
        },
        {
            word: "search",
            hint: "act to find something"
        },
        {
            word: "key",
            hint: "small piece of metal"
        },
        {
            word: "egypt",
            hint: "a country name"
        },
        {
            word: "joker",
            hint: "psychological thriller film"
        },
        {
            word: "dubai",
            hint: "developed country name"
        },
        {
            word: "photo",
            hint: "representation of person or scene"
        },
        {
            word: "nile",
            hint: "largest river in the world"
        },
        {
            word: "rain",
            hint: "related to a water"
        },
    ]

    const inputs = document.querySelector(".inputs"),
      hintTag = document.querySelector(".hint span"),
      guessLeft = document.querySelector(".guess-left span"),
      wrongLetter = document.querySelector(".wrong-letter span"),
      resetBtn = document.querySelector(".reset-btn"),
      typingInput = document.querySelector(".typing-input"),
      modal = document.getElementById("modal"),
      modalMessage = document.getElementById("modal-message"),
      modalScore = document.getElementById("modal-score").querySelector("span"),
      modalReset = document.getElementById("modal-reset");

// Get the hidden input field for score
 

let word, maxGuesses, incorrectLetters = [], correctLetters = [], score = 0, gameEnded = false;

function randomWord() {
    let ranItem = wordList[Math.floor(Math.random() * wordList.length)];
    word = ranItem.word;
    maxGuesses = word.length >= 5 ? 8 : 6;
    correctLetters = [];
    incorrectLetters = [];
    hintTag.innerText = ranItem.hint;
    guessLeft.innerText = maxGuesses;
    wrongLetter.innerText = incorrectLetters;

    let html = "";
    for (let i = 0; i < word.length; i++) {
        html += `<input type="text" disabled>`;
    }
    inputs.innerHTML = html;

    gameEnded = false; // Reset game ended flag
}

function calculateScore() {
    if (maxGuesses > 0) {
        // Score calculation: 10 points for each remaining guess
        return maxGuesses * 10;
    }
    return 0; // No score if guesses are exhausted
}

function initGame(e) {
    if (gameEnded) return; // Ignore input if the game has ended

    let key = e.target.value.toLowerCase();
    if (key.match(/^[A-Za-z]+$/) && !incorrectLetters.includes(key) && !correctLetters.includes(key)) {
        if (word.includes(key)) {
            for (let i = 0; i < word.length; i++) {
                if (word[i] == key) {
                    correctLetters.push(key);
                    inputs.querySelectorAll("input")[i].value = key;
                }
            }
        } else {
            maxGuesses--;
            incorrectLetters.push(key);
        }
        guessLeft.innerText = maxGuesses;
        wrongLetter.innerText = incorrectLetters;

        if (correctLetters.length === word.length) {
            score = calculateScore(); // Calculate score based on remaining guesses
            showModal(`Congratulations! You found the word ${word.toUpperCase()}.`, score);
        } else if (maxGuesses < 1) {
            showModal(`You have no remaining guesses. The word was ${word.toUpperCase()}.`, 0); // Score is 0 if guesses are exhausted
        }
    }
    typingInput.value = "";
}

function showModal(message, score) {
    modalMessage.innerText = message;
    modalScore.innerText = score;

    // Set the score in the hidden input field
    document.getElementById("scoreinput").value = score;

    modal.style.display = "block";
    typingInput.disabled = true; // Disable input when modal is shown
}

resetBtn.addEventListener("click", () => {
    randomWord();
    modal.style.display = "none"; // Hide modal when resetting
    typingInput.disabled = false; // Enable input when game is reset
});

modalReset.addEventListener("click", () => {
    randomWord();
    modal.style.display = "none"; // Hide modal when resetting
    typingInput.disabled = false; // Enable input when game is reset
});

typingInput.addEventListener("input", initGame);
inputs.addEventListener("click", () => typingInput.focus());
document.addEventListener("keydown", () => typingInput.focus());

randomWord(); // Initialize the game when page loads


</script>