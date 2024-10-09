// Function to start the countdown from 35 minutes
function startCountdown(duration, display) {
  let timer = duration,
    minutes,
    seconds;
  setInterval(function () {
    minutes = Math.floor(timer / 60);
    seconds = timer % 60;

    // Display minutes and seconds with leading zeros if necessary
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + ":" + seconds;

    // If timer reaches 0, stop the countdown
    if (--timer < 0) {
      timer = 0;
      // Add any additional actions when time is up, like auto-submitting the exam
      alert("Time's up!");
      // Optionally auto-submit the form here
      document.querySelector(".studentExam-submit-button").click();
    }
  }, 1000); // Interval set to 1000ms for each second
}

// When the window loads, start the countdown
window.onload = function () {
  let thirtyFiveMinutes = 35 * 60; // Convert 35 minutes to seconds
  let display = document.querySelector(".remainingTime_num"); // Find the display element
  startCountdown(thirtyFiveMinutes, display); // Start countdown
};

document.addEventListener('DOMContentLoaded', function () {
  document.querySelector('studentExam-done-button').addEventListener('click', function(){
    document.getElementById('AnswerRecorded').innerHTML = "Answer Recorded !";
  });
    

});