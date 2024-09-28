<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'exam_core');

// Check connection
if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
}

// Redirect to login page if the session is not set
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

$studentID = $_SESSION['user-email'];

// Prepare the query to select student data
$query = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$query->bind_param('i', $studentID);

// Execute the query
if ($query->execute()) {
    $result = $query->get_result();
    
    // Fetch the data into an associative array
    $row = $result->fetch_assoc();
}

// Close the query and connection
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
            <!-- Check if $row is not null before trying to access its values -->
            <?php if (isset($row)): ?>
                <div class="examPaper_questionNumber">Question <?php echo htmlspecialchars($row['question_id']); ?></div>
                <div class="examPaper_question"><?php echo htmlspecialchars($row['question']); ?></div>
                <div class="examPaper_answerSet">
                    <div class="exam_answer">
                        <input type="radio" name="answerSet" value="1"><span class="answerSet"><?php echo htmlspecialchars($row['answer_1']); ?></span><br>
                    </div>
                    <div class="exam_answer">
                        <input type="radio" name="answerSet" value="2"><span class="answerSet"><?php echo htmlspecialchars($row['answer_2']); ?></span><br>
                    </div>
                    <div class="exam_answer">
                        <input type="radio" name="answerSet" value="3"><span class="answerSet"><?php echo htmlspecialchars($row['answer_3']); ?></span><br>
                    </div>
                    <div class="exam_answer">
                        <input type="radio" name="answerSet" value="4"><span class="answerSet"><?php echo htmlspecialchars($row['answer_4']); ?></span><br>
                    </div>
                </div>
            <?php else: ?>
                <p class="noQuestionsAvailable">No question data available.</p>
            <?php endif; ?>
        </div>

        <div class="studentExam-buttons">
            <button class="studentExam-submit-button" type="button">Submit</button>
            <button class="studentExam-nextQ-button" type="button">Next Question</button>
        </div>
    </div>
</body>
</html>