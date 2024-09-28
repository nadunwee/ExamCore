<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['real-name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $confirmPasswd = $_POST['confirm-password'];

    // Validate passwords match
    if ($passwd !== $confirmPasswd) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: userRegister.php');
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('Location: userRegister.php');
        exit();
    }

    // Correct file path to include the database configuration
    include("../../php/config.php");

    // Prepare the SQL statement
    $query = $conn->prepare("INSERT INTO examiners (name, subject, email, password) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $name, $subject, $email, $passwd);

    // Execute the statement and check for errors
    if ($query->execute()) {
        $_SESSION['success'] = 'Examiner registration successful!';
        header('Location: login.php');
        exit();
    } else {
        // Log the error for debugging
        error_log("Database error: " . $query->error);
        $_SESSION['error'] = "Failed to register. Please try again.";
        header('Location: userRegister.php');
        exit();
    }

    // Close statement and connection
    $query->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExamCore</title>
    <script src="./adminExaminer.js" defer></script>
    <link rel="stylesheet" href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminExaminers/adminExaminer.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
</head>
<body>

<div class="wrapper">
    <div class="container">
        <aside class="sidebar">
            <h1>ExamCore</h1>
            <ul>
                <li><a href="../AdminHome/adminHome.html">Home</a></li>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminExams/adminExam.php">Exams</a></li>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminExaminers/AdminExaminer.php">Examiner</a></li>
                <li><a href="../AdminNotifications/AdminNotification.html">Notifications</a></li>
            </ul>
        </aside>

        <div class="admin-examiner-container">
            <main class="admin-examiner-content">
    
                <div>
                <button class="add-examiner-btn" id="addExaminerAdmin">Add Examiner</button>

                </div>

                

                

                <!-- Add Examiner Modal -->
                <div class="modal" id="addExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="addClose" >&times;</span>
                        <h2>Add Examiner</h2>
                        <form method="POST" action="userRegister.php">
                            <div class="input-container">
                                <label for="real-name">Name</label>
                                <input type="text" id="real-name" name="real-name" class="input-field" placeholder="Enter Your Name..." required />
                            </div>

                            <div class="input-container" id="subject-field">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="input-field" placeholder="Enter Your Subject..." required />
                            </div>

                            <div class="input-container">
                                <label for="email">Email <div class="email-reminder" id="email-reminder">Enter Your Institute email</div></label>
                                <input type="email" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
                            </div>

                            <div class="input-container">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
                            </div>

                            <div class="input-container">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm Password" required />
                            </div>

                            <input type="submit" value="Register" class="register-submit-btn" />
                        </form>
                    </div>
                </div>
            </main>
        </div>

        <footer class="page-footer">
            <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
        </footer>
    </div>
</div>


</body>
</html>