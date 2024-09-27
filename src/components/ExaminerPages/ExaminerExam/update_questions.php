<?php
    session_start();

    include('../../../php/config.php');

    // Retrieve the form data
    $ques_ID = $_POST['question_ID'];  // Question ID to identify the question to update
    $ques = $_POST['question'];        // Updated question text
    $ans1 = $_POST['answer1'];         // Updated answer 1
    $ans2 = $_POST['answer2'];         // Updated answer 2
    $ans3 = $_POST['answer3'];         // Updated answer 3
    $ans4 = $_POST['answer4'];         // Updated answer 4
    $c_ans = $_POST['correct_ans'];    // Updated correct answer
    $userEmail = $_SESSION['user-email'];

    // Prepare the SQL query to update the question by question_ID
    $query = $conn->prepare("UPDATE paper SET Question = ?, answer_1 = ?, answer_2 = ?, answer_3 = ?, answer_4 = ?, correst_answer = ? WHERE question_ID = ? AND email = ?");
    
    // Bind the parameters to the SQL query
    $query->bind_param("ssssssis", $ques, $ans1, $ans2, $ans3, $ans4, $c_ans, $ques_ID, $userEmail);
    
    // Execute the query and check if the update is successful
    if ($query->execute()) {
        // Redirect back to the examiner's exam page after successful update
        header('Location: ./examinerExam.php');
        exit();
    } else {
        // Display error message if update fails
        echo "Error updating the question: " . $conn->error;
    }

    // Close the query and the database connection
    $query->close();
    $conn->close();
?>
