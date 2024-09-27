<?php
session_start();

// Redirect if session email is not set
if (!isset($_SESSION['user-email'])) {
    header("Location: ../../AccessPages/login.php");
    exit;
}

// Include the database configuration
include('../../../php/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./studentHome.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <title>ExamCore</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="./studentHome.php">Home</a></li>
                    <li><a href="../studentExam.html">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="../StudentNotification.html">Notifications</a></li>
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

    <main class="content">
        <!-- Most Recent Exams Section -->
        <section class="most-recent-exams">
            <h2>Most Recent Exams</h2>
            <?php
            // Fetch most recent exams
            $examQuery = "SELECT exam_name, assigned_examiner, exam_deadline FROM Exams ORDER BY exam_deadline DESC LIMIT 5";
            $examResult = $conn->query($examQuery);

            if ($examResult->num_rows > 0) {
                // Output data of each row
                while ($row = $examResult->fetch_assoc()) {
                    echo "<p><strong>Exam Name:</strong> " . $row["exam_name"] . "<br>";
                    echo "<strong>Assigned Examiner:</strong> " . $row["assigned_examiner"] . "<br>";
                    echo "<strong>Deadline:</strong> " . $row["exam_deadline"] . "</p><hr>";
                }
            } else {
                echo "<p>No recent exams available.</p>";
            }
            ?>
        </section>

        <!-- Notifications Section -->
        <section class="notifications">
            <h2>Notifications</h2>
            <?php
            // Fetch most recent notifications
            $notifQuery = "SELECT name, message, date FROM notification ORDER BY date DESC LIMIT 5";
            $notifResult = $conn->query($notifQuery);

            if ($notifResult->num_rows > 0) {
                // Output data of each row
                while ($row = $notifResult->fetch_assoc()) {
                    echo "<p><strong>From:</strong> " . $row["name"] . "<br>";
                    echo "<strong>Message:</strong> " . $row["message"] . "<br>";
                    echo "<strong>Date:</strong> " . $row["date"] . "</p><hr>";
                }
            } else {
                echo "<p>No notifications available.</p>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </main>

    <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. |
            <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a>
        </p>
    </footer>
</body>

</html>
