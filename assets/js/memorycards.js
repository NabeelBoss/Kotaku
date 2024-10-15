// Query DOM elements needed for the game
const cards = document.querySelectorAll(".card"),
    timeTag = document.querySelector(".time b"),
    flipsTag = document.querySelector(".flips b"),
    remainingTag = document.querySelector(".remaining b"),
    refreshBtn = document.querySelector(".details button"),
    popup = document.getElementById("popup"),
    scoreText = document.getElementById("score"),
    closePopup = document.getElementById("closePopup"),
    difficultySelect = document.getElementById("difficulty");

// Declare variables to keep track of game state
let maxTime, timeLeft, flips, matchedCard, disableDeck, isPlaying, cardOne, cardTwo, timer, maxFlips;

// Initialize game settings based on selected difficulty
function initGameSettings() {
    const difficulty = difficultySelect.value;
    switch (difficulty) {
        case 'easy':
            maxTime = 60; // Time limit for easy mode
            maxFlips = 30; // Set a finite number of flips for easy mode
            break;
        case 'normal':
            maxTime = 30; // Time limit for normal mode
            maxFlips = 15; // Set maximum flips for normal mode
            break;
        case 'hard':
            maxTime = 15; // Time limit for hard mode
            maxFlips = 10; // Set maximum flips for hard mode
            break;
    }
    timeLeft = maxTime;
    flips = 0;
    matchedCard = 0;
    cardOne = cardTwo = "";
    clearInterval(timer); // Clear any existing timers
    timeTag.innerText = timeLeft; // Display initial time
    flipsTag.innerText = flips; // Display initial flip count
    remainingTag.innerText = maxFlips; // Display initial remaining flips
    disableDeck = isPlaying = false; // Reset game state
    shuffleCard(); // Shuffle the cards at the start
}

// Start the game timer
function initTimer() {
    if (timeLeft <= 0) {
        clearInterval(timer);
        showPopup();
    }
    timeLeft--;
    timeTag.innerText = timeLeft; // Update the timer display
}

// Handle card flip logic
function flipCard({ target: clickedCard }) {
    if (!isPlaying) {
        isPlaying = true;
        timer = setInterval(initTimer, 1000); // Start the timer on first flip
    }
    if (clickedCard !== cardOne && !disableDeck && timeLeft > 0) {
        clickedCard.classList.add("flip");
        if (!cardOne) {
            return cardOne = clickedCard;
        }
        cardTwo = clickedCard;
        disableDeck = true;
        let cardOneImg = cardOne.querySelector(".back-view img").src,
            cardTwoImg = cardTwo.querySelector(".back-view img").src;
        matchCards(cardOneImg, cardTwoImg);
    }
}

// Check if two flipped cards match
function matchCards(img1, img2) {
    if (img1 === img2) {
        matchedCard++;
        if (matchedCard === 6 && timeLeft > 0) {
            clearInterval(timer);
            showPopup(); // Show popup if all pairs matched
        }
        cardOne.removeEventListener("click", flipCard);
        cardTwo.removeEventListener("click", flipCard);
        cardOne = cardTwo = "";
        disableDeck = false;
        return;
    }

    // Increment flips if cards do not match
    flips++;
    flipsTag.innerText = flips; // Update flip count display
    remainingTag.innerText = maxFlips - flips; // Update remaining flips display

    setTimeout(() => {
        cardOne.classList.add("shake");
        cardTwo.classList.add("shake");
    }, 400);

    setTimeout(() => {
        cardOne.classList.remove("shake", "flip");
        cardTwo.classList.remove("shake", "flip");
        cardOne = cardTwo = "";
        disableDeck = false;
        checkGameOver(); // Check if game is over
    }, 1200);
}

// Shuffle cards at the start of the game
function shuffleCard() {
    let arr = [1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6];
    arr.sort(() => Math.random() > 0.5 ? 1 : -1);

    cards.forEach((card, index) => {
        card.classList.remove("flip");
        let imgTag = card.querySelector(".back-view img");
        imgTag.src = `assets/img/gem-${arr[index]}.png`; // Assign random images
        card.addEventListener("click", flipCard);
    });
}

// Show the result popup with score calculation
function showPopup() {
    let score = 0;
    let resultMessage = "";

    if (matchedCard === 6) {
        resultMessage = "You Won!";

        // Calculate remaining moves
        let remainingMoves = maxFlips - flips;

        // Convert missed attempts to a number
        let missedAttempts = parseInt(flipsTag.innerText, 10);
        missedAttempts = isNaN(missedAttempts) ? 0 : missedAttempts;

        // Calculate time bonus
        let timeBonus = timeLeft > 0 ? timeLeft : 0;

        // Calculate score
        score = (remainingMoves * 10) + (timeBonus * 5) - (missedAttempts * 2);
        score = Math.max(score, 0); // Ensure the score is not negative

    } else {
        resultMessage = "You Lose!";
        score = 0;
    }

    // Display the result message and score
    document.getElementById("resultMessage").innerText = resultMessage;
    document.getElementById("score").innerText = `Score: ${score}`;
    popup.style.display = "flex";
}

// Hide the result popup
function hidePopup() {
    popup.style.display = "none";
}

// Check if the game is over
function checkGameOver() {
    if (flips >= maxFlips) {
        clearInterval(timer);
        showPopup();
    }
}

// Add event listeners for button interactions
refreshBtn.addEventListener("click", initGameSettings);
closePopup.addEventListener("click", hidePopup);
difficultySelect.addEventListener("change", initGameSettings);

initGameSettings(); // Initialize game settings at the start
