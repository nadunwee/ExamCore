<?php
include('config.php'); // Database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exam_id'], $_POST['examiner_id'])) {
    $exam_id = $_POST['exam_id'];
    $examiner_id = $_POST['examiner_id'];

    // Prepare statement to update examiner assignment
    $stmt = $conn->prepare("UPDATE Exams SET examiner_id = ? WHERE exam_id = ?");
    $stmt->bind_param("ii", $examiner_id, $exam_id);
    foreach ($examiners as $examiner){
        echo "<option value='{$examiner['examiner_id']}'>{$examiner['examiner_id']}</option>";
    }
    

    if ($stmt->execute()) {
        echo "Examiner assigned successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

