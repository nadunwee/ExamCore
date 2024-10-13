<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["examName"], $_POST["examinerID"], $_POST["deadline"], $_POST["password"], $_POST["exam_id"])) {

        // Get form data
        $examName = $_POST["examName"];
        $examinerID = $_POST["examinerID"];
        $deadline = $_POST["deadline"];
        $password = $_POST["password"];
        $examID = $_POST["exam_id"];

        $query = $conn->prepare("UPDATE exams SET exam_name = ?, examiner_id = ?, exam_deadline = ?, exam_password = ? WHERE exam_id = ?");
        $query->bind_param("sissi", $examName, $examinerID, $deadline, $password, $examID);

        if ($query->execute()) {
            
            header("Location: adminExam.php");
            exit();
        } else {
            echo "Error updating exam: " . $query->error . "<br>";
        }
    } else {
        echo "Form not submitting data correctly.<br>";
    }
}
?>