<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

// Retrieve the session variables
$userEmail = $_SESSION['user-email'];
$userPassword = $_SESSION['user-pswd'];

include('../../../php/config.php');

$query = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
$query->bind_param('ss', $userEmail, $userPassword);

if ($query->execute()) {
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $studentData = $result->fetch_assoc();
    } else {
        echo "Invalid login credentials!";
    }
}

$query->close();

$examQuery = $conn->prepare("SELECT * FROM Exams");

if ($examQuery->execute()) {
    $availableExamsResult = $examQuery->get_result();
} else {
    echo "Failed to retrieve exams.";
}

$examQuery->close();

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExamCore</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="studentExamWithOTP.css">
    <link rel="stylesheet" href="./studentExam.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../StudentHome/StudentHome.php">Home</a></li>
                    <li><a href="#">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="../StudentNotification/StudentNotification.php">Notifications</a></li>
                </ul>
                <button class="profile-btn">
                    <a href="../StudentProfile/studentProfile.php">Student Profile</a>
                </button>
            </aside>
        </div>
    </div>
    <main class="content">
        <div class="header">


            <div style="margin-left: 120px;" class="search-bar">
                <input type="text" placeholder="Search Exam">
                <button>Search</button>
            </div>
        </div>


        <div class="student-exams-list">
            <div class="student-exmas-available">
                <h1>Available Exams</h1>
                <div class="student-exams-content">
                    <div class="student-exams-content">
                        <?php
                        if ($availableExamsResult->num_rows > 0) {
                            echo '<div class="exam-row">';
                            echo '<div class="exam-header">Exam ID</div>';
                            echo '<div class="exam-header">Exam Name</div>';
                            echo '<div class="exam-header">Exam Deadline</div>';
                            echo '</div>';
                            while ($row = $availableExamsResult->fetch_assoc()) {
                                // Start the form and set the action to studentExamPassword.php
                                echo '<form class="exam-form" action="./studentExamPassword.php" method="POST" style="display: inline;">';

                                // Add hidden inputs for exam_id and exam_password
                                echo '<input type="hidden" name="exam_id" value="' . htmlspecialchars($row['exam_id']) . '">';
                                echo '<input type="hidden" name="exam_password" value="' . htmlspecialchars($row['exam_password']) . '">';

                                // Create the clickable exam row
                                echo '<div class="exam-row" onclick="this.closest(\'form\').submit();">';
                                echo '<div class="exam-data">' . htmlspecialchars($row['exam_id']) . '</div>';
                                echo '<div class="exam-data" style="color: #761c73;cursor: pointer">' . htmlspecialchars($row['exam_name']) . '</div>';
                                echo '<div class="exam-data">' . htmlspecialchars($row['exam_deadline']) . '</div>';
                                echo '</div>';

                                // Close the form
                                echo '</form>';
                            }
                        } else {
                            echo '<li>No available exams at the moment.</li>';
                        }
                        ?>
                    </div>

                </div>
            </div>
            <!-- <div class="student-exams-completed">
                <h1>Completed Exams</h1>
                <div>Exam name</div>
                <div>Due date</div>
            </div> -->
        </div>




    </main>

    <!-- OTP Popup -->
    <div id="otp-overlay"></div>
    <div id="otp-popup">
        <h3 id="popup-title">Enter OTP </h3>
        <input type="text" id="otp-input" placeholder="OTP">
        <label><input type="checkbox" id="terms-checkbox"> I accept the terms and conditions</label>
        <button id="submit-button">Submit</button>
        <div id="error-message"></div>
    </div>

    <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
    </footer>

    <script src="http://localhost/Group%20project/ExamCore/src/components/StudentPages/studentExamPageWithOTP.js"></script>
</body>

</html>