// Get necessary DOM elements
const otpPopup = document.getElementById("otp-popup");
const otpOverlay = document.getElementById("otp-overlay");
const otpInput = document.getElementById("otp-input");
const termsCheckbox = document.getElementById("terms-checkbox");
const submitButton = document.getElementById("submit-button");
const errorMessage = document.getElementById("error-message");
const examCheckboxes = document.querySelectorAll(".exam-checkbox");

// Function to open OTP popup
function openOtpPopup(examName) {
    const popupTitle = document.getElementById("popup-title");
    if (otpPopup && popupTitle) {
        popupTitle.textContent = `Enter OTP for "${examName}"`;
        otpPopup.style.display = "block";
        otpOverlay.style.display = "block";
    }
}

// Function to close OTP popup
function closeOtpPopup() {
    otpPopup.style.display = "none";
    otpOverlay.style.display = "none";
}

// Function to validate OTP
function validateOtp(otp) {
    return otp === "123456"; // Replace with actual validation logic
}

// Event listener to handle checkbox selection for exams
examCheckboxes.forEach(checkbox => {
    checkbox.addEventListener("change", (e) => {
        const examName = e.target.getAttribute("data-exam");
        if (e.target.checked) {
            openOtpPopup(examName); // Open the popup when an exam is selected
        } else {
            closeOtpPopup(); // Close the popup when unchecking the checkbox
        }
    });
});

// Handle submit button click in OTP popup
submitButton.addEventListener("click", () => {
    const otp = otpInput.value;
    const termsAccepted = termsCheckbox.checked;

    if (!otp) {
        errorMessage.textContent = "Please enter OTP.";
    } else {
        if (validateOtp(otp)) {
            window.location.href = "student_exam_page.html"; // Replace with the actual URL of your student exam page
        } else {
            errorMessage.textContent = "Invalid OTP.";
        }
    }
});

// Close popup when clicking outside
otpOverlay.addEventListener("click", closeOtpPopup);
