<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

include('../../../php/config.php');

// Initialize variables
$examiner = null;

// Retrieve examiner ID from URL
if (isset($_GET['id'])) {
    $examiner_id = $_GET['id'];

    // Fetch examiner data from database
    $query = $conn->prepare("SELECT * FROM examiners WHERE examiner_id = ?");
    $query->bind_param('i', $examiner_id);

    if ($query->execute()) {
        $result = $query->get_result();
        $examiner = $result->fetch_assoc();
    }

    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Examiner</title>
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <link rel="stylesheet" href="./adminExaminer.css">
</head>

<body>

    <div class="wrapper">
        <div class="container">

            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../AdminHome/adminHome.php">Home</a></li>
                    <li><a href="../AdminExams/adminExam.php">Exams</a></li>
                    <li><a href="#">Examiner</a></li>
                    <li><a href="../AdminNotifications/AdminNotifications.php">Notifications</a></li>
                </ul>
            </aside>

            <div class="admin-examiner-container">
                <main class="admin-examiner-content">
                    <h2>Edit Examiner</h2>

                    <?php if ($examiner): ?>
                        <form method="POST" action="../../../php/updateExaminer.php">
                            <input type="hidden" name="examiner_id" value="<?php echo htmlspecialchars($examiner['examiner_id']); ?>">

                            <div class="input-container">
                                <label for="real-name">Name</label>
                                <input type="text" id="real-name" name="real-name" class="input-field" value="<?php echo htmlspecialchars($examiner['name']); ?>" required />
                            </div>

                            <div class="input-container">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="input-field" value="<?php echo htmlspecialchars($examiner['subject']); ?>" required />
                            </div>

                            <div class="input-container">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="input-field" value="<?php echo htmlspecialchars($examiner['email']); ?>" required />
                            </div>

                            <input type="submit" value="Update Examiner" class="update-btn" />
                        </form>
                    <?php else: ?>
                        <p>Examiner not found.</p>
                    <?php endif; ?>

                </main>
            </div>

            <footer class="page-footer">
                <p>Copyright ©️ 2024 ExamCore. All rights reserved. |
                    <a href="../../../../terms&conditions.html">Terms & Conditions</a> |
                    <a href="../../../../privacyPolicy.html">Privacy Policy</a>
                </p>
            </footer>
        </div>
    </div>

</body>
</html>
