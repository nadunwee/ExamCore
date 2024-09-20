let questions = [];

function addQuestion() {
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

        questions.push(questionObj);
        displayQuestions();
        clearForm();
    } else {
        alert('Please fill out all fields.');
    }
}

function displayQuestions() {
    const questionList = document.getElementById('question-list');
    questionList.innerHTML = '';

    questions.forEach((q, index) => {
        const li = document.createElement('li');
        li.innerHTML = `${index + 1}. ${q.question} <br> 
        Answers: ${q.answers.join(', ')} 
        <button class="edit-btn" onclick="loadQuestion(${index})">Edit</button> 
        <button class="delete-btn" onclick="deleteQuestion(${index})">Delete</button>`;
        questionList.appendChild(li);
    });
}

function loadQuestion(index) {
    // Load the selected question into the form for editing
    const question = questions[index];
    document.getElementById('question').value = question.question;
    document.getElementById('answer1').value = question.answers[0];
    document.getElementById('answer2').value = question.answers[1];
    document.getElementById('answer3').value = question.answers[2];
    document.getElementById('answer4').value = question.answers[3];
    document.getElementById('question-index').value = index; // Store the index for updating
}

function updateQuestion() {
    const questionIndex = document.getElementById('question-index').value;
    const questionText = document.getElementById('question').value;
    const answer1 = document.getElementById('answer1').value;
    const answer2 = document.getElementById('answer2').value;
    const answer3 = document.getElementById('answer3').value;
    const answer4 = document.getElementById('answer4').value;

    if (questionIndex !== '') {
        questions[questionIndex] = {
            question: questionText,
            answers: [answer1, answer2, answer3, answer4],
        };
        displayQuestions();
        clearForm();
    } else {
        alert('No question selected for update.');
    }
}

function deleteQuestion(index) {
    questions.splice(index, 1); // Remove the question at the specified index
    displayQuestions();
}

function clearForm() {
    document.getElementById('question').value = '';
    document.getElementById('answer1').value = '';
    document.getElementById('answer2').value = '';
    document.getElementById('answer3').value = '';
    document.getElementById('answer4').value = '';
    document.getElementById('question-index').value = ''; // Clear the hidden index field
}
