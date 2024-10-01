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
    
    
    const examinerSelect = document.getElementById("examinerSelect");
    const assignTo = document.getElementById("assignTo");

    // Fetch examiners and populate the examiner dropdown
    fetch('assignExaminers.php')
        .then(response => response.json())
        .then(examiners => {
            examiners.forEach(examiner => {
                const option = document.createElement("option");
                option.value = examiner.examiner_id;
                option.textContent = examiner.name;
                examinerSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching examiners:', error));

    // Fetch exams and populate the exam dropdown
    fetch('getExams.php')
        .then(response => response.json())
        .then(exams => {
            exams.forEach(exam => {
                const option = document.createElement("option");
                option.value = exam.exam_id;
                option.textContent = exam.exam_name;
                assignTo.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching exams:', error));

    // Open modal when the "Assign Examiner" button is clicked
    assignExaminerBtn.addEventListener("click", function () {
        assignExaminerModal.style.display = "block";
    });

    // Open modal when the "Add Examiner" button is clicked
    addExaminerBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "block";
    });

    // Close modals
    [addcloseModalBtn, assigncloseModalBtn].forEach(btn => {
        btn.addEventListener("click", function () {
            btn.closest(".modal").style.display = "none"; // Hide the modal
            clearForm(); // Clear the form when closing the modal
        });
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", function (event) {
        if (event.target === addExaminerModal || event.target === assignExaminerModal) {
            event.target.style.display = "none"; // Hide the modal
            clearForm(); // Clear the form when closing the modal
        }
    });

    // Form submission handling with validation
    registrationForm.addEventListener("submit", function (event) {
        let valid = true;
        clearErrors(); // Clear any previous error messages

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

// Find the table element directly
const examinerTable = document.getElementById("examinerTable");

// Create a new row (tr) and cells (td)
const row = document.createElement("tr");
const cell1 = document.createElement("td");
const cell2 = document.createElement("td");
const cell3 = document.createElement("td");

// Add data to the cells
cell1.textContent = "Examiner Name";
cell2.textContent = "Exam ID";

// Create a delete button
const deleteButton = document.createElement("button");
deleteButton.textContent = "Delete";

// Add event listener to handle delete action
deleteButton.addEventListener("click", function() {
    row.remove();
});

// Append the delete button to the third cell
cell3.appendChild(deleteButton);

// Append cells to the row
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
// Append the row to the table (without tbody)
examinerTable.appendChild(row);
