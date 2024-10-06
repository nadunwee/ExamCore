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

// Fetch examiner data based on login credentials
$query = $conn->prepare("SELECT * FROM examiners");

if ($query->execute()) {
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Instead of fetching a single row, store all rows
        $examiners = [];
        while ($row = $result->fetch_assoc()) {
            $examiners[] = $row;
        }
    } else {
        // echo "Invalid login credentials!";
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
    <title>ExamCore</title>
    <script src="./adminExaminers.js" defer></script>
    <link rel="stylesheet" href="./adminExaminer.css">
    <link rel="stylesheet" href="../../../styles/commonNavbarAndFooterStyles.css">
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
                    <table>
                        <thead>
                            <tr>
                                <th>Examiner Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php
                            if (!empty($examiners)) {
                                foreach ($examiners as $examiner) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($examiner['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($examiner['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($examiner['subject']) . "</td>";
                                    echo "<td>";
                                    // Form for deletion
                                    echo "<form method='POST' action='../../../php/deleteAccount.php'>";
                                    echo "<input type='hidden' name='type' value='examiner'>";
                                    echo "<input hidden type='text' name='is-admin' value='admin' />";
                                    echo "<input type='hidden' name='email' value='" . htmlspecialchars($examiner['email']) . "'>";
                                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($examiner['examiner_id']) . "'>";
                                    echo "<button type='submit' class='delete-btn'>Delete</button>";
                                    echo "</form>";
                                    // Pass examiner data to the edit button function
                                    echo "<button class='delete-btn edit-btn' onclick='onEditBtnClick(\"" . htmlspecialchars($examiner['name']) . "\", \"" . htmlspecialchars($examiner['subject']) . "\", \"" . htmlspecialchars($examiner['email']) . "\", \"" . htmlspecialchars($examiner['password']) . "\")'>Edit</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No examiners found</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                    <br>

                    <div>
                        <button class="add-examiner-btn" id="addExaminerAdmin">Add Examiner</button>
                    </div>

                    <div id="editAdminModal" class="editAdminModel">
                        <div class="edit-modal-content">
                            <div class="edit-modal-heading">
                                <h2>Edit Profile Details</h2>
                                <span class="close-btn" onclick="onCloseBtnClick()">&times;</span>
                            </div>
                            <form action="../../../php/updateAccountDetails.php" method="POST">
                                <label for="name">Name:</label>
                                <input type="text" name="name" value=<?php echo  $examiner['name'] ?> />
                                <label for="nic">Subject:</label>
                                <input type="text" name="subject" value=<?php echo  $examiner['subject'] ?> />
                                <label for="email">Email:</label>
                                <input type="email" name="email" value=<?php echo  $examiner['email'] ?> />
                                <label for="password">Password:</label>
                                <input type="password" name="password" value=<?php echo  $examiner['password'] ?> />
                                <input hidden type="text" name="type" value="examiner" />
                                <input hidden type="text" name="previus-email" value=<?php echo  $examiner['email'] ?> />
                                <button type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>

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

                                <input hidden type="text" name="types" value="examiner" />
                                <input hidden type="text" name="is-admin" value="admin" />

                                <input type="submit" value="Register" class="register-submit-btn" onclick="checkPasswords()" />
                            </form>
                        </div>
                    </div>
                </main>
            </div>


            <!-- <div class="modal" id="assignExaminerModal">
                <div class="modal-content">
                    <span class="close" id="assignClose">&times;</span>
                    <h2>Assign an Examiner</h2>
                    <form method="POST">
                        <div class="input-container" action="./assignExaminer.php">
                            <label for="examinerSelect">Select Examiner:</label>
                            <select id="examinerSelect" name="examinerSelect" class="input-field" onchange="toggleFields()" required>
                            </select>
                        </div>

                        <div class="input-container">
                            <label for="assignTo">Assign to Exam:</label>
                            <select id="assignTo" name="assignTo" class="input-field" onchange="toggleFields()" required></select>
                        </div>

                        <input type="submit" value="Assign" class="assign-add" />
                    </form>

                </div>
            </div> -->


            <footer class="page-footer">
                <p>Copyright ©️ 2024 ExamCore. All rights reserved. |
                    <a href="http://localhost/Group%20project/ExamCore/terms&conditions.html">Terms & Conditions</a> |
                    <a href="http://localhost/Group%20project/ExamCore/privacyPolicy.html">Privacy Policy</a>
                </p>
            </footer>
        </div>
    </div>

</body>

</html>