<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["examName"], $_POST["examinerID"], $_POST["deadline"], $_POST["password"])) {

        // Get form data
        $examName = $_POST["examName"];
        $examinerID = $_POST["examinerID"];
        $deadline = $_POST["deadline"];
        $password = $_POST["password"];


        $query = $conn->prepare("INSERT INTO exams (exam_name, examiner_id, exam_deadline, exam_password) VALUES (?, ?, ?, ?)");

        // Debugging: Check if the query preparation was successful
        if (!$query) {
            die("Error preparing query: " . $conn->error . "<br>");
        }

        $query->bind_param("siss", $examName, $examinerID, $deadline, $password);

        if ($query->execute()) {
            // After successful insertion, redirect to the same page to prevent resubmission
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_exam_styles.css">
    <link rel="stylesheet" type="text/css" href="admin_add_exam_popup_styles.css">
    <link rel="stylesheet" type="text/css" href="admin_edit_exam_popup_styles.css">
    <link rel="stylesheet" type="text/css" href="../homeExamCommonStyles.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/commonNavbarAndFooterStyles.css">
    <script src="../adminHome_adminExam.js"></script>
    <title>ExamCore</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../AdminHome/adminHome.html">Home</a></li>
                    <li><a href="http://localhost/IWT_FINAL_PROJECT_CLONE/ExamCore/src/components/AdminPages/AdminExams/adminExam.php">Exams</a></li>
                    <li><a href="../AdminExaminers/AdminExaminer.html">Examiner</a></li>
                    <li><a href="../AdminNotifications/AdminNotification.html">Notifications</a></li>
                </ul>

            </aside>

            <div class="admin-page-container">

                <div class="admin-exam-content">
                    <button id="admin-add-an-exam-Btn" type="button">Add an exam</button>

                    <div class="admin-exam-popup-background">
                        <div class="admin-add-exam-popup" id="admin-add-exam-popup">
                            <div class="admin-add-exam-popup-header">
                                <p>Add an exam</p>
                            </div>
                            <div class="admin-add-exam-popup-body">
                                <form method="POST" action="adminExam.php">
                                    <label for="Exam Name">Exam Name:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-name" name="examName" required><br>

                                    <label for="Assign To">Assigned Examiner ID:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-examiner-name" name="examinerID" required><br>

                                    <label for="Exam Deadline">Exam Deadline:</label><br>
                                    <input type="date" class="popup-inputs-box" id="popup-exam-deadline" name="deadline" required><br>

                                    <label for="Exam Password">Exam Password:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-password" name="password" required><br>

                                    <div class="admin-add-exam-popup-button">
                                        <button class="admin-add-exam-button" type="submit">Add</button>

                                        <button class="admin-add-exam-cancel-button" type="button">Cancel</button>
                                    </div>
                                </form>



                            </div>
                        </div>


                    </div>

                    

                    <div class="admin-edit-exam-popup-background">
                        <div class="admin-edit-exam-popup" id="admin-edit-exam-popup">
                            <div class="admin-edit-exam-popup-header">
                                <p>Edit this exam</p>
                            </div>
                            <div class="admin-edit-exam-popup-body">
                                <form method="POST" action="adminExam.php">
                                    <label for="Exam Name">Exam Name:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-name" name="examName" required><br>

                                    <label for="Assign To">Assigned Examiner ID:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-examiner-id" name="examinerID" required><br>

                                    <label for="Exam Deadline">Exam Deadline:</label><br>
                                    <input type="date" class="popup-inputs-box" id="popup-exam-deadline" name="deadline" required><br>

                                    <label for="Exam Password">Exam Password:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-password" name="password" required><br>

                                    <div class="admin-add-exam-popup-button">
                                        <button class="admin-add-exam-button" type="submit">Add</button>
                                        <button class="admin-add-exam-cancel-button" type="button">Cancel</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <footer class="page-footer">
                    <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions | <a
                                href="#">PrivacyPolicy</a></p>
                </footer>
            </div>


        </div>
        
    </div>

</body>