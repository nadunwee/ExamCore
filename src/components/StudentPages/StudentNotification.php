<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header("Location: ../login.html"); // Redirect to login page if not logged in
    exit();
}

// Include database configuration
include("../../php/config.php");

// Prepare the SQL query to fetch notifications for the logged-in student
$email = $_SESSION['user-email'];
$query = $conn->prepare("SELECT * FROM notification WHERE email = ? ORDER BY date DESC");
$query->bind_param("s", $email);

// Execute the query
if ($query->execute()) {
    $result = $query->get_result();

    // Check if there are any notifications
    if ($result->num_rows > 0) {
        $notifications = $result->fetch_all(MYSQLI_ASSOC); // Fetch all notifications
    } else {
        $notifications = []; // No notifications found
    }
} else {
    echo "Error: " . $query->error; // Show database error
}

// Close the query and connection
$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Notifications</title>
    <link rel="stylesheet" href="../../styles/commonNavbarAndFooterStyles.css">
    <link rel="stylesheet" href="http://localhost/Group%20project/ExamCore/src/components/StudentPages/StudentHome/studentHome.css">
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <h1>ExamCore</h1>
            <ul>
                <li><a href="./StudentHome/StudentHome.php">Home</a></li>
                <li><a href="./studentExam.php">Exams</a></li>
                <li><a href="./StudentSupport/studentSupport.html">Support</a></li>
                <li><a href="#">Notifications</a></li>
            </ul>
            <button class="profile-btn">
                <a href="./StudentProfile/studentProfile.php">Student Profile</a>
            </button>
        </aside>

        <main class="content">
            <h2>Notifications</h2>
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="notification">
                        <p><strong><?php echo htmlspecialchars($notification['name']); ?>:</strong> <?php echo htmlspecialchars($notification['message']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($notification['date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p><br><br><br><br>No notifications available.</p>
            <?php endif; ?>
        </main>
    </div>

    <footer class="page-footer">
        <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>