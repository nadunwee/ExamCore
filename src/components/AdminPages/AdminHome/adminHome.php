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

// Prepare and execute the query to get student data
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

// Query to get available exams
$examQuery = $conn->prepare("SELECT * FROM Exams");

if ($examQuery->execute()) {
    $availableExamsResult = $examQuery->get_result();
} else {
    echo "Failed to retrieve exams.";
}

$examQuery->close();

// Query to count the number of exams
$examCountQuery = $conn->prepare("SELECT COUNT(exam_id) FROM Exams");

if ($examCountQuery->execute()) {
    $examCountQuery->bind_result($examsCount);
    $examCountQuery->fetch();
} else {
    echo "Failed to retrieve exam count.";
}

$examCountQuery->close();

$conn->close();

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
    <link rel="stylesheet" type="text/css" href="admin_home_styles.css">
    <link rel="stylesheet" type="text/css" href="../homeExamCommonStyles.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/commonNavbarAndFooterStyles.css">
    <script src="../adminHome_adminExam.js"></script>
    <title>ExamCore</title>
</head>

<body>

    <div class="wrapper">
        <div class="Container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="adminHome.html">Home</a></li>
                    <li><a href="../AdminExams/adminExam.php">Exams</a></li>
                    <li><a href="../AdminExaminers/AdminExaminer.php">Examiner</a></li>
                    <li><a href="../AdminNotifications/AdminNotifications.php">Notifications</a></li>
                </ul>
                
            </aside>

            <div class="admin-page-container">
                <div class="admin-home-content">
                    <div class="admin-home-header">
                        <h1>Overview</h1>
                    </div>
                    <div class="admin-home-components">
                        <div class="admin-home-component">
                            <p id="admin-home-p">Total Students</p>
                            <span>00</span>
                        </div>
                        <div class="admin-home-component">
                            <p id="admin-home-p">Total Examiners</p>
                            <span>00</span>
                        </div>
                        <div class="admin-home-component">
                            <p id="admin-home-p">Number of exams</p>
                            <span>00</span>
                        </div>
                    </div>

                </div>
                <footer style="margin-top: 9%;" class="page-footer">
                    <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions </a>| <a
                            href="#">Privacy Policy</a></p>
                </footer>
            </div>
        </div>
    </div>

</body>

</html>