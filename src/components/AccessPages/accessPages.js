const checkPasswords = () => {
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  if (password !== confirmPassword) {
    alert("Both passwords are not same!");
  }
};

const toggleFields = () => {
  const userType = document.getElementById("types").value;
  const nicField = document.getElementById("nic-field");
  const subjectField = document.getElementById("subject-field");
  const emailReminder = document.getElementById("email-reminder");

  if (userType === "examiner") {
    nicField.style.display = "none";
    subjectField.style.display = "block"; // Show Subject field
    nicField.removeAttribute("required"); // Remove required from NIC
    subjectField.setAttribute("required", "required"); // Make Subject required
    emailReminder.style.display = "block";
  } else {
    nicField.style.display = "block"; // Show NIC field
    subjectField.style.display = "none"; // Hide Subject field
    nicField.setAttribute("required", "required");
    subjectField.removeAttribute("required");
    emailReminder.style.display = "none";
  }
};

function validateNIC(nic) {
  // Regex for NIC: 10 or 12 digits followed optionally by 'V' or 'X'
  const nicPattern = /^(?:\d{9}[VX]|\d{12})$/;
  return nicPattern.test(nic);
}

function validateNICOnChange() {
  const nic = document.getElementById("nic").value;
  if (!validateNIC(nic)) {
    alert("Please enter a valid NIC number.");
    document.getElementById("nic").value = ""; // Clear the invalid input
    document.getElementById("nic").focus(); // Focus back to NIC field
  }
}

function validatePasswordSize() {
  const password = document.getElementById("password").value;
  const notificationLabel = document.getElementById("password-notification");

  if (password.length < 8) {
    notificationLabel.style.display = "block"; // Show notification
  } else {
    notificationLabel.style.display = "none"; // Hide notification
  }
}
