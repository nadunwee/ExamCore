<?php
session_start();


//  user is logged in, redirect to login page if not
if (!isset($_SESSION['user-email'])) {
    header('Location: ../components/ExaminerPages/ExaminerExam/examinerExam.php');
    exit();
}

//  establish the  database connection
include('../../../php/config.php');

// Check if the request method is POST and 'question_ID' is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_ID'])) {
    
    // Retrieve the question ID from the POST request
    $question_ID = $_POST['question_ID'];

    // SQL statement to delete the question
    $query = $conn->prepare("DELETE FROM paper WHERE question_ID = ? AND email = ? ");
    $query->bind_param('is', $question_ID, $_SESSION['user-email']);  // 'i' indicates an integer type

    // Execute the query 
    if ($query->execute()) {
        header('Location: ./examinerExam.php');
    } else {
        echo "Error deleting question: " . $conn->error;
    }

    $query->close();
    $conn->close();

} else {
    echo "No question ID provided for deletion.";
    
}
?>

