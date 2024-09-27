<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['real-name'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $email = $_POST['email'] ?? '';
    $passwd = $_POST['password'] ?? '';
    $confirmPasswd = $_POST['confirm-password'] ?? '';

    // Validate passwords match
    if ($passwd !== $confirmPasswd) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: userRegister.php');
        exit();
    }

    include("../../php/config.php");

    // Hash the password
    $hashedPassword = password_hash($passwd, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $query = $conn->prepare("INSERT INTO examiners (name, subject, email, password) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $name, $subject, $email, $hashedPassword);

    // Execute the statement and check for errors
    if ($query->execute()) {
        header('Location: login.php');
    } else {
        // Log the error for debugging (consider a logging mechanism)
        error_log("Database error: " . $query->error);
        $_SESSION['error'] = "Failed to register. Please try again.";
        header('Location: userRegister.php');
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
    <link rel="stylesheet" href="adminExaminer.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
    <style>
        /* Basic styling for modals */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="container">
        <aside class="sidebar">
            <h1>ExamCore</h1>
            <ul>
                <li><a href="../AdminHome/adminHome.html">Home</a></li>
                <li><a href="../AdminExams/adminExam.html">Exams</a></li>
                <li><a href="../AdminExaminers/AdminExaminer.html">Examiner</a></li>
                <li><a href="../AdminNotifications/AdminNotification.html">Notifications</a></li>
            </ul>
        </aside>

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
                </table><br>
                
                <div>
                    <button class="assign-examiner-btn">Assign Examiner</button>
                    <button class="add-examiner-btn">Add Examiner</button>
                </div>

                <!-- Assign Examiner Modal -->
                <div class="modal" id="assignExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="assignClose">&times;</span>
                        <h2>Assign an Examiner</h2>
                        <form id="assignExaminerForm">
                            <label for="examinerSelect">Select Examiner:</label>
                            <select id="examinerSelect" name="examinerSelect">
                                <!-- Options populated via JavaScript -->
                            </select><br><br>

                            <label for="assignTo">Assign to:</label>
                            <select id="assignTo" name="assignTo">
                                <!-- Options populated via PHP -->
                                <?php
                                include("../../php/config.php");
                                $examQuery = $conn->query("SELECT exam_name FROM Exams");
                                while ($exam = $examQuery->fetch_assoc()) {
                                    echo "<option value='{$exam['exam_name']}'>{$exam['exam_name']}</option>";
                                }
                                ?>
                            </select><br><br>
                            <button type="button" class="assign-btn">Add</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Examiner Modal -->
                <div class="modal" id="editExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="editClose">&times;</span>
                        <h2>Edit Examiner</h2>
                        <form>
                            <label for="editExaminerName">Examiner Name:</label>
                            <input type="text" id="editExaminerName" name="examinerName"><br><br>

                            <label for="editAssignTo">Assign to:</label>
                            <select id="editAssignTo" name="assignTo">
                                <?php
                                include("../../php/config.php");
                                $examQuery = $conn->query("SELECT exam_name FROM Exams");
                                while ($exam = $examQuery->fetch_assoc()) {
                                    echo "<option value='{$exam['exam_name']}'>{$exam['exam_name']}</option>";
                                }
                                ?>
                            </select><br><br>

                            <button type="button" class="save-btn">Save</button>
                            <button type="button" class="cancel-btn">Cancel</button>
                        </form>
                    </div>
                </div>

                <br>

                <!-- Add Examiner Modal -->
                <div class="modal" id="addExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="addClose">&times;</span>
                        <h2>Add Examiner</h2>
                        <form method="POST" action="userRegister.php">
                            <div class="input-container">
                                <label for="real-name">Name</label>
                                <input type="text" id="real-name" name="real-name" class="input-field" placeholder="Enter Your Name..." required />
                            </div>

                            <div class="input-container" id="subject-field">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="input-field" placeholder="Enter Your Subject..." />
                            </div>

                            <div class="input-container">
                                <label for="email">Email <div class="email-reminder" id="email-reminder">Enter Your Institute email</div></label>
                                <input type="text" id="email" name="email" class="input-field" placeholder="Enter Your Email..." required />
                            </div>

                            <div class="input-container">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="input-field" placeholder="Enter Your Password..." required />
                            </div>

                            <div class="input-container">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm Password" required />
                            </div>

                            <input type="submit" value="Sign up with Email" class="register-submit-btn" />
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

<script src="adminExaminer.js"></script>
</body>
</html>
