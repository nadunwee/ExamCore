// Function to start the countdown from 35 minutes
function startCountdown(duration, display) {
  let timer = duration,
    minutes,
    seconds;
  setInterval(function () {
    minutes = Math.floor(timer / 60);
    seconds = timer % 60;

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
      timer = 0;
      alert("Time's up!");
      document.querySelector(".studentExam-submit-button").click();
    }
  }, 1000);
}

// When the window loads, start the countdown
window.onload = function () {
  let thirtyFiveMinutes = 35 * 60;
  let display = document.querySelector(".remainingTime_num");
  startCountdown(thirtyFiveMinutes, display);
};

document.addEventListener('DOMContentLoaded', function () {
  document.querySelector('studentExam-done-button').addEventListener('click', function () {
    document.getElementById('AnswerRecorded').innerHTML = "Answer Recorded !";
  });


});