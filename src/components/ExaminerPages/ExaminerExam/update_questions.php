<?php
    session_start();

    include('../../../php/config.php');

    // Retrieve the form data
    $ques_ID = $_POST['question_ID'];  // Question ID so can  identify the question to update
    $ques = $_POST['question'];       
    $ans1 = $_POST['answer1'];         // Updated answer 1
    $ans2 = $_POST['answer2'];         
    $ans3 = $_POST['answer3'];         
    $ans4 = $_POST['answer4'];         
    $c_ans = $_POST['correct_ans'];    
    $userEmail = $_SESSION['user-email'];

    // SQL query to update the question 
    $query = $conn->prepare("UPDATE paper SET Question = ?, answer_1 = ?, answer_2 = ?, answer_3 = ?, answer_4 = ?, correct_answer = ? WHERE question_ID = ? AND email = ?");
    
    // Bind the parameters to the SQL query
    $query->bind_param("ssssssis", $ques, $ans1, $ans2, $ans3, $ans4, $c_ans, $ques_ID, $userEmail);
    
    // Execute the query 
    if ($query->execute()) {
        
        header('Location: ./examinerExam.php');
        exit();
    } else {
       
        echo "Error updating the question: " . $conn->error;
    }

    // Close the query and the database connection
    $query->close();
    $conn->close();
?>
