<?php
session_start();

if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

if (isset($_POST['exam_id'])) {
    error_log("Exam ID received: " . $_POST['exam_id']);
    
    // Connect to the database
    include('../../../php/config.php');
    
    $exam_id = $_POST['exam_id'];
    
    // Prepare and bind delete query
    $query = $conn->prepare("DELETE FROM exams WHERE exam_id = ?");
    $query->bind_param('i', $exam_id);

    if ($query->execute()) {
    
        error_log("Exam with ID " . $exam_id . " deleted successfully.");
        
        $_SESSION['success'] = "Exam deleted successfully!";
    } else {
        
        error_log("Failed to delete exam with ID " . $exam_id);

        $_SESSION['error'] = "Failed to delete exam!";
    }

    // Close query and connection
    $query->close();
    $conn->close();
} else {
    error_log("Invalid request. No exam_id received.");
    
    $_SESSION['error'] = "Invalid request!";
}

// Redirect back to the adminExam.php page
header('Location: adminExam.php');
exit();
?>