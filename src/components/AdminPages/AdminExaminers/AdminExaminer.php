<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $type = $_POST['types'];
    $name = $_POST['real-name'];
    $nic = $_POST['nic'];
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

    $query = "SELECT exam_id, exam_name FROM exams";
    $result = $conn->query($query);
    $exams = [];

    while ($row = $result->fetch_assoc()) {
       $exams[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($exams);

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
        <!-- Sidebar -->
        <aside class="sidebar">
            <h1>ExamCore</h1>
            <ul>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminHome/adminHome.html">Home</a></li>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminExams/adminExam.php">Exams</a></li>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminExaminers/AdminExaminer.php">Examiner</a></li>
                <li><a href="http://localhost/Group%20project/ExamCore/src/components/AdminPages/AdminNotifications/AdminNotification.html">Notifications</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="admin-examiner-container">
            <main class="admin-examiner-content">
                <table>
                    <thead>
                        <tr>
                            <th>Examiner Name</th>
                            <th>Assigned Exam</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="examinerTableBody">
                        <!-- Dynamic Content Goes Here -->
                    </tbody>
                </table>
                <br>
                
                <div>
                    <button class="assign-examiner-btn" id="assignExaminerAdmin">Assign Examiner</button>
                    <button class="add-examiner-btn" id="addExaminerAdmin">Add Examiner</button>
                </div>

                <!-- Add Examiner Modal -->
                <div class="modal" id="addExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="addClose">&times;</span>
                        <h2>Add Examiner</h2>
                        <form method="POST" action="../../AccessPages/userRegister.php">
                            <div class="input-container">
                                <label for="real-name">Name</label>
                                <input type="text" id="real-name" name="real-name" class="input-field" placeholder="Enter Your Name..." required />
                            </div>

                            <div class="input-container" id="subject-field">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="input-field" placeholder="Enter Your Subject..." required />
                            </div>

                            <div class="input-container">
                                <label for="email">Email</label>
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

                            <input type="submit" value="Register" class="register-submit-btn" onclick="checkPasswords()" />
                        </form>
                    </div>
                </div>
            </main>
        </div>

                <!-- Assign Examiner Modal -->
                    <div class="modal" id="assignExaminerModal">
                        <div class="modal-content">
                        <span class="close" id="assignClose">&times;</span>
                        <h2>Assign an Examiner</h2>
                        <form method="GET" action="./assignExaminer.php">
    <div class="input-container">
        <label for="examinerSelect">Select Examiner:</label>
        <select id="examinerSelect" name="examinerSelect" class="input-field" required>
            <?php
                include("../../php/config.php");
                $examinerQuery = "SELECT examiner_id, name FROM examiners";
                $result = $conn->query($examinerQuery);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['examiner_id']}'>{$row['name']}</option>";
                }
            ?>
        </select>
    </div>

    <div class="input-container">
        <label for="assignTo">Assign to Exam:</label>
        <select id="assignTo" name="assignTo" class="input-field" required>
            <?php
                $examQuery = $conn->query("SELECT exam_id, exam_name FROM Exams");
                while ($exam = $examQuery->fetch_assoc()) {
                    echo "<option value='{$exam['exam_id']}'>{$exam['exam_name']}</option>";
                }
            ?>
        </select>
    </div>

    <input type="submit" value="Assign" class="assign-add" />
</form>

                    </div>
                </div>

        <!-- Footer -->
        <footer class="page-footer">
            <p>Copyright ©️ 2024 ExamCore. All rights reserved. | 
                <a href="#">Terms & Conditions</a> | 
                <a href="#">Privacy Policy</a>
            </p>
        </footer>
    </div>
</div>

</body>
</html>
