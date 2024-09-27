// Modal functionality for "Assign Examiner" 
const assignExaminerButton = document.querySelector('.assign-examiner-btn');
const addExaminerButton = document.querySelector('.add-examiner-btn');
const assignExaminerModal = document.getElementById('assignExaminerModal');
const addExaminerModal = document.getElementById('addExaminerModal');
const editExaminerModal = document.getElementById('editExaminerModal');
const closeButtons = document.querySelectorAll('.close');

// Open and close the "Assign Examiner" modal
assignExaminerButton.addEventListener('click', () => {
    closeAllModals(); // Close all modals before opening a new one
    assignExaminerModal.style.display = 'block';
});

// Add Examiner modal functionality
addExaminerButton.addEventListener('click', () => {
    closeAllModals(); // Close all modals before opening a new one
    addExaminerModal.style.display = 'block';
});

// Close modals function
function closeAllModals() {
    assignExaminerModal.style.display = 'none';
    addExaminerModal.style.display = 'none';
    editExaminerModal.style.display = 'none';
}

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target === assignExaminerModal || event.target === addExaminerModal || event.target === editExaminerModal) {
        closeAllModals();
    }
};

// Close buttons for modals
closeButtons.forEach(button => {
    button.addEventListener('click', closeAllModals);
});

// Password validation function for Add Examiner form
function checkPasswords(event) {
    event.preventDefault();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
    } else {
        // Submit the form via AJAX or regular form submission
        document.querySelector('#addExaminerModal form').submit();
    }
}

// Attach submit functionality to the 'Sign up with Email' button
const registerSubmitButton = document.querySelector('.register-submit-btn');
if (registerSubmitButton) {
    registerSubmitButton.addEventListener('click', checkPasswords);
}

// Save and Cancel button functionality for editing
const saveButton = document.querySelector('.save-btn');
let rowToEdit = null; // Track the row being edited
if (saveButton) {
    saveButton.addEventListener('click', () => {
        const updatedName = document.getElementById('editExaminerName').value;
        const updatedExam = document.getElementById('editAssignTo').value;

        if (updatedName && updatedExam !== 'select') {
            if (rowToEdit) {
                rowToEdit.querySelector('td:nth-child(1)').textContent = updatedName;
                rowToEdit.querySelector('td:nth-child(2)').textContent = updatedExam;
                editExaminerModal.style.display = 'none'; // Close the modal after saving
            } else {
                console.error('No row selected for editing.');
            }
        } else {
            alert('Please fill in both Examiner Name and Assigned Exam fields.');
        }
    });
}

// Cancel button functionality
const cancelButton = document.querySelector('.cancel-btn');
if (cancelButton) {
    cancelButton.addEventListener('click', () => {
        editExaminerModal.style.display = 'none'; // Close the modal without saving
    });
}

// Assign button functionality
const assignButton = document.querySelector('.assign-btn');
if (assignButton) {
    assignButton.addEventListener('click', () => {
        const examinerName = document.getElementById('examinerSelect').value;
        const assignedExam = document.getElementById('assignTo').value;

        if (examinerName && assignedExam !== 'select') {
            examiners.push({ name: examinerName, exam: assignedExam });
            updateTable();
            assignExaminerModal.style.display = 'none'; // Close the modal after assigning
        } else {
            alert('Please fill in both Examiner Name and Assigned Exam fields.');
        }
    });
}

// Function to update the examiner table
const examinerTable = document.querySelector('table tbody');
let examiners = [
    { name: "Examiner 1", exam: "Exam A" },
    { name: "Examiner 2", exam: "Exam B" }
];

function updateTable() {
    examinerTable.innerHTML = ''; // Clear the table
    examiners.forEach((examiner, index) => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${examiner.name}</td>
            <td>${examiner.exam}</td>
            <td>
                <button type="button" class="edit-btn" data-index="${index}">Edit</button>
                <button type="button" class="delete-btn" data-index="${index}">Delete</button>
            </td>
        `;
        examinerTable.appendChild(newRow);
    });
    attachDeleteHandlers();
    attachEditHandlers();
}

// Attach event handlers for delete and edit buttons
function attachDeleteHandlers() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');
            examiners.splice(index, 1); 
            updateTable(); 
        });
    });
}

function attachEditHandlers() {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');
            const examinerToEdit = examiners[index];
            rowToEdit = button.closest('tr'); 
            document.getElementById('editExaminerName').value = examinerToEdit.name;
            document.getElementById('editAssignTo').value = examinerToEdit.exam; 
            editExaminerModal.style.display = 'block'; 
        });
    });
}

// Initial table update
updateTable();
