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
    
    
    const toggleFields = () => {
        const examinerSelect = document.getElementById("examinerSelect");
        const assignTo = document.getElementById("assignTo");
    
        // Clear any previous options
        examinerSelect.innerHTML = "";
        assignTo.innerHTML = "";
    
        fetch('assignExaminer.php')
            .then(response => response.json())
            .then(data => {
                // Populate examiners dropdown
                data.examiners.forEach(examiner => {
                    const option = document.createElement("option");
                    option.value = examiner.examiner_id;
                    option.textContent = examiner.name;
                    examinerSelect.appendChild(option);
                });
    
                // Populate exams dropdown
                data.exams.forEach(exam => {
                    const option = document.createElement("option");
                    option.value = exam.exam_id;
                    option.textContent = exam.exam_name;
                    assignTo.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching examiners or exams:', error));
    };

        assignExaminerBtn.addEventListener("click", function () {
        assignExaminerModal.style.display = "block";
    });

        addExaminerBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "block";
    });

    
    [addcloseModalBtn, assigncloseModalBtn].forEach(btn => {
        btn.addEventListener("click", function () {
            btn.closest(".modal").style.display = "none"; 
            clearForm(); 
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addExaminerModal || event.target === assignExaminerModal) {
            event.target.style.display = "none"; 
            clearForm();
        }
    });

    registrationForm.addEventListener("submit", function (event) {
        let valid = true;
        clearErrors();
        
        if (!validateEmail(emailField.value)) {
            showError(emailField, "Please enter a valid email address.");
            valid = false;
        }

        if (passwordField.value.length < 6) {
            showError(passwordField, "Password must be at least 6 characters long.");
            valid = false;
        }

        if (passwordField.value !== confirmPasswordField.value) {
            showError(confirmPasswordField, "Passwords do not match.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function showError(input, message) {
        const error = document.createElement("div");
        error.className = "error-message";
        error.textContent = message;
        input.parentElement.appendChild(error);
    }

    function clearErrors() {
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach((error) => error.remove());
    }

    function clearForm() {
        registrationForm.reset();
        clearErrors();
    }
});

// const examinerTable = document.getElementById("examinerTable");

// function deleteExaminer(examinerId, row) {
//     fetch('deleteExaminer.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: `examiner_id=${examinerId}`
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             row.remove();
//         } else {
//             console.error('Failed to delete examiner:', data.error);
//         }
//     })
//     .catch(error => console.error('Error deleting examiner:', error));
// }

// function populateTable(examiners) {
//     examiners.forEach(examiner => {
//         const row = document.createElement("tr");

//         const cell1 = document.createElement("td");
//         cell1.textContent = examiner.name;

//         const cell2 = document.createElement("td");
//         cell2.textContent = examiner.exam_name;

//         const cell3 = document.createElement("td");
//         const deleteButton = document.createElement("button");
//         deleteButton.textContent = "Delete";
//         deleteButton.addEventListener("click", () => deleteExaminer(examiner.examiner_id, row));

//         cell3.appendChild(deleteButton);
//         row.appendChild(cell1);
//         row.appendChild(cell2);
//         row.appendChild(cell3);

//         examinerTable.appendChild(row);
//     });
// }
