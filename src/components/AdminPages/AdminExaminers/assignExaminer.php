<?php
include('config.php'); // Database connection

// Fetch examiners from the database
$examinerQuery = "SELECT examiner_id, name FROM Examiners";
$examinerResult = $conn->query($examinerQuery);
$examiners = [];
if ($examinerResult->num_rows > 0) {
    while ($row = $examinerResult->fetch_assoc()) {
        $examiners[] = $row;
    }
}

// Fetch exams from the database
$examQuery = "SELECT exam_id, exam_name FROM Exams";
$examResult = $conn->query($examQuery);
$exams = [];
if ($examResult->num_rows > 0) {
    while ($row = $examResult->fetch_assoc()) {
        $exams[] = $row;
    }
}

// Return both examiners and exams as a JSON object
header('Content-Type: application/json');
echo json_encode(['examiners' => $examiners, 'exams' => $exams]);
?>
