<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

include('../../../php/config.php');

// Fetch all notifications from the database
$query = $conn->prepare("SELECT * FROM notification");

if ($query->execute()) {
    $result = $query->get_result();
    $notifications = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
} else {
    echo "Error fetching notifications!";
}

$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Notifications</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="studentNotification.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../StudentHome/StudentHome.php">Home</a></li>
                    <li><a href="../StudentExams/studentExam.php">Exams</a></li>
                    <li><a href="../StudentSupport/studentSupport.html">Support</a></li>
                    <li><a href="#">Notifications</a></li>
                </ul>
                <a href="../StudentProfile/studentProfile.php">
                    <button class="profile-btn">Student Profile</button>
                </a>
            </aside>
        </div>

        <div class="examiner-notification-container">
            <h1 style="margin-bottom: 30px; color: #aa08a5;">Student Notifications</h1>

            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Examiner Email</th>
                    <th>Notification</th>
                    <th>Date</th>
                </tr>

                <?php if (!empty($notifications)): ?>
                    <?php foreach ($notifications as $notification): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($notification['name']); ?></td>
                            <td><?php echo htmlspecialchars($notification['email']); ?></td>
                            <td><?php echo htmlspecialchars($notification['message']); ?></td>
                            <td><?php echo htmlspecialchars($notification['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No notifications available</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <footer class="page-footer">
            <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions </a>| <a
                    href="#">Privacy Policy</a></p>
        </footer>
        <script src="ExaminerNotification.js"></script>
    </div>
</body>

</html>