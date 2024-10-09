<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];
$userPassword = $_SESSION['user-pswd'];

include('../../../php/config.php');

$query = $conn->prepare("SELECT question_id, question, answer_1, answer_2, answer_3, answer_4, correct_answer FROM paper");

if ($query->execute()) {
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $examData = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "No questions found!";
        exit();
    }
}

$query->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['question_id']) && isset($_POST['submitted_answer'])) {
        $questionId = $_POST['question_id'];
        $submittedAnswer = $_POST['submitted_answer'];

        // Get the correct answer from the paper table
        $query = $conn->prepare("SELECT correct_answer FROM paper WHERE question_id = ?");
        $query->bind_param("i", $questionId);
        $query->execute();
        $query->bind_result($correctAnswer);
        $query->fetch();
        $query->close();

        // Insert the data into the answertable
        $insertQuery = $conn->prepare("INSERT INTO answertable (question_id, correct_answer, submitted_answer) VALUES (?, ?, ?)");
        $insertQuery->bind_param("iss", $questionId, $correctAnswer, $submittedAnswer);
        if ($insertQuery->execute()) {
            header('Location: studentExamPaper.php');
            exit();
        } else {
            echo "Error saving answer: " . $insertQuery->error;
        }
        $insertQuery->close();
    } else {
        echo "Question ID or Submitted Answer not set.";
    }
}

// Calculate the count of correct answers
// $countCorrectAnswersQuery = $conn->prepare("SELECT COUNT(*) FROM answertable WHERE correct_answer = submitted_answer");
// if ($countCorrectAnswersQuery->execute()) {
//     $result = $countCorrectAnswersQuery->get_result();
//     $correctCount = $result->fetch_row()[0]; // Fetch the count of correct answers
// } else {
//     echo "Error counting correct answers: " . $countCorrectAnswersQuery->error;
//     $correctCount = 0; // Default to 0 if there was an error
// }

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="studentExamPaper_styles.css">
    <title>ExamCore</title>
    <script defer src="submitExam.js"></script>
</head>

<body>
    <div class="studentExamPaper_container">
        <div class="details_block">
            <div class="remainingQuestions_block">
                <p>Total questions answered</p>
                <span class="remainingQuestions_num">00/00</span>
            </div>

            <div class="remainingTime_block">
                <p>Time remaining</p>
                <span class="remainingTime_num">00:00</span>
            </div>
        </div>

        <!-- Loop through examData to display each question -->
        <?php if (isset($examData) && count($examData) > 0): ?>
            <?php foreach ($examData as $row): ?>
                <div class="studentExamPaper_content">
                    <div class="examPaper_questionNumber">Question <?php echo htmlspecialchars($row['question_id']); ?></div>
                    <form action="" method="post" id="AnswerScript<?php echo $row['question_id']; ?>" class="answer-form">
                        <input type="hidden" name="question_id" value="<?php echo $row['question_id']; ?>">
                        <input type="hidden" name="submitted_answer" id="submitted_answer<?php echo $row['question_id']; ?>">

                        <div class="examPaper_question"><?php echo htmlspecialchars($row['question']); ?></div>
                        <div class="examPaper_answerSet">
                            <div class="exam_answer">
                                <input type="radio" name="answerSet<?php echo $row['question_id']; ?>" value="1"
                                    data-answer="<?php echo htmlspecialchars($row['answer_1']); ?>"
                                    onchange="getRadioValue(this, <?php echo $row['question_id']; ?>)">
                                <span class="answerSet"><?php echo htmlspecialchars($row['answer_1']); ?></span><br>
                            </div>
                            <div class="exam_answer">
                                <input type="radio" name="answerSet<?php echo $row['question_id']; ?>" value="2"
                                    data-answer="<?php echo htmlspecialchars($row['answer_2']); ?>"
                                    onchange="getRadioValue(this, <?php echo $row['question_id']; ?>)">
                                <span class="answerSet"><?php echo htmlspecialchars($row['answer_2']); ?></span><br>
                            </div>
                            <div class="exam_answer">
                                <input type="radio" name="answerSet<?php echo $row['question_id']; ?>" value="3"
                                    data-answer="<?php echo htmlspecialchars($row['answer_3']); ?>"
                                    onchange="getRadioValue(this, <?php echo $row['question_id']; ?>)">
                                <span class="answerSet"><?php echo htmlspecialchars($row['answer_3']); ?></span><br>
                            </div>
                            <div class="exam_answer">
                                <input type="radio" name="answerSet<?php echo $row['question_id']; ?>" value="4"
                                    data-answer="<?php echo htmlspecialchars($row['answer_4']); ?>"
                                    onchange="getRadioValue(this, <?php echo $row['question_id']; ?>)">
                                <span class="answerSet"><?php echo htmlspecialchars($row['answer_4']); ?></span><br>
                            </div>
                            <div>
                                <p id="AnswerRecorded<?php echo $row['question_id']; ?>"></p>
                            </div>
                            <div style="margin-bottom: 40px;" class="studentExam-buttons">
                                <button class="studentExam-done-button" type="button"
                                    onclick="submitAnswer(<?php echo $row['question_id']; ?>)">Done</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="noQuestionsAvailable">No question data available.</p>
        <?php endif; ?>

        <div style="margin-bottom: 40px;" class="studentExam-buttons">
            <button style="background-color: #c057ab; margin-left:100px" class="studentExam-submit-button" type="button"
                onclick="getCorrectCount()">Submit</button>
        </div>

        <!-- Display the count of correct answers -->
        <div style="font-family:poppins; margin: 10px;">
            <h3 id="correctCountDisplay">Correct Count Show After submit the exam.</h3>
        </div>
    </div>

    <script>
        function getRadioValue(radio, questionId) {
            // Get the associated answer string using the data-answer attribute
            const selectedAnswer = radio.getAttribute('data-answer');

            // Set the hidden input field value
            document.getElementById(`submitted_answer${questionId}`).value = selectedAnswer;
        }

        function submitAnswer(questionId) {
            const form = document.getElementById(`AnswerScript${questionId}`);
            const formData = new FormData(form);

            // Create an XMLHttpRequest to send the data to the server
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // The URL is empty to submit to the same page

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the answer recorded message without refreshing
                    document.getElementById(`AnswerRecorded${questionId}`).innerHTML = "Answer Recorded!";
                }
            };

            xhr.send(formData);
        }
        // function getCorrectCount(count) {
        //     console.log(count);

        //     document.getElementById(`correctCountDisplay`).innerHTML = "Total Correct Answer = " + count;
        // }
        function getCorrectCount() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "getCorrectAnswerCount.php", true); // Ensure this path is correct
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log(xhr.responseText); // Log the response for debugging
                    if (xhr.status === 200) {
                        document.getElementById("correctCountDisplay").innerText = "Total Correct Answers: " + xhr.responseText;
                    } else {
                        console.error("Error fetching correct count: ", xhr.status);
                    }
                }
            };

            xhr.send(); // Send the request
        }
    </script>


    </div>
</body>

</html>