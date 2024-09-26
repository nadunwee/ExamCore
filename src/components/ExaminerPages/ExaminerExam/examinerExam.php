<?php
session_start();

// Establish a connection to the database
$conn = new mysqli('localhost', 'root', '', 'exam_core');

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data
    $ques_ID = $_POST["question_ID"];
    $ques = $_POST["question"];
    $ans1 = $_POST["answer1"];
    $ans2 = $_POST["answer2"];
    $ans3 = $_POST["answer3"];
    $ans4 = $_POST["answer4"];
    $c_ans = $_POST["correct_ans"];
    $mail = $_POST["email"];

    // Prepare the SQL statement
    $query = $conn->prepare("INSERT INTO paper (Question, answer_1, answer_2, answer_3, answer_4, correst_answer,email) VALUES (?, ?, ?, ?, ?, ?,?)");

    // Check if the query preparation was successful
    if ($query === false) {
        die("SQL Error: " . $conn->error);  // Output detailed error if prepare fails
    }

    // Bind the parameters
    $query->bind_param("sssssss", $ques, $ans1, $ans2, $ans3, $ans4, $c_ans,$mail);

    // Execute the query and check if successful
    if ($query->execute()) {
        
    } else {
        echo "Execution Error: " . $query->error;
    }

    // Close the query and connection
    $query->close();
}

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

        <form method="post" action="./examinerExam.php" class="crud-form">
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

          <input  class="submit-btn" type="submit">  <input type="reset">
          
          <input type="text" hidden name="email" value=<?php echo $_SESSION['user-email'] ?> />

          

          <!-- Add button to trigger saveQuestion -->
          <button class="save-btn" onclick="saveQuestion()">
            Save Question
          </button>
        </form>

        <!-- Questions List -->
       
 
  
  <div class="questions-list">
  <h2>Questions List</h2>
  
  <ul id="question-list">
    <!-- Question Template -->
    <li>
      <form>
        <div class="question-item">
          <h3>Question 1</h3><br>
          <ul class="answers-list">
            <li>
              <label>
                <input type="radio" name="answer" value="Paris"> Answer1
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="answer" value="London"> Answer2
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="answer" value="Berlin"> Answer3
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="answer" value="Madrid"> Answer4
              </label>
            </li>
          </ul>
          <button type="submit">Submit</button>
        </div>
      </form>
    </li>
    <!-- Add more questions here -->
  </ul>
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