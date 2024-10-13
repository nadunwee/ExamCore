<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["examName"], $_POST["examinerID"], $_POST["deadline"], $_POST["password"])) {

        // Get form data
        $examName = $_POST["examName"];
        $examinerID = $_POST["examinerID"];
        $deadline = $_POST["deadline"];
        $password = $_POST["password"];
        $adminID = $_POST["admin_id"];


        $query = $conn->prepare("INSERT INTO exams (exam_name, examiner_id, exam_deadline, exam_password, admin_id) 
        VALUES (?, ?, ?, ?, ?)");

        if (!$query) {
            die("Error preparing query: " . $conn->error . "<br>");
        }

        $query->bind_param("sisss", $examName, $examinerID, $deadline, $password, $adminID);

        if ($query->execute()) {
            header("Location: adminExam.php");
            exit();
        } else {
            echo "Error inserting exam: " . $query->error . "<br>";
        }
    } else {
        echo "Form not submitting data correctly.<br>";
    }
}
?>