<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'exam_core');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
}


if (!isset($_SESSION['user-email'])) {
    header('Location: ../../AccessPages/login.php');
    exit();
}

$adminID = $_SESSION['user-email'];


$query = $conn->prepare("SELECT * FROM exams WHERE admin_id = ?");
$query->bind_param('s', $adminID);

if ($query->execute()) {
    $result = $query->get_result();
}

$query->close();
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
    <link rel="stylesheet" type="text/css" href="admin_exam_styles.css">
    <link rel="stylesheet" type="text/css" href="admin_add_exam_popup_styles.css">
    <link rel="stylesheet" type="text/css" href="admin_edit_exam_popup_styles.css">
    <link rel="stylesheet" type="text/css" href="../homeExamCommonStyles.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/commonNavbarAndFooterStyles.css">
    <script src="../adminHome_adminExam.js"></script>
    <title>ExamCore</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <aside class="sidebar">
                <h1>ExamCore</h1>
                <ul>
                    <li><a href="../AdminHome/adminHome.html">Home</a></li>
                    <li><a href="http://localhost/../ExamCore/src/components/AdminPages/AdminExams/adminExam.php">Exams</a></li>
                    <li><a href="../AdminExaminers/AdminExaminer.html">Examiner</a></li>
                    <li><a href="../AdminNotifications/AdminNotification.html">Notifications</a></li>
                </ul>
            </aside>

            <div class="admin-page-container">
                <div class="admin-exam-content">
                    <button id="admin-add-an-exam-Btn" type="button">Add an exam</button>

                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="admin-exam-information" data-exam-id="<?php echo $row['exam_id']; ?>">
                                <div class="admin-add-exam-name">
                                    <p>Exam Name:</p>
                                    <span><?php echo htmlspecialchars($row['exam_name']); ?></span>
                                </div>
                                <div class="admin-assigned-examiner">
                                    <p>Assigned Examiner ID:</p>
                                    <span><?php echo htmlspecialchars($row['examiner_id']); ?></span>
                                </div>
                                <div class="admin-exam-deadline">
                                    <p>Exam Deadline:</p>
                                    <span><?php echo htmlspecialchars($row['exam_deadline']); ?></span>
                                </div>
                                <div class="admin-exam-password">
                                    <p>Exam Password:</p>
                                    <span><?php echo htmlspecialchars($row['exam_password']); ?></span>
                                </div>
                                <span class="admin-exam-emojies">
                                    <div class="admin-exam-edit" onclick="openEditPopup(<?php echo $row['exam_id']; ?>)">
                                        <img src="../../../Images/editIcon.png" alt="edit">
                                    </div>
                                    <div class="admin-exam-delete">
                                        <form method="POST" action="adminDeleteExams.php" onsubmit="return confirm('Are you sure you want to delete this exam?');">
                                            <input type="hidden" name="exam_id" value="<?php echo $row['exam_id']; ?>">
                                            <button type="submit">
                                                <img src="../../../Images/deleteIcon.png" alt="delete">
                                            </button>
                                        </form>
                                    </div>
                                </span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="noExamsFound">No exams found.</p>
                    <?php endif; ?>

                    <!-- Add Exam Popup -->
                    <div class="admin-exam-popup-background">
                        <div class="admin-add-exam-popup" id="admin-add-exam-popup">
                            <div class="admin-add-exam-popup-header">
                                <p>Add an exam</p>
                            </div>
                            <div class="admin-add-exam-popup-body">
                                <form method="POST" action="./adminCreateExams.php">
                                    <label for="Exam Name">Exam Name:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-name" name="examName" required><br>

                                    <label for="Assign To">Assigned Examiner ID:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-examiner-name" name="examinerID" required><br>

                                    <label for="Exam Deadline">Exam Deadline:</label><br>
                                    <input type="date" class="popup-inputs-box" id="popup-exam-deadline" name="deadline" required><br>

                                    <label for="Exam Password">Exam Password:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-password" name="password" required><br>

                                    <input type="text" hidden name="admin_id" value="<?php echo $_SESSION['user-email'] ?>"><br>

                                    <div class="admin-add-exam-popup-button">
                                        <button class="admin-add-exam-button" type="submit">Add</button>
                                        <button class="admin-add-exam-cancel-button" type="button">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Exam Popup -->
                    <div class="admin-edit-exam-popup-background">
                        <div class="admin-edit-exam-popup" id="admin-edit-exam-popup">
                            <div class="admin-edit-exam-popup-header">
                                <p>Edit this exam</p>
                            </div>
                            <div class="admin-edit-exam-popup-body">
                                <form method="POST" action="./adminEditExams.php">
                                    <label for="Exam Name">New Exam Name:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-name" name="examName" required><br>

                                    <label for="Assign To">New Examiner ID:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-examiner-id" name="examinerID" required><br>

                                    <label for="Exam Deadline">New Exam Deadline:</label><br>
                                    <input type="date" class="popup-inputs-box" id="popup-exam-deadline" name="deadline" required><br>

                                    <label for="Exam Password">New Exam Password:</label><br>
                                    <input type="text" class="popup-inputs-box" id="popup-exam-password" name="password" required><br>

                                    <div class="admin-edit-exam-popup-button">
                                        <button class="admin-edit-exam-button" type="submit">Edit</button>
                                        <button class="admin-edit-exam-cancel-button" type="button">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="page-footer">
                    <p>Copyright ©️ 2024 ExamCore. All rights reserved. | <a href="#">Terms & Conditions | <a
                                href="#">PrivacyPolicy</a></p>
                </footer>
            </div>
        </div>
    </div>