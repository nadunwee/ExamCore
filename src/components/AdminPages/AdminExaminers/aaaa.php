
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
                    <button class="assign-examiner-btn" onclick="openAssignModal()">Assign Examiner</button>
                    <button class="add-examiner-btn" onclick="openAddModal()">Add Examiner</button>
                </div>

                <!-- Assign Examiner Modal -->
                <div class="modal" id="assignExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="assignClose" onclick="closeAssignModal()">&times;</span>
                        <h2>Assign an Examiner</h2>
                        <form id="assignExaminerForm">
                            <label for="examinerSelect">Select Examiner:</label>
                            <select id="examinerSelect" name="examinerSelect">
                                <!-- Options populated via JavaScript -->
                            </select><br><br>

                            <label for="assignTo">Assign to:</label>
                            <select id="assignTo" name="assignTo">
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
                        <span class="close" id="editClose" onclick="closeEditModal()">&times;</span>
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
                            <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                        </form>
                    </div>
                </div>

                <!-- Add Examiner Modal -->
                <div class="modal" id="addExaminerModal">
                    <div class="modal-content">
                        <span class="close" id="addClose" onclick="closeAddModal()">&times;</span>
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
