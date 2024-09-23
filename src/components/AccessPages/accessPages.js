function checkPasswords() {
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  if (password !== confirmPassword) {
    alert("Passwords Are wrong");
  } else {
    alert("done");
  }
}

function toggleFields() {
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
}
