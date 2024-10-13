<?php
session_start();

if (!isset($_SESSION['user-email'])) {
  header('Location: ../../AccessPages/login.php');
  exit();
}
//connection to the database
$conn = new mysqli('localhost', 'root', '', 'exam_core');

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
    $query = $conn->prepare("INSERT INTO paper (Question, answer_1, answer_2, answer_3, answer_4, correct_answer,email) VALUES (?, ?, ?, ?, ?, ?,?)");

    // Check if the query preparation was successful
    if ($query === false) {
        die("SQL Error: " . $conn->error);  
    }

    // Bind the parameters
    $query->bind_param("sssssss", $ques, $ans1, $ans2, $ans3, $ans4, $c_ans,$mail);

    // Execute the query and check if successful
    if ($query->execute()) {
        header('Location: ./examinerExam.php');
        
    } else {
        echo "Execution Error: " . $query->error;
    }

    // Close the query 
    $query->close();
}

$conn->close();
?>