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

$query = $conn->prepare("SELECT question_id, question, answer_1, answer_2, answer_3, answer_4 FROM paper");

if ($query->execute()) {
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $examData = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
    } else {
        echo "No questions found!";
        exit();
    }
}

$query->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="studentExamPaper_styles.css">
    <title>ExamCore</title>
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

        <div class="studentExamPaper_content">
            <!-- Loop through examData to display each question -->
            <?php if (isset($examData) && count($examData) > 0): ?>
                <?php foreach ($examData as $row): ?>
                    <div class="examPaper_questionNumber">Question <?php echo htmlspecialchars($row['question_id']); ?></div>
                    <div class="examPaper_question"><?php echo htmlspecialchars($row['question']); ?></div>
                    <div class="examPaper_answerSet">
                        <div class="exam_answer">
                            <input type="radio" name="answerSet_<?php echo htmlspecialchars($row['question_id']); ?>" value="1">
                            <span class="answerSet"><?php echo htmlspecialchars($row['answer_1']); ?></span><br>
                        </div>
                        <div class="exam_answer">
                            <input type="radio" name="answerSet_<?php echo htmlspecialchars($row['question_id']); ?>" value="2">
                            <span class="answerSet"><?php echo htmlspecialchars($row['answer_2']); ?></span><br>
                        </div>
                        <div class="exam_answer">
                            <input type="radio" name="answerSet_<?php echo htmlspecialchars($row['question_id']); ?>" value="3">
                            <span class="answerSet"><?php echo htmlspecialchars($row['answer_3']); ?></span><br>
                        </div>
                        <div class="exam_answer">
                            <input type="radio" name="answerSet_<?php echo htmlspecialchars($row['question_id']); ?>" value="4">
                            <span class="answerSet"><?php echo htmlspecialchars($row['answer_4']); ?></span><br>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="noQuestionsAvailable">No question data available.</p>
            <?php endif; ?>
        </div>

        <div class="studentExam-buttons">
            <button class="studentExam-submit-button" type="button">Submit</button>
        </div>
    </div>
</body>

</html>