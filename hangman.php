<?php require "header.php"; ?>


<head>
    <script src="assets/js/hangman.js" defer></script>
</head>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .wrapper {
        display: flex;
        width: 850px;
        gap: 70px;
        padding: 90px 40px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        align-items: center;
    }

    .hangman-box img {
        user-select: none;
        max-width: 270px;
    }

    .hangman-box h1 {
        font-size: 1.45rem;
        text-align: center;
        margin-top: 20px;
        text-transform: uppercase;
    }

    .game-box .word-display {
        gap: 10px;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .word-display .letter {
        width: 28px;
        font-size: 2rem;
        text-align: center;
        font-weight: 600;
        margin-bottom: 40px;
        text-transform: uppercase;
        border-bottom: 3px solid #000;
    }

    .word-display .letter.guessed {
        margin: -40px 0 35px;
        border-color: transparent;
    }

    .game-box h4 {
        text-align: center;
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .game-box h4 b {
        font-weight: 600;
    }

    .game-box .guesses-text b {
        color: #ff0000;
    }

    .game-box .keyboard {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        margin-top: 40px;
        justify-content: center;
    }

    :where(.game-modal, .keyboard) button {
        color: #fff;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 4px;
        text-transform: uppercase;
        background: rgb(246, 87, 30);
    }

    .keyboard button {
        padding: 7px;
        width: calc(100% / 9 - 5px);
    }

    .keyboard button[disabled] {
        pointer-events: none;
        opacity: 0.6;
    }

    :where(.game-modal, .keyboard) button:hover {
        background: rgba(246, 88, 30, 0.712);
    }

    .keyboard button.incorrect {
        background-color: red;
        color: #fff;
    }

    .keyboard button.correct {
        background-color: #4CAF50;
        color: #fff;
    }

    .game-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        pointer-events: none;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 0 10px;
        transition: opacity 0.4s ease;
    }

    .game-modal.show {
        opacity: 1;
        pointer-events: auto;
        transition: opacity 0.4s 0.4s ease;
    }

    .game-modal .content {
        padding: 30px;
        max-width: 420px;
        width: 100%;
        border-radius: 10px;
        background: #fff;
        text-align: center;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .game-modal img {
        max-width: 130px;
        margin-bottom: 20px;
    }

    .game-modal img[src="assets/img/victory.gif"] {
        margin-left: -10px;
    }

    .game-modal h4 {
        font-size: 1.53rem;
    }

    .game-modal p {
        font-size: 1.15rem;
        margin: 15px 0 30px;
        font-weight: 500;
    }

    .game-modal p b {
        color: rgb(246, 87, 30);
        font-weight: 600;
    }

    .game-modal .score-text {
        font-size: 1.15rem;
        margin: -20px 0 25px;
        font-weight: 500;
    }

    .game-modal .score-text b {
        color: rgb(246, 87, 30);
        font-weight: 600;
    }

    .game-modal button {
        padding: 12px 23px;
    }

    .game-modal button:hover {
        color: white;
    }

    .game-modal button:active {
        transform: scale(0.97);
    }

    @media (max-width: 782px) {
        .container {
            flex-direction: column;
            padding: 30px 15px;
            align-items: center;
        }

        .hangman-box img {
            max-width: 200px;
        }

        .hangman-box h1 {
            display: none;
        }

        .game-box h4 {
            font-size: 1rem;
        }

        .word-display .letter {
            margin-bottom: 35px;
            font-size: 1.7rem;
        }

        .word-display .letter.guessed {
            margin: -35px 0 25px;
        }

        .game-modal img {
            max-width: 120px;
        }

        .game-modal h4 {
            font-size: 1.45rem;
        }

        .game-modal p {
            font-size: 1.1rem;
        }

        .game-modal .score-text {
            font-size: 1.1rem;
        }

        .game-modal button {
            padding: 10px 18px;
        }
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
            <div class="wrapper">
                <div class="hangman-box">
                    <img src="#" draggable="false" alt="hangman-img">
                    <h1 style="color: black;">Hangman Game</h1>
                </div>
                <div class="game-box">
                    <!-- Add Timer Display -->
                    <h4 style="color: black; font-size: 24px; margin-bottom: 50px;" id="timer-display">Time Left: 60
                    </h4>
                    <ul class="word-display" style="color: black;"></ul>
                    <h4 style="color: green; font-size: 18px;" class="hint-text">Hint: <b style="color: black;"></b>
                    </h4>
                    <h4 style="color: black; font-size: 18px;" class="guesses-text">Incorrect guesses: <b></b></h4>
                    <div class="keyboard"></div>
                </div>
            </div>
        </div>

        <div class="game-modal" style="color: black;">
            <div class="content">
                <form action="hangmanscore.php" method="POST">
                    <img src="#" alt="gif">
                    <h4>Game Over!</h4>
                    <p>The correct word was: <b></b></p>
                    <p class="score-text">Your Score: <b>0</b></p>
                    <input id="scoreinput" name="score" type="hidden">
                    <input id="tokeninput" name="gametoken" type="hidden">
                    <button type="submit" name="popupsubmitbtn" class="play-again">Play Again</button>
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
        const wordList = [
            {
                word: "guitar",
                hint: "A musical instrument with strings."
            },
            
            {
                word: "oxygen",
                hint: "A colorless, odorless gas essential for life."
            },
            {
                word: "mountain",
                hint: "A large natural elevation of the Earth's surface."
            },
            {
                word: "painting",
                hint: "An art form using colors on a surface to create images or expression."
            },
            {
                word: "astronomy",
                hint: "The scientific study of celestial objects and phenomena."
            },
            {
                word: "football",
                hint: "A popular sport played with a spherical ball."
            },
            {
                word: "chocolate",
                hint: "A sweet treat made from cocoa beans."
            },
            {
                word: "butterfly",
                hint: "An insect with colorful wings and a slender body."
            },
            {
                word: "history",
                hint: "The study of past events and human civilization."
            },
            {
                word: "pizza",
                hint: "A savory dish consisting of a round, flattened base with toppings."
            },
            {
                word: "jazz",
                hint: "A genre of music characterized by improvisation and syncopation."
            },
            {
                word: "camera",
                hint: "A device used to capture and record images or videos."
            },
            {
                word: "diamond",
                hint: "A precious gemstone known for its brilliance and hardness."
            },
            {
                word: "adventure",
                hint: "An exciting or daring experience."
            },
            {
                word: "science",
                hint: "The systematic study of the structure and behavior of the physical and natural world."
            },
            {
                word: "bicycle",
                hint: "A human-powered vehicle with two wheels."
            },
            {
                word: "sunset",
                hint: "The daily disappearance of the sun below the horizon."
            },
            {
                word: "coffee",
                hint: "A popular caffeinated beverage made from roasted coffee beans."
            },
            {
                word: "dance",
                hint: "A rhythmic movement of the body often performed to music."
            },
            {
                word: "galaxy",
                hint: "A vast system of stars, gas, and dust held together by gravity."
            },
            {
                word: "orchestra",
                hint: "A large ensemble of musicians playing various instruments."
            },
            {
                word: "volcano",
                hint: "A mountain or hill with a vent through which lava, rock fragments, hot vapor, and gas are ejected."
            },
            {
                word: "novel",
                hint: "A long work of fiction, typically with a complex plot and characters."
            },
            {
                word: "sculpture",
                hint: "A three-dimensional art form created by shaping or combining materials."
            },
            {
                word: "symphony",
                hint: "A long musical composition for a full orchestra, typically in multiple movements."
            },
            {
                word: "architecture",
                hint: "The art and science of designing and constructing buildings."
            },
            {
                word: "ballet",
                hint: "A classical dance form characterized by precise and graceful movements."
            },
            {
                word: "astronaut",
                hint: "A person trained to travel and work in space."
            },
            {
                word: "waterfall",
                hint: "A cascade of water falling from a height."
            },
            {
                word: "technology",
                hint: "The application of scientific knowledge for practical purposes."
            },
            {
                word: "rainbow",
                hint: "A meteorological phenomenon that is caused by reflection, refraction, and dispersion of light."
            },
            {
                word: "universe",
                hint: "All existing matter, space, and time as a whole."
            },
            {
                word: "piano",
                hint: "A musical instrument played by pressing keys that cause hammers to strike strings."
            },
            {
                word: "vacation",
                hint: "A period of time devoted to pleasure, rest, or relaxation."
            },
            {
                word: "rainforest",
                hint: "A dense forest characterized by high rainfall and biodiversity."
            },
            {
                word: "theater",
                hint: "A building or outdoor area in which plays, movies, or other performances are staged."
            },
            {
                word: "telephone",
                hint: "A device used to transmit sound over long distances."
            },
            {
                word: "language",
                hint: "A system of communication consisting of words, gestures, and syntax."
            },
            {
                word: "desert",
                hint: "A barren or arid land with little or no precipitation."
            },
            {
                word: "sunflower",
                hint: "A tall plant with a large yellow flower head."
            },
            {
                word: "fantasy",
                hint: "A genre of imaginative fiction involving magic and supernatural elements."
            },
            {
                word: "telescope",
                hint: "An optical instrument used to view distant objects in space."
            },
            {
                word: "breeze",
                hint: "A gentle wind."
            },
            {
                word: "oasis",
                hint: "A fertile spot in a desert where water is found."
            },
            {
                word: "photography",
                hint: "The art, process, or practice of creating images by recording light or other electromagnetic radiation."
            },
            {
                word: "safari",
                hint: "An expedition or journey, typically to observe wildlife in their natural habitat."
            },
            {
                word: "planet",
                hint: "A celestial body that orbits a star and does not produce light of its own."
            },
            {
                word: "river",
                hint: "A large natural stream of water flowing in a channel to the sea, a lake, or another such stream."
            },
            {
                word: "tropical",
                hint: "Relating to or situated in the region between the Tropic of Cancer and the Tropic of Capricorn."
            },
            {
                word: "mysterious",
                hint: "Difficult or impossible to understand, explain, or identify."
            },
            {
                word: "enigma",
                hint: "Something that is mysterious, puzzling, or difficult to understand."
            },
            {
                word: "paradox",
                hint: "A statement or situation that contradicts itself or defies intuition."
            },
            {
                word: "puzzle",
                hint: "A game, toy, or problem designed to test ingenuity or knowledge."
            },
            {
                word: "whisper",
                hint: "To speak very softly or quietly, often in a secretive manner."
            },
            {
                word: "shadow",
                hint: "A dark area or shape produced by an object blocking the light."
            },
            {
                word: "secret",
                hint: "Something kept hidden or unknown to others."
            },
            {
                word: "curiosity",
                hint: "A strong desire to know or learn something."
            },
            {
                word: "unpredictable",
                hint: "Not able to be foreseen or known beforehand; uncertain."
            },
            {
                word: "obfuscate",
                hint: "To confuse or bewilder someone; to make something unclear or difficult to understand."
            },
            {
                word: "unveil",
                hint: "To make known or reveal something previously secret or unknown."
            },
            {
                word: "illusion",
                hint: "A false perception or belief; a deceptive appearance or impression."
            },
            {
                word: "moonlight",
                hint: "The light from the moon."
            },
            {
                word: "vibrant",
                hint: "Full of energy, brightness, and life."
            },
            {
                word: "nostalgia",
                hint: "A sentimental longing or wistful affection for the past."
            },
            {
                word: "brilliant",
                hint: "Exceptionally clever, talented, or impressive."
            },
        ];
        const wordDisplay = document.querySelector(".word-display");
        const guessesText = document.querySelector(".guesses-text b");
        const keyboardDiv = document.querySelector(".keyboard");
        const hangmanImage = document.querySelector(".hangman-box img");
        const gameModal = document.querySelector(".game-modal");
        const playAgainBtn = gameModal.querySelector("button");

        const maxGuesses = 6;
        const maxScore = 50;

        let currentWord, correctLetters, wrongGuessCount, timer;
        let totalScore = 0;
        let totalWordsGuessed = 0;
        let isTimerStarted = false;




        const startTimer = () => {
            let timeLeft = 60;
            const timerDisplay = document.getElementById("timer-display");

            timer = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    gameOver(false);
                } else {
                    timerDisplay.innerText = `Time Left: ${timeLeft}`;
                    timeLeft--;
                }
            }, 1000);
        }


        const resetGame = () => {
            // Resetting game variables and UI elements
            correctLetters = [];
            wrongGuessCount = 0;
            hangmanImage.src = "assets/img/hangman-0.svg";
            guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;
            wordDisplay.innerHTML = currentWord.split("").map(() => `<li class="letter"></li>`).join("");
            keyboardDiv.querySelectorAll("button").forEach(btn => {
                btn.disabled = false; // Enable keyboard buttons
                btn.classList.remove("incorrect", "correct");
            });
            gameModal.classList.remove("show");
        }


        const getRandomWord = () => {
            if (wordList.length === 0) {
                gameOver(true);
                return;
            }
            const { word, hint } = wordList[Math.floor(Math.random() * wordList.length)];
            currentWord = word;
            document.querySelector(".hint-text b").innerText = hint;
            resetGame();
        }



        const calculateScore = () => {
            totalScore += maxScore;
            totalWordsGuessed++;

            // Calculate tokens based on the score
            let tokens = Math.floor(totalScore / 50) * 5;

            // Update the hidden input for tokens in the form
            const tokenInput = document.getElementById("tokeninput");
            tokenInput.value = tokens;
        }



        const gameOver = (isVictory) => {
            clearInterval(timer);

            // Update the score display in the modal
            const scoreDisplay = gameModal.querySelector(".score-text b");
            scoreDisplay.innerText = totalScore;

            // Set the score in the hidden input field
            const scoreInput = document.getElementById("scoreinput");
            scoreInput.value = totalScore;

            // Set the token count in the modal as well
            const tokens = Math.floor(totalScore / 50) * 5;
            const tokenInput = document.getElementById("tokeninput");
            tokenInput.value = tokens;

            // Check if player guessed any words
            if (totalWordsGuessed === 0) {
                gameModal.querySelector("img").src = 'assets/img/lost.gif';
                gameModal.querySelector("h4").innerText = 'You Lose!';
                gameModal.querySelector("p").innerHTML = `You didn't guess any words.`;
            } else {
                gameModal.querySelector("img").src = `assets/img/victory.gif`;
                gameModal.querySelector("h4").innerText = 'Congrats!';
                gameModal.querySelector("p").innerHTML = `You found ${totalWordsGuessed} words!`;
            }

            gameModal.classList.add("show");
        }



        const initGame = (button, clickedLetter) => {
            if (!isTimerStarted) {
                startTimer();
                isTimerStarted = true;
            }

            // Checking if clickedLetter exists on the currentWord
            if (currentWord.includes(clickedLetter)) {
                // Showing all correct letters on the word display
                [...currentWord].forEach((letter, index) => {
                    if (letter === clickedLetter) {
                        correctLetters.push(letter);
                        wordDisplay.querySelectorAll("li")[index].innerText = letter;
                        wordDisplay.querySelectorAll("li")[index].classList.add("guessed");
                    }
                });
                button.classList.add("correct");
            } else {
                // If clicked letter doesn't exist then update the wrongGuessCount and hangman image
                wrongGuessCount++;
                hangmanImage.src = `assets/img/hangman-${wrongGuessCount}.svg`;
                button.classList.add("incorrect");
            }

            button.disabled = true;
            guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;

            // Check for game over conditions
            if (wrongGuessCount === maxGuesses) {
                gameOver(false);
                return;
            }

            // Check for a win condition
            if (correctLetters.length === currentWord.length) {
                calculateScore();
                setTimeout(() => {
                    getRandomWord();
                }, 1000);
            }
        }




        // Creating keyboard buttons and adding event listeners
        for (let i = 97; i <= 122; i++) {
            const button = document.createElement("button");
            button.innerText = String.fromCharCode(i);
            keyboardDiv.appendChild(button);
            button.addEventListener("click", (e) => initGame(e.target, String.fromCharCode(i)));
        }

        getRandomWord();
        playAgainBtn.addEventListener("click", () => {
            totalScore = 0;
            totalWordsGuessed = 0;
            getRandomWord();
        });

    </script>
</body>