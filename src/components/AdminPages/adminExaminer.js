// Modal functionality
const addExaminerButton = document.querySelector('.add-examiner-btn');
const addExaminerModal = document.getElementById('addExaminerModal');
const closeButton = document.querySelector('.close');

// Open and close the modal
addExaminerButton.addEventListener('click', () => {
  addExaminerModal.style.display = 'block';
});

closeButton.addEventListener('click', () => {
  addExaminerModal.style.display = 'none';
});

const editButtons = document.querySelectorAll('.edit-btn');
const editModal = document.getElementById('editExaminerModal');
const addButton = document.querySelector('.add-btn');

editButtons.forEach(button => {
  button.addEventListener('click', event => {
    const rowToEdit = event.target.closest('tr');
    const examiner = examiners.find(examiner => {
      return examiner.name === rowToEdit.querySelector('td:nth-child(1)').textContent &&
             examiner.exam === rowToEdit.querySelector('td:nth-child(2)').textContent;
    });

    if (examiner) {
      // Pre-fill the modal form with existing data
      document.getElementById('editExaminerName').value = examiner.name;
      document.getElementById('editAssignTo').value = examiner.exam;

      editExaminerModal.style.display = 'block';
    } else {
      console.error('Could not find examiner to edit.');
    }
  });
});

addButton.addEventListener('click', () => {
  const examinerName = document.getElementById('examinerName').value;
  const assignedExam = document.getElementById('assignTo').value;

  if (examinerName && assignedExam !== 'select') {
    const indexToUpdate = examiners.findIndex(examiner => examiner.name === rowToEdit.querySelector('td:nth-child(1)').textContent);
    if (indexToUpdate !== -1) {
      examiners[indexToUpdate].name = examinerName;
      examiners[indexToUpdate].exam = assignedExam;
      updateTable();
      addExaminerModal.style.display = 'none';
    } else {
      console.error('Could not find examiner to update.');
    }
  } else {
    alert('Please fill in both Examiner Name and Assigned Exam fields.');
  }
});


const examinerTable = document.querySelector('table tbody');
let examiners = [
  { name: "Examiner 1", exam: "Exam A" },
  { name: "Examiner 2", exam: "Exam B" }
];

// Function to update the table
function updateTable() {
  examinerTable.innerHTML = ''; // Clear existing rows
  examiners.forEach((examiner, index) => {
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td>${examiner.name}</td>
      <td>${examiner.exam}</td>
      <td><button type="button" class="delete-btn" data-index="${index}">Delete</button></td>
    `;
    examinerTable.appendChild(newRow);
  });
  attachDeleteHandlers(); // Attach delete functionality after updating the table
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

// Add a new examiner and update the table
document.querySelector('.add-btn').addEventListener('click', () => {
  const examinerName = document.getElementById('examinerName').value;
  const assignedExam = document.getElementById('assignTo').value;

  if (examinerName && assignedExam) {
    examiners.push({ name: examinerName, exam: assignedExam });
    updateTable();
    addExaminerModal.style.display = 'none';
  }
});

// Initial table update
updateTable();
