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
          <li><a href="../examinerHome.html">Home</a></li>
          <li><a href="../ExaminerExam/examinerExam.html">Exams</a></li>
          <li><a href="../ExaminerResult/examierResult.html">Results</a></li>
          <li><a href="../ExaminerNotification/ExaminerNotification.html">Notifications</a></li>
        </ul>
        <a href="../ExaminerProfile/examinerProfile.html"><button class="profile-btn">Examiner Profile</button></a>

      </aside>

      <!-- Main content -->
      <main class="main-content">
        <!-- Question Form -->

        <form method="post" action="./addExamQuestions.php" class="crud-form">
          <h2>Add/Edit Question</h2>

          <label for="question_ID">Question ID:</label>
          <input type="text" name="question_ID"/>

          <label for="question">Question:</label>
          <input type="text" name="question" placeholder="Type the question here" />

          <label for="answer1">Answer 1:</label>
          <input type="text" name="answer1" placeholder="Type answer 1 here" />

          <label for="answer2">Answer 2:</label>
          <input type="text" name="answer2" placeholder="Type answer 2 here" />

          <label for="answer3">Answer 3:</label>
          <input type="text" name="answer3" placeholder="Type answer 3 here" />

          <label for="answer4">Answer 4:</label>
          <input type="text" name="answer4" placeholder="Type answer 4 here" />

          <label for="correct_ans">Correct answer:</label>
          <input type="text" name="correct_ans" placeholder="Type the correct answer here" />

          <input  class="submit-btn" type="submit">  
          
          <input type="text" hidden name="email" value=<?php echo $_SESSION['user-email'] ?> />

          

          <!-- Add button to trigger saveQuestion -->
          
        </form>

        <!-- Questions List -->

  <div class="questions-list">
  <h2>Questions List</h2>
  <ul id="question-list">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Assuming columns: 'question', 'answer1', 'answer2', 'answer3', 'answer4'
        echo '<li>';
        echo '<form action="./delete_question.php" method="POST">';
        echo '<div class="question-item">';
        echo '<h3>' . $row['question'] . '</h3><br>'; // Display the question

        echo '<ul class="answers-list">';
        echo '<li><label><input type="radio" name="answer" value="' . $row['answer_1'] . '"> ' . $row['answer_1'] . '</label></li>';
        echo '<li><label><input type="radio" name="answer" value="' . $row['answer_2'] . '"> ' . $row['answer_2'] . '</label></li>';
        echo '<li><label><input type="radio" name="answer" value="' . $row['answer_3'] . '"> ' . $row['answer_3'] . '</label></li>';
        echo '<li><label><input type="radio" name="answer" value="' . $row['answer_4'] . '"> ' . $row['answer_4'] . '</label></li>';
        echo '</ul>';

        echo '<input type="hidden" name="question_ID" value="' . $row['question_ID'] . '">';

        echo '<button class ="delete-btn" type="submit">Delete</button>';
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
</div>


        
      </main>

      <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions </a>| <a href="#">Privacy
            Policy</a></p>
      </footer>
    </div>
  </div>

</body>

</html>