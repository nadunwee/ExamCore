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

    <main class="content">
        <h1>Welcome</h1>
        <section class="most-recent-exams">
            <h2>Most Recent Exams</h2>
            <?php
            include('../../../php/config.php');
            // Fetch most recent exams
            $examQuery = "SELECT * FROM exams ORDER BY exam_deadline DESC LIMIT 5";
            $examResult = $conn->query($examQuery);

            if (!$examResult) {
                die("Error fetching exams: " . $conn->error); // Debugging error if the query fails
            }

            if ($examResult->num_rows > 0) {
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

        <section class="notifications">
            <h2>Notifications</h2>
            <?php
            // Fetch most recent notifications
            $notifQuery = "SELECT name, message, date FROM notification ORDER BY date DESC LIMIT 5";
            $notifResult = $conn->query($notifQuery);

            if (!$notifResult) {
                die("Error fetching notifications: " . $conn->error); // Debugging error if the query fails
            }

            if ($notifResult->num_rows > 0) {
                while ($row = $notifResult->fetch_assoc()) {
                    echo "<p><strong>From:</strong> " . $row["name"] . "<br>";
                    echo "<strong>Message:</strong> " . $row["message"] . "<br>";
                    echo "<strong>Date:</strong> " . $row["date"] . "</p><hr>";
                }
            } else {
                echo "<p>No notifications available.</p>";
            }

            // Close the connection after both queries are complete
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