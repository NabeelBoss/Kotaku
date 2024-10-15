<?php require "header.php"; ?>

<head>
  <link rel="stylesheet" href="assets/css/typingtest.css">
</head>

<style>
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .wrapper {
    width: 770px;
    padding: 25px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
    color: black;
  }


  .wrapper .input-field {
    opacity: 0;
    z-index: -999;
    position: absolute;

  }

  .wrapper .content-box {
    padding: 35px 10px 0;
    border-radius: 10px;
    border: 1px solid #bfbfbf;
  }

  .content-box .typing-text {
    overflow: hidden;
    max-height: 300px;
    text-align: center;
  }

  .typing-text::-webkit-scrollbar {
    width: 0;
  }

  .typing-text p span {
    font-size: 18px;
    display: inline;
    vertical-align: top;
    overflow-wrap: break-word;
    hyphens: auto;
    white-space: pre-wrap;
    font-family: var(--head-font);
    font-weight: 500;
  }

  .typing-text p span.correct {
    color: #56964f;
  }

  .typing-text p span.incorrect {
    color: #cb3439;
    outline: 1px solid #fff;
    background: #ffc0cb;
    border-radius: 4px;
  }

  .typing-text p span.active {
    color: rgb(var(--p1));
  }

  .typing-text p span.active::before {
    content: "";
    height: 2px;
    width: 100%;
    bottom: 0;
    left: 0;
    opacity: 0;
    border-radius: 5px;
    background: rgb(var(--p1));
    animation: blink 1s ease-in-out infinite;
  }

  @keyframes blink {
    50% {
      opacity: 1;
    }
  }

  .content-box .content {
    margin-top: 17px;
    display: flex;
    padding: 12px 0;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #bfbfbf;
  }

  .content button {
    outline: none;
    border: none;
    width: 105px;
    color: #fff;
    padding: 8px 0 7px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    background: rgb(var(--p1));
    transition: transform 0.3s ease;


  }

  .content button:active {
    transform: scale(0.97);
  }

  .content .result-details {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    width: calc(100% - 140px);
    justify-content: space-between;
  }

  .result-details li {
    display: flex;
    height: 20px;
    list-style: none;
    position: relative;
    align-items: center;
  }

  .result-details li:not(:first-child) {
    padding-left: 22px;
    border-left: 1px solid #bfbfbf;
  }

  .result-details li p {
    font-size: 20px;
    font-weight: bold;

  }

  .result-details li span {
    display: block;
    font-size: 20px;
    margin-left: 10px;
  }

  li span b {
    font-weight: 500;
  }

  li:not(:first-child) span {
    font-weight: 500;
  }

  @media (max-width: 745px) {
    .wrapper {
      padding: 20px;
    }

    .content-box .content {
      padding: 20px 0;
    }

    .content-box .typing-text {
      max-height: 100%;
    }

    .typing-text p {
      font-size: 19px;
      text-align: left;
    }

    .content button {
      width: 100%;
      font-size: 15px;
      padding: 10px 0;
      margin-top: 20px;
    }

    .content .result-details {
      width: 100%;
    }

    .result-details li:not(:first-child) {
      border-left: 0;
      padding: 0;
    }

    .result-details li p,
    .result-details li span {
      font-size: 17px;
    }
  }

  @media (max-width: 518px) {
    .wrapper .content-box {
      padding: 10px 15px 0;
    }

    .typing-text p {
      font-size: 18px;
    }

    .result-details li {
      margin-bottom: 10px;
    }

    .content button {
      margin-top: 10px;
    }
  }

  .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .popup-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    max-width: 500px;
    margin: 0 auto;
    position: relative;
  }

  .popup-button {
    outline: none;
    border: none;
    width: 150px;
    color: #fff;
    font-size: 16px;
    border-radius: 5px;
    background: rgba(246, 88, 30);
    transition: transform 0.3s ease;
    text-align: center;
    padding: 10px 41px;
    margin-top: 10px;
  }


  .popup-button:hover {
    background: rgba(246, 88, 30, 0.7);
    color: white;
  }

  .popup-button:active {
    transform: scale(0.97);
  }


  .popup-content h2 {
    margin-top: 0;
  }

  .time-selector {
    justify-content: center;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    gap: 10px;
  }

  .time-selector label {
    font-size: 18px;
    font-weight: bold;
  }

  .time-selector select {
    font-size: 16px;
    padding: 8px 12px;
    border: 1px solid #bfbfbf;
    border-radius: 5px;
    background: #fff;
    cursor: pointer;
    width: 100px;
    /* Adjust width as needed */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    /* Add a subtle shadow */
  }

  .time-selector select:focus {
    outline: none;
    border-color: rgb(var(--p1));
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }



  .game-heading {
    font-size: 30px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
    font-family: var(--head-font);
    text-transform: uppercase;
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
        <input type="text" class="input-field">
        <div class="content-box">
          <div class="time-selector">
            <label for="time-select">Select Time:</label>
            <select id="time-select">
              <option value="30">30s</option>
              <option value="60">60s</option>
            </select>
          </div>

          <h1 class="game-heading">Typing Game</h1>
          <div class="typing-text">
            <p></p>
          </div>
          <div class="content">
            <ul class="result-details">

              <li class="time">
                <p>Time Left:</p>
                <span><b>30</b>s</span>
              </li>
              <li class="mistake">
                <p>Mistakes:</p>
                <span>0</span>
              </li>
              <li class="wpm">
                <p>WPM:</p>
                <span>0</span>
              </li>
              <li class="cpm">
                <p>CPM:</p>
                <span>0</span>
              </li>
            </ul>
            <button>Try Again</button>
          </div>
        </div>

        <div class="popup" id="scorePopup">
          <div class="popup-content">
            <form action="typingtestscore.php" method="POST">
              <h2>Well done!</h2>
              <p>Your Score: <span id="finalScore">0</span></p>
              <input id="scoreinput" name="score" type="hidden">
              <input id="tokensinput" name="tokens" type="hidden">
              <button id="tryAgainBtn" type="submit" name="popupsubmitbtn" class="popup-button">Try Again</button>
            </form>


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
  const paragraphs = [
    "Authors often misinterpret the lettuce as a folklore rabbi, when in actuality it feels more like an uncursed bacon. Pursued distances show us how mother-in-laws can be charleses. Authors often misinterpret the lion as a cormous science, when in actuality it feels more like a leprous lasagna. Recent controversy aside, their band was, in this moment, a racemed suit. The clutch of a joke becomes a togaed chair. The first pickled chess is.",
    "In modern times the first scrawny kitten is, in its own way, an input. An ostrich is the beginner of a roast. An appressed exhaust is a gun of the mind. A recorder is a grade from the right perspective. A hygienic is the cowbell of a skin. Few can name a dun brazil that isn't a highbrow playroom. The unwished beast comes from a thorny oxygen. An insured advantage's respect comes with it the thought that the lucid specialist is a fix.",
    "In ancient times the legs could be said to resemble stroppy vegetables. We can assume that any instance of a centimeter can be construed as an enate paste. One cannot separate pairs from astute managers. Those americas are nothing more than fish. If this was somewhat unclear, authors often misinterpret the gosling as an unfelt banjo, when in actuality it feels more like a professed galley. A bow of the squirrel is assumed.",
    "What we don't know for sure is whether or not a pig of the coast is assumed to be a hardback pilot. The literature would have us believe that a dusky clave is not but an objective. Few can name a limbate leo that isn't a sunlit silver. The bow is a mitten. However, the drawer is a bay. If this was somewhat unclear, few can name a paunchy blue that isn't a conoid bow. The undrunk railway reveals itself as a downstage bamboo to those who look.",
    "Their politician was, in this moment, a notour paperback. The first armless grouse is, in its own way, a gear. The coat is a wash. However, a cake is the llama of a caravan. Snakelike armies show us how playgrounds can be viscoses. Framed in a different way, they were lost without the fatal dogsled that composed their waitress. Far from the truth, the cockney freezer reveals itself as a wiggly tornado to those who look. The first hawklike sack.",
    "An aunt is a bassoon from the right perspective. As far as we can estimate, some posit the melic myanmar to be less than kutcha. One cannot separate foods from blowzy bows. The scampish closet reveals itself as a sclerous llama to those who look. A hip is the skirt of a peak. Some hempy laundries are thought of simply as orchids. A gum is a trumpet from the right perspective. A freebie flight is a wrench of the mind. Some posit the croupy.",
    "A baby is a shingle from the right perspective. Before defenses, collars were only operations. Bails are gleesome relatives. An alloy is a streetcar's debt. A fighter of the scarecrow is assumed to be a leisured laundry. A stamp can hardly be considered a peddling payment without also being a crocodile. A skill is a meteorology's fan. Their scent was, in this moment, a hidden feeling. The competitor of a bacon becomes a boxlike cougar.",
    "A broadband jam is a network of the mind. One cannot separate chickens from glowing periods. A production is a faucet from the right perspective. The lines could be said to resemble zincoid females. A deborah is a tractor's whale. Cod are elite japans. Some posit the wiglike norwegian to be less than plashy. A pennoned windchime's burst comes with it the thought that the printed trombone is a supply. Relations are restless tests.",
    "In recent years, some teeming herons are thought of simply as numbers. Nowhere is it disputed that an unlaid fur is a marble of the mind. Far from the truth, few can name a glossy lier that isn't an ingrate bone. The chicken is a giraffe. They were lost without the abscessed leek that composed their fowl. An interviewer is a tussal bomb. Vanward maracas show us how scarfs can be doubts. Few can name an unguled punch that isn't pig.",
    "A cough is a talk from the right perspective. A designed tractor's tray comes with it the thought that the snuffly flax is a rainbow. Their health was, in this moment, an earthy passbook. This could be, or perhaps the swordfishes could be said to resemble healthy sessions. A capricorn is a helium from the right perspective. However, a sled is a mailman's tennis. The competitor of an alarm becomes a toeless raincoat. Their twist was, in this moment.",
    "Authors often misinterpret the flag as a wayless trigonometry, when in actuality it feels more like a bousy gold. Few can name a jasp oven that isn't a stutter grape. They were lost without the huffy religion that composed their booklet. Those waves are nothing more than pedestrians. Few can name a quartered semicolon that isn't a rounding scooter. Though we assume the latter, the literature would have us believe.",
    "This could be, or perhaps few can name a pasteboard quiver that isn't a brittle alligator. A swordfish is a death's numeric. Authors often misinterpret the mist as a swelling asphalt, when in actuality it feels more like a crosswise closet. Some posit the tonal brother-in-law to be less than newborn. We know that the sizes could be said to resemble sleepwalk cycles. Before seasons, supplies were only fighters. Their stew was, in this moment.",
    "The vision of an attempt becomes a lawny output. Dibbles are mis womens. The olden penalty reveals itself as a bustled field to those who look. Few can name a chalky force that isn't a primate literature. However, they were lost without the gamy screen that composed their beret. Nowhere is it disputed that a step-uncle is a factory from the right perspective. One cannot separate paints from dreary windows. What we don't know for sure is whether.",
    "A tramp is a siamese from the right perspective. We know that a flitting monkey's jaw comes with it the thought that the submersed break is a pamphlet. Their cream was, in this moment, a seedy daffodil. The nest is a visitor. Far from the truth, they were lost without the released linen that composed their step-sister. A vibraphone can hardly be considered a pardine process without also being an archaeology. The bay of a hyacinth becomes.",
    "The frosts could be said to resemble backstage chards. One cannot separate colleges from pinkish bacons. Far from the truth, the mom of a rooster becomes a chordal hydrogen. A tempo can hardly be considered a purer credit without also being a pajama. The first combined ease is, in its own way, a pantyhose. Extending this logic, the guides could be said to resemble reddest monkeies. Framed in a different way, an addle hemp is a van.",
    "Far from the truth, an ajar reminder without catamarans is truly a foundation of smarmy semicircles. An alike board without harps is truly a satin of fated pans. A hubcap sees a parent as a painful beautician. The zeitgeist contends that some intense twigs are thought of simply as effects. A cross is a poppied tune. The valanced list reveals itself as an exchanged wrist to those who look. Recent controversy aside.",
    "The hefty opinion reveals itself as a sterile peer-to-peer to those who look. This could be, or perhaps the watch of a diamond becomes a bosom baboon. In recent years, some posit the unstuffed road to be less than altern. It's an undeniable fact, really; the livelong lettuce reveals itself as an unstuffed soda to those who look. In ancient times a bit is a balance's season. The popcorn of a morning becomes a moonless beauty.",
    "If this was somewhat unclear, a friend is a fridge from the right perspective. An upset carriage is a stitch of the mind. To be more specific, a temper is a pair from the right perspective. Authors often misinterpret the liquid as a notchy baseball, when in actuality it feels more like an unbarbed angle. Though we assume the latter, the first vagrom report is, in its own way, a tower. We know that the octopus of a cd becomes an unrent dahlia.",
    "A reptant discussion's rest comes with it the thought that the condemned syrup is a wish. The drake of a wallaby becomes a sonant harp. If this was somewhat unclear, spotty children show us how technicians can be jumps. Their honey was, in this moment, an intime direction. A ship is the lion of a hate. They were lost without the croupous jeep that composed their lily. In modern times a butcher of the birth is assumed to be a spiral bean.",
    "Those cowbells are nothing more than elements. This could be, or perhaps before stockings, thoughts were only opinions. A coil of the exclamation is assumed to be a hurtless toy. A board is the cast of a religion. In ancient times the first stinko sailboat is, in its own way, an exchange. Few can name a tutti channel that isn't a footless operation. Extending this logic, an oatmeal is the rooster of a shake. Those step-sons are nothing more than matches."
  ];

  const typingText = document.querySelector(".typing-text p"),
    inpField = document.querySelector(".wrapper .input-field"),
    tryAgainBtn = document.querySelector(".content button"),
    timeTag = document.querySelector(".time span b"),
    mistakeTag = document.querySelector(".mistake span"),
    wpmTag = document.querySelector(".wpm span"),
    cpmTag = document.querySelector(".cpm span"),
    popup = document.getElementById("scorePopup"),
    finalScore = document.getElementById("finalScore"),
    timeSelect = document.getElementById("time-select");

  let timer,
    maxTime = 30,
    timeLeft = maxTime,
    charIndex = 0,
    mistakes = 0,
    isTyping = false;

  // Function to load a new paragraph
  function loadParagraph() {
    const ranIndex = Math.floor(Math.random() * paragraphs.length);
    typingText.innerHTML = "";
    paragraphs[ranIndex].split("").forEach((char) => {
      let span = `<span>${char}</span>`;
      typingText.innerHTML += span;
    });
    typingText.querySelectorAll("span")[0].classList.add("active");
    document.addEventListener("keydown", () => inpField.focus());
    typingText.addEventListener("click", () => inpField.focus());
  }

  // Function to initialize typing logic
  function initTyping() {
    let characters = typingText.querySelectorAll("span");
    let typedChar = inpField.value.split("")[charIndex];

    if (charIndex < characters.length && timeLeft > 0) {
      if (!isTyping) {
        timer = setInterval(initTimer, 1000);
        isTyping = true;
      }
      if (typedChar == null) {
        if (charIndex > 0) {
          charIndex--;
          if (characters[charIndex].classList.contains("incorrect")) {
            mistakes--;
          }
          characters[charIndex].classList.remove("correct", "incorrect");
        }
      } else {
        if (characters[charIndex].innerText === typedChar) {
          characters[charIndex].classList.add("correct");
        } else {
          mistakes++;
          characters[charIndex].classList.add("incorrect");
        }
        charIndex++;
      }

      characters.forEach((span) => span.classList.remove("active"));
      if (charIndex < characters.length) {
        characters[charIndex].classList.add("active");
      }

      let wpm = Math.round(
        ((charIndex - mistakes) / 5 / (maxTime - timeLeft)) * 60
      );
      wpm = wpm < 0 || !wpm || wpm === Infinity ? 0 : wpm;

      wpmTag.innerText = wpm;
      mistakeTag.innerText = mistakes;
      cpmTag.innerText = charIndex - mistakes;

      if (charIndex === characters.length) {
        clearInterval(timer);
        showPopup();
      }
    }
  }

  // Function to initialize the timer
  function initTimer() {
    if (timeLeft > 0) {
      timeLeft--;
      timeTag.innerText = timeLeft;
      let wpm = Math.round(
        ((charIndex - mistakes) / 5 / (maxTime - timeLeft)) * 60
      );
      wpmTag.innerText = wpm;
    } else {
      clearInterval(timer);
      showPopup();
    }
  }






  // Function to calculate the score with proper scaling
  function calculateScore(wpm, cpm, mistakes) {
    // Scale down WPM and CPM contribution
    const scaledWpm = wpm * 2;
    const scaledCpm = cpm * 1;

    // Penalize for mistakes (higher penalty in 60s mode)
    const penalty = mistakes * (maxTime === 60 ? 30 : 10);
    let score = Math.max(10, scaledWpm + scaledCpm - penalty);

    // Apply time multiplier (reduce score in 60s mode)
    const timeMultiplier = maxTime === 60 ? 0.5 : 1;
    const finalScore = Math.min(300, score * timeMultiplier);

    return Math.round(finalScore);
  }

  // Function to check if the entire paragraph was completed
  function checkIfParagraphCompleted() {
    const userText = inpField.value.trim()
    const originalParagraph = typingText.innerText.trim();

    return userText === originalParagraph;
  }

  // Function to show the popup with final score and generate tokens
  function showPopup() {
    const wpm = parseInt(wpmTag.innerText, 10);
    const cpm = parseInt(cpmTag.innerText, 10);
    const score = calculateScore(wpm, cpm, mistakes);
    finalScore.innerText = score;

    // Set the score in the hidden input field
    document.getElementById("scoreinput").value = score;

    // Check if the user completed the entire paragraph
    let tokens = 0;
    const paragraphCompleted = checkIfParagraphCompleted();

    // Generate tokens based on score
    if (score >= 200 && score < 300) {
      tokens = 30;
    } else if (score >= 100 && score < 200) {
      tokens = 20;
    } else if (score >= 50 && score < 100) {
      tokens = 10;
    } else {
      tokens = 0;
    }

    // Bonus: 50 tokens if the paragraph is completed
    if (paragraphCompleted) {
      tokens += 50;
    }

    // Log the tokens for debugging
    console.log(`You've earned ${tokens} tokens!`);

    // Set the tokens in the hidden input field
    document.getElementById("tokensinput").value = tokens;

    popup.style.display = "flex";
  }






  function resetGame() {
    loadParagraph();
    clearInterval(timer);
    timeLeft = maxTime;
    charIndex = 0;
    mistakes = 0;
    isTyping = false;
    inpField.value = "";
    timeTag.innerText = timeLeft;
    wpmTag.innerText = 0;
    mistakeTag.innerText = 0;
    cpmTag.innerText = 0;

    popup.style.display = "none";
  }

  function handleTimeSelection() {
    maxTime = parseInt(timeSelect.value, 10);
    timeLeft = maxTime;
    timeTag.innerText = timeLeft;
    resetGame();
  }

  // Event listeners
  document.addEventListener("DOMContentLoaded", function () {
    loadParagraph();
    inpField.addEventListener("input", initTyping);
    tryAgainBtn.addEventListener("click", resetGame);
    timeSelect.addEventListener("change", handleTimeSelection);
  });



</script>