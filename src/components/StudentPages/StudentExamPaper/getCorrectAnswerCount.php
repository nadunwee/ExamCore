<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

include('../../../php/config.php');

// Calculate the count of correct answers
$countCorrectAnswersQuery = $conn->prepare("SELECT COUNT(*) FROM answertable WHERE correct_answer = submitted_answer");
if ($countCorrectAnswersQuery->execute()) {
    $result = $countCorrectAnswersQuery->get_result();
    $correctCount = $result->fetch_row()[0]; // Fetch the count of correct answers
    echo $correctCount; // Return the count
} else {
    echo "Error counting correct answers: " . $countCorrectAnswersQuery->error; // Return error
}

$conn->close();
?>