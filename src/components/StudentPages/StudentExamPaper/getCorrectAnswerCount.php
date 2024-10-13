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
    $correctCount = $result->fetch_row()[0]; 
    echo $correctCount; 
} else {
    echo "Error counting correct answers: " . $countCorrectAnswersQuery->error; 
}


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST['user-email']) && isset($_POST[$correctCount])) {
//         $userEmail = $_POST['user-email'];
//         $answerCount = $_POST[$correctCount];

//         // Insert the data into the answertable
//         $countSave = $conn->prepare("INSERT INTO exammarks VALUES(?, ? ,?);");
//         $countSave->bind_param("sii", $userEmail, $examID, $answerCount);
        
//         $countSave->close();
//     } else {
//         echo "answers are not counted.";
//     }
// }
$conn->close();
?>