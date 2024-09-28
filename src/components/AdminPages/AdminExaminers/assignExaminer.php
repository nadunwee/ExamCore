<?php
session_start();

// Include your database configuration
include("../../php/config.php");

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from the form
    $examinerId = $_POST['examinerSelect']; // This should hold the examiner's ID
    $examName = $_POST['assignTo']; // This should hold the selected exam name

    // Validate that both fields are not empty
    if (empty($examinerId) || empty($examName)) {
        $_SESSION['error'] = 'Both examiner and exam must be selected.';
        header('Location: AdminExaminer.php');
        exit();
    }

    // Fetch the exam_id from the Exams table using the exam name
    $examQuery = $conn->prepare("SELECT exam_id FROM Exams WHERE exam_name = ?");
    $examQuery->bind_param('s', $examName);
    $examQuery->execute();
    $examQueryResult = $examQuery->get_result();

    if ($examQueryResult->num_rows > 0) {
        // Fetch the exam_id
        $examRow = $examQueryResult->fetch_assoc();
        $examId = $examRow['exam_id'];

        // Update the exam entry to assign the examiner
        $updateExamQuery = $conn->prepare("UPDATE Exams SET examiner_id = ? WHERE exam_id = ?");
        $updateExamQuery->bind_param('ii', $examinerId, $examId);

        // Execute the query and check for success
        if ($updateExamQuery->execute()) {
            $_SESSION['success'] = "Examiner successfully assigned to the exam!";
        } else {
            // Log the error for debugging purposes
            error_log("Error assigning examiner: " . $updateExamQuery->error);
            $_SESSION['error'] = "Failed to assign examiner. Please try again.";
        }
        
        // Redirect back to the page
        header('Location: AdminExaminer.php');
        exit();
    } else {
        // No exam found with the selected name
        $_SESSION['error'] = "Invalid exam selection. Please try again.";
        header('Location: AdminExaminer.php');
        exit();
    }
} else {
    // If the form wasn't submitted via POST, redirect back
    header('Location: AdminExaminer.php');
    exit();
}
?>
