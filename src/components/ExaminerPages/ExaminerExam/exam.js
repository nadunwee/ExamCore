let questions = [];
let editingIndex = -1; // Use a variable to track whether you're editing a question

// Function to add or update a question
function saveQuestion() {
    const questionText = document.getElementById('question').value;
    const answer1 = document.getElementById('answer1').value;
    const answer2 = document.getElementById('answer2').value;
    const answer3 = document.getElementById('answer3').value;
    const answer4 = document.getElementById('answer4').value;

    if (questionText && answer1 && answer2 && answer3 && answer4) {
        const questionObj = {
            question: questionText,
            answers: [answer1, answer2, answer3, answer4],
        };

        if (editingIndex >= 0) {
            // If we're editing, replace the existing question
            questions[editingIndex] = questionObj;
            editingIndex = -1; // Reset the index after updating
        } else {
            // If not editing, just add the question
            questions.push(questionObj);
        }

        displayQuestions();
        clearForm();
    } else {
        alert('Please fill out all fields.');
    }
}

// Function to display the questions
function displayQuestions() {
    const questionList = document.getElementById('question-list');
    questionList.innerHTML = ''; // Clear the list

    questions.forEach((q, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            ${index + 1}. ${q.question} <br> 
            Answers: ${q.answers.join(', ')} 

            <button class="edit-btn" onclick="editQuestion(${index})">Edit</button>
            <button class="delete-btn" onclick="deleteQuestion(${index})">Delete</button>`;
            
        questionList.appendChild(li);
    });
}

// Function to edit a question (loads question into form)
function editQuestion(index) {
    const question = questions[index];
    document.getElementById('question').value = question.question;
    document.getElementById('answer1').value = question.answers[0];
    document.getElementById('answer2').value = question.answers[1];
    document.getElementById('answer3').value = question.answers[2];
    document.getElementById('answer4').value = question.answers[3];
    editingIndex = index; // Store the index to update later
}

// Function to delete a question
function deleteQuestion(index) {
    questions.splice(index, 1);
    displayQuestions();
}

// Function to clear the form fields
function clearForm() {
    document.getElementById('question').value = '';
    document.getElementById('answer1').value = '';
    document.getElementById('answer2').value = '';
    document.getElementById('answer3').value = '';
    document.getElementById('answer4').value = '';
    editingIndex = -1; // Reset index
}
