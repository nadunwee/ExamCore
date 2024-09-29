<?php
include("../../php/config.php");

// Prepare an SQL query to fetch exam details
$sql = "SELECT exam_id, exam_name FROM exams";
$result = $conn->query($sql);
$exams = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $exams[] = $row;
    }
}

header('Content-Type: application/json');

echo json_encode($exams);
?>
