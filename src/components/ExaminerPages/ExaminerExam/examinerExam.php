<?php
session_start();

if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}

$userEmail = $_SESSION['user-email'];

include('../../../php/config.php');

$query = $conn->prepare("SELECT * FROM paper WHERE email = ?");
$query->bind_param('s', $userEmail);

if ($query->execute()) {
  $result = $query->get_result();
}

$query->close();
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>Examiner's Question Page</title>

  <link rel="stylesheet" href="./examinerExam.css">
  <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
  <script src="exam.js"></script>
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <!-- Sidebar -->
      <aside class="sidebar">
        <h1>ExamCore</h1>
        <ul>
          <li><a href="../examinerHome.php">Home</a></li>
          <li><a href="../ExaminerExam/examinerExam.php">Exams</a></li>
          <li><a href="../ExaminerNotification/examinerNotifications.php">Notifications</a></li>

        </ul>
        <a href="../ExaminerProfile/examinerProfile.php"><button class="profile-btn">Examiner Profile</button></a>

      </aside>

      <!-- Main content -->
      <main class="main-content">
        <!-- Add/Edit Question Form -->
        <form method="post" action="./addExamQuestions.php" class="crud-form" id="question-form">
          <h2>Add/Edit Question</h2>

          <label for="question_ID">Question ID:</label>
          <input type="text" name="question_ID" id="question_ID" readonly />

          <label for="question">Question:</label>
          <input type="text" name="question" id="question" placeholder="Type the question here" />

          <label for="answer1">Answer 1:</label>
          <input type="text" name="answer1" id="answer1" placeholder="Type answer 1 here" />

          <label for="answer2">Answer 2:</label>
          <input type="text" name="answer2" id="answer2" placeholder="Type answer 2 here" />

          <label for="answer3">Answer 3:</label>
          <input type="text" name="answer3" id="answer3" placeholder="Type answer 3 here" />

          <label for="answer4">Answer 4:</label>
          <input type="text" name="answer4" id="answer4" placeholder="Type answer 4 here" />

          <label for="correct_ans">Correct answer:</label>
          <input type="text" name="correct_ans" id="correct_ans" placeholder="Type the correct answer here" />

          <input class="submit-btn" type="submit" value="Save Question">

          <!-- Hidden fields to store email and edit mode status -->
          <input type="hidden" name="email" value="<?php echo $_SESSION['user-email'] ?>" />
          <input type="hidden" id="edit_mode" name="edit_mode" value="0" />
        </form>

        <!-- Questions List -->
        <div class="questions-list">
          <h2>Questions List</h2>
          <ul id="question-list">
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<li>';
                echo '<form method="post" action="./delete_question.php">';
                echo '<div class="question-item">';
                echo '<h3>' . $row['question'] . '</h3><br>'; // Display the question

                echo '<ul class="answers-list">';
                echo '<li>' . $row['answer_1'] . '</li>';
                echo '<li>' . $row['answer_2'] . '</li>';
                echo '<li>' . $row['answer_3'] . '</li>';
                echo '<li>' . $row['answer_4'] . '</li>';


                echo '</ul>';

                echo '<input type="hidden" name="question_ID" value="' . $row['question_ID'] . '">';
                echo '<input type="hidden" name="correct_ans" value="' . $row['correst_answer'] . '">';
                echo '<button class="delete-btn" type="submit">Delete</button>';
                echo '<button class="edit-btn" type="button" onclick="editQuestion(' . htmlspecialchars(json_encode($row)) . ')">Edit</button>';
                echo '</div>';
                echo '</form>';
                echo '</li>';
              }
            } else {
              echo '<p>No questions available.</p>';
            }
            ?>
          </ul>
        </div>
      </main>

      <script>
        // JavaScript function to populate the form fields with the selected question for editing
        function editQuestion(question) {
          document.getElementById('question_ID').value = question.question_ID;
          document.getElementById('question').value = question.question;
          document.getElementById('answer1').value = question.answer_1;
          document.getElementById('answer2').value = question.answer_2;
          document.getElementById('answer3').value = question.answer_3;
          document.getElementById('answer4').value = question.answer_4;
          document.getElementById('correct_ans').value = question.correst_answer;

          // Set the form action to "update_questions.php" for editing
          document.getElementById('question-form').action = './update_questions.php';

          // Set edit_mode to "1" indicating this is an edit operation
          document.getElementById('edit_mode').value = "1";

          // Alert for edit
          alert('You are editing the selected question.');
        }

        // Alert box for submit
        const questionForm = document.getElementById('question-form');
        questionForm.addEventListener('submit', function(event) {
          event.preventDefault();
          if (confirm('Are you sure you want to submit this question?')) {
            alert('Question submitted successfully!');
            questionForm.submit();
          } else {
            alert('Question submission canceled.');
          }
        });

        // Attach alert box for delete button
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(function(button) {
          button.addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this question?')) {
              alert('The question has been deleted successfully!');
              button.closest('form').submit();
            } else {
              alert('Question deletion canceled.');
            }
          });
        });
      </script>



      <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions </a>| <a href="#">Privacy
            Policy</a></p>
      </footer>
    </div>
  </div>

</body>

</html>