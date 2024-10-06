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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="studentHome.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <title>ExamCore</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="../StudentExams/studentExam.php">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="../StudentNotification/StudentNotification.php">Notifications</a></li>
                </ul>
                <a href="../StudentProfile/studentProfile.php"><button class="profile-btn">Student Profile</button></a>
            </aside>
        </div>
    </div>

    <header>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search">
            <button>Search</button>
        </div>
    </header>

    <main style="margin-left: 0px;" class="content">
        <h1 style="color:#aa08a5; margin-top: 0px;">Welcome Back, <?php echo htmlspecialchars($studentData['name']); ?></h1><br>
        <div class="student-exams-content">
            <?php
            if ($availableExamsResult->num_rows > 0) {
                echo '<br><br><h2 style="font-size:40px; color: #e7006c; margin-left: 0px; margin-top: 10px;">You have <span style="color: #ff4500; font-weight: bold;">' . htmlspecialchars($examsCount) . '</span> exams! Go to the Exams page.</h2>';
            } else {
                echo '<h2 style="color: #761c73; margin-left: 0px; margin-top: 100px;">No available exams at the moment.</h2>';
            }
            ?>
        </div>

    </main>
    <div class="footer-img">
        <img style="width: 100%; height: 400px; margin-bottom:0%" src="../../../Images/studentHome_footer_img.jpg" alt="footerImg">
    </div>

    <footer style="margin-top: 0%;" class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. |
            <a href="http://localhost/Group%20project/ExamCore/terms&conditions.html">Terms & Conditions</a> | <a href="http://localhost/Group%20project/ExamCore/privacyPolicy.html">Privacy Policy</a>
        </p>
    </footer>
</body>

</html>