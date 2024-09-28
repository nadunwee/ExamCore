document.addEventListener("DOMContentLoaded", function () {
    const addExaminerBtn = document.getElementById("addExaminerAdmin");
    const assignExaminerBtn = document.getElementById("assignExaminerAdmin");
    const addExaminerModal = document.getElementById("addExaminerModal");
    const assignExaminerModal = document.getElementById("assignExaminerModal");
    const addcloseModalBtn = document.getElementById("addClose");
    const assigncloseModalBtn = document.getElementById("assignClose");
    const registrationForm = document.querySelector("form");
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirm-password");


    // Fetch examiners from the server
fetch('getExaminers.php')
.then(response => response.json())
.then(examiners => {
    // Create examinerSelect (a select dropdown)
    const examinerSelect = document.createElement("select");
    examinerSelect.id = "examinerSelect";

    // Add options to the select dropdown from fetched data
    examiners.forEach(examiner => {
        const option = document.createElement("option");
        option.value = examiner.examiner_id; // Assuming you're using examiner_id as the value
        option.textContent = examiner.name; // Display the examiner's name
        examinerSelect.appendChild(option);
    });

    // Append the examinerSelect to the modal
    const assignExaminerModal = document.getElementById("assignExaminerModal");
    assignExaminerModal.appendChild(examinerSelect);
});

// Fetch exams from the server
fetch('getExams.php')
.then(response => response.json())
.then(exams => {
    // Create assignTo (a select dropdown)
    const assignTo = document.createElement("select");
    assignTo.id = "assignTo";

    // Add options to the select dropdown from fetched data
    exams.forEach(exam => {
        const option = document.createElement("option");
        option.value = exam.exam_id; // Assuming you're using exam_id as the value
        option.textContent = exam.exam_name; // Display the exam name
        assignTo.appendChild(option);
    });

    // Append the assignTo to the modal
    const assignExaminerModal = document.getElementById("assignExaminerModal");
    assignExaminerModal.appendChild(assignTo);
});

    // Open modal when the "Add Examiner" button is clicked
    assignExaminerBtn.addEventListener("click", function () {
        assignExaminerModal.style.display = "block";
    });

    // Open modal when the "Add Examiner" button is clicked
    addExaminerBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "block";
    });

    // Add event listener for closing the modal
    addcloseModalBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "none"; // Hide the modal
        clearForm(); // Clear the form when closing the modal
    });

    // Function to clear the form
    function clearForm() {
   form.reset(); // Reset the form fields
    }

    // Add event listener for closing the modal
    assigncloseModalBtn.addEventListener("click", function () {
        assignExaminerModal.style.display = "none"; // Hide the modal
        clearForm(); // Clear the form when closing the modal
    });

    // Function to clear the form
    function clearForm() {
   form.reset(); // Reset the form fields
    }
    // Close modal when clicking outside of the modal
    window.addEventListener("click", function (event) {
        if (event.target === addExaminerModal) {
            addExaminerModal.style.display = "none";
            clearForm(); // Clear the form when closing the modal
        }
    });

    // Form submission handling with validation
    registrationForm.addEventListener("submit", function (event) {
        let valid = true;

        // Clear any previous error messages
        clearErrors();

        // Validate email format
        if (!validateEmail(emailField.value)) {
            showError(emailField, "Please enter a valid email address.");
            valid = false;
        }

        // Validate password length
        if (passwordField.value.length < 6) {
            showError(passwordField, "Password must be at least 6 characters long.");
            valid = false;
        }

        // Check if passwords match
        if (passwordField.value !== confirmPasswordField.value) {
            showError(confirmPasswordField, "Passwords do not match.");
            valid = false;
        }

        // If the form is not valid, prevent submission
        if (!valid) {
            event.preventDefault();
        }
    });

    // Function to validate email format
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Function to show error message
    function showError(input, message) {
        const error = document.createElement("div");
        error.className = "error-message";
        error.textContent = message;
        input.parentElement.appendChild(error);
    }

    // Function to clear error messages
    function clearErrors() {
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach((error) => error.remove());
    }

    // Function to clear form inputs
    function clearForm() {
        registrationForm.reset();
        clearErrors();
    }
});