// Modal functionality
const assignExaminerButton = document.querySelector('.assign-examiner-btn');
const assignExaminerModal = document.getElementById('assignExaminerModal');
const editExaminerModal = document.getElementById('editExaminerModal');
const closeButton = document.querySelector('.close');

// Variable to store the row being edited
let rowToEdit = null;

// Open and close the "assign Examiner" modal
assignExaminerButton.addEventListener('click', () => {
  assignExaminerModal.style.display = 'block';
});

closeButton.addEventListener('click', () => {
  assignExaminerModal.style.display = 'none';
});

// Save button functionality
const saveButton = document.querySelector('.save-btn');
saveButton.addEventListener('click', () => {
  const updatedName = document.getElementById('editExaminerName').value;
  const updatedExam = document.getElementById('editAssignTo').value;

  if (updatedName && updatedExam !== 'select') {
    // Check if rowToEdit is not null
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

// Cancel button functionality
const cancelButton = document.querySelector('.cancel-btn');
cancelButton.addEventListener('click', () => {
  editExaminerModal.style.display = 'none'; // Close the modal without saving
});

// assign button functionality to assign a new examiner
const assignButton = document.querySelector('.assign-btn');
assignButton.addEventListener('click', () => {
  const examinerName = document.getElementById('examinerName').value;
  const assignedExam = document.getElementById('assignTo').value;

  if (examinerName && assignedExam !== 'select') {
    if (rowToEdit) {
      // Update the existing examiner row
      const indexToUpdate = examiners.findIndex(examiner => examiner.name === rowToEdit.querySelector('td:nth-child(1)').textContent);
      if (indexToUpdate !== -1) {
        examiners[indexToUpdate].name = examinerName;
        examiners[indexToUpdate].exam = assignedExam;
        updateTable();
        assignExaminerModal.style.display = 'none';
        rowToEdit = null; // Reset the rowToEdit variable
      } else {
        console.error('Could not find examiner to update.');
      }
    } else {
      // assign a new examiner if no row is being edited
      examiners.push({ name: examinerName, exam: assignedExam });
      updateTable();
      assignExaminerModal.style.display = 'none';
    }
  } else {
    alert('Please fill in both Examiner Name and Assigned Exam fields.');
  }
});

// Function to update the examiner table
const examinerTable = document.querySelector('table tbody');
let examiners = [
  { name: "Examiner 1", exam: "Exam A" },
  { name: "Examiner 2", exam: "Exam B" }
];

function updateTable() {
  examinerTable.innerHTML = ''; // Clear existing rows
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
  attachDeleteHandlers(); // Attach delete functionality after updating the table
  attachEditHandlers();   // Re-attach the edit functionality after table update
}

// Attach event handlers to delete buttons
function attachDeleteHandlers() {
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', (event) => {
      const index = event.target.getAttribute('data-index');
      examiners.splice(index, 1); // Remove the examiner
      updateTable(); // Refresh the table
    });
  });
}

// Re-attach event listeners for edit buttons after the table is updated
function attachEditHandlers() {
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', event => {
      rowToEdit = event.target.closest('tr'); // Get the row to edit
      if (rowToEdit) {
        const examinerName = rowToEdit.querySelector('td:nth-child(1)').textContent;
        const assignedExam = rowToEdit.querySelector('td:nth-child(2)').textContent;

        // Pre-fill the modal form with existing data
        document.getElementById('editExaminerName').value = examinerName;
        document.getElementById('editAssignTo').value = assignedExam;

        // Show the edit modal
        editExaminerModal.style.display = 'block';
      } else {
        console.error('Row to edit not found.');
      }
    });
  });
}

// Initial table update
updateTable(); // Call this at the beginning to load the data
