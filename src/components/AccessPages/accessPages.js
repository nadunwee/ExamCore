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
    subjectField.style.display = "block";
    nicField.removeAttribute("required");
    subjectField.setAttribute("required", "required");
    emailReminder.style.display = "block";
  } else {
    nicField.style.display = "block";
    subjectField.style.display = "none";
    nicField.setAttribute("required", "required");
    subjectField.removeAttribute("required");
    emailReminder.style.display = "none";
  }
};

function validateNIC(nic) {
  // 10 or 12 digits followed optionally by 'V' or 'X'
  const nicPattern = /^(?:\d{9}[VX]|\d{12})$/;
  return nicPattern.test(nic);
}

function validateNICOnChange() {
  const nic = document.getElementById("nic").value;
  if (!validateNIC(nic)) {
    alert("Please enter a valid NIC number.");
    document.getElementById("nic").value = "";
    document.getElementById("nic").focus();
  }
}

function validatePasswordSize() {
  const password = document.getElementById("password").value;
  const notificationLabel = document.getElementById("password-notification");

  if (password.length < 8) {
    notificationLabel.style.display = "block";
  } else {
    notificationLabel.style.display = "none";
  }
}
